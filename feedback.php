<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of feedback
 *
 * @author root
 */
require_once 'database/database.php';
class feedback {
    //put your code here
      //put your code here
    private  $databaseObj,$rowCount;
    function __construct() {
        $this->databaseObj= new Database();
    }
    public function takefeedback($regno,$text){
        $this->databaseObj->query = "call feedback(?,?)";
        $this->databaseObj->stmt = $this->databaseObj->prepare($this->databaseObj->query);
        $this->databaseObj->stmt->bind_param('ss', $regno,$text ); //i for integer , s for string
        $this->databaseObj->stmt->execute();
        $this->rowCount= $this->databaseObj->getResultantRow();
    }
    public function successMessage(){
        if ($this-> rowCount >0){
           return array("msg"=>"Thanks for your feedback!");
        }
        else {
            return array("msg"=>"Some Error occured");
        }
    }
}

$Obj=new feedback();
$json = json_decode(file_get_contents("php://input"));
if(!empty($json->regno) && !empty($json->text)){
    $Obj->takefeedback($json->regno,$json->text);
    echo json_encode($Obj->successMessage());
}else {
    echo json_encode(array("error"=>"All fields must be properly filled"));
}