<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of database
 *
 * @author Varun
 */
require_once 'databaseInfo.php';
class Database extends mysqli implements DatabaseInfo {
    //put your code here
    public $query,$stmt,$res,$row,$rows;
    public function __construct() {
        parent::__construct(DatabaseInfo::db_hostname, DatabaseInfo::db_username, DatabaseInfo::db_password, DatabaseInfo::db_database);
    }
    public function __destruct() {
        parent::close();
    }
    function getResultantRow(){
        $this->res=$this->stmt->get_result();
        $this->row=$this->res->fetch_assoc();
        if(is_null($this->row))
            echo 'null returned from database ---database.php';
        return $this->row;
    }
    function getMultipleResultantRows(){
       $this->res=$this->stmt->get_result();
       for($i=0;($this->row=  $this->res->fetch_assoc());$i++)
       {
           $this->rows[$i]=  $this->row;
       }
       return $this->rows;
    }
}
