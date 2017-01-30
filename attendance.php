<?php
/**
 * Description of attendance
 *
 * @author root
 */
require_once 'database/database.php';
class attendance {
    //put your code here
    private  $databaseObj,$rowCount,$regno;
    function __construct() {
        $this->databaseObj= new Database();
    }
    function setRegno($reg){
        $this->regno=$reg;
    }
    public function takeAttendance(){
        $this->databaseObj->query = "call takeAttendance(?)";
        $this->databaseObj->stmt = $this->databaseObj->prepare($this->databaseObj->query);
        $this->databaseObj->stmt->bind_param('s', $this->regno ); //i for integer , s for string
        $this->databaseObj->stmt->execute();
        $this->rowCount= $this->databaseObj->getResultantRow();
    }
    public function successMessage(){
        if ($this-> rowCount >0){
           return array("msg"=>"Attendance complete");
        }
        else {
            return array("msg"=>"Some Error occured");
        }
    }
}
$Obj=new attendance();
$json = json_decode(file_get_contents("php://input"));
if(!empty($json->regno)){
    $Obj->setRegno($json->regno);
    $Obj->takeAttendance();
    echo json_encode($Obj->successMessage());
}else {
    echo json_encode(array("error"=>"Registration no. not filled"));
}