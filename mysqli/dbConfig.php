<?php

class DBConfig{
    private $hostName = "localhost";
    private $username = "root";
    private $password = "";
    private $dbName ="Cybercom";
    private $con;

    function __construct(){
        $this->con = $this->connect();
        if($this->con == "Failed to connect  :". mysqli_connect_error()){
            die("Failed to connect  :". mysqli_connect_error());
        }
    }
    function connect(){
       $this->con =  mysqli_connect($this->hostName, $this->username, $this->password, $this->dbName) ;
        if(mysqli_connect_errno($this->con)){
            return  "Failed to connect  :". mysqli_connect_error();
        }else{
            return $this->con;
        }
    }
    function insert($data, $tableName){
       $fields = implode(',', array_keys($data));
       $values = "'".implode("','", array_values($data))."'";
       $query = "insert into $tableName ($fields) values ($values)";
         if(mysqli_query($this->con, $query)){
           return mysqli_insert_id($this->con);
        }else{
            echo mysqli_error($this->con);
            return 0;
        }
    }
    function update($data, $tableName, $custId, $where){
       $values='';
       $count = 0;
        foreach($data  as $key=>$value){
            $values.= "$key = '$value'"; 
            $count++;       
            if(sizeof($data) > $count){
                $values.= ", ";
            }
            
        }
     $query = "update $tableName set $values where $where";
         if(mysqli_query($this->con, $query)){
            return 1;
         }else{
             echo mysqli_error($this->con);
             return 0;
         }
     }


    function fetchAll($query){
        $result = mysqli_query($this->con, $query);
        return $result;
    }
    function delete($tableName, $where){
        $query = "delete from $tableName where $where";
        if(mysqli_query($this->con, $query)){
            return 1;
         }else{
             echo mysqli_error($this->con);
             return 0;
         }
       
    }
}
?>