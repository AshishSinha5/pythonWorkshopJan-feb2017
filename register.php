<?php
/**
 * Description of register
 *
 * @author root
 */
require_once 'database/database.php';
class register {
    //put your code here
    private $databaseObj,$rowCount;
    function __construct() {
        $this->databaseObj=new Database();
    }
    public function registeration($regno,$name,$course,$sem,$email,$mobile){
        $this->databaseObj->query = "call register(?,?,?,?,?,?)";
        $this->databaseObj->stmt = $this->databaseObj->prepare($this->databaseObj->query);
        $this->databaseObj->stmt->bind_param('sssiss',$regno,$name,$course,$sem,$email,$mobile); //i for integer , s for string
        $this->databaseObj->stmt->execute();
        $this->rowCount= $this->databaseObj->getResultantRow();
    }
    public function successMessage(){
        if ($this->rowCount['result'] > 0){
           return array("msg"=>"Registration complete");
        }
        else {
            return array("msg"=>"Already Registered.");
        }
    }
}
$Obj=new register();
$json = json_decode(file_get_contents("php://input"));
if(!empty($json->regno) && !empty($json->name) && !empty($json->course) 
        && !empty($json->semester) && !empty($json->email) && !empty($json->mobile)){
    $Obj->registeration($json->regno, $json->name, $json->course, $json->semester ,$json->email,$json->mobile);
    echo json_encode($Obj->successMessage());
}else {
    echo json_encode(array("error"=>"All fields must be properly filled."));
}