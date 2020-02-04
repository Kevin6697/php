<?php

class DBConfig{

    private $hostName = "localhost";
    private $username = "root";
    private $password = "";
    private $databseName = "cybercom_blog";
    private $con;
    function __construct(){
      $this->con =  mysqli_connect($this->hostName, $this->username, $this->password, $this->databseName) or die("Could not connect to database");
    }
    function insert($data, $tableName){
        $keys = implode(",",array_keys($data));
        $values = "'".implode("','",array_values($data))."'";
       $query = "insert into $tableName($keys) values ($values)";
        if(mysqli_query($this->con, $query)){
            return mysqli_insert_id($this->con);
        }else{
            echo mysqli_error($this->con);
            return 0;
        }   
    }
    function fetchRow($where, $field,$tableName){
        $field = implode(',',$field);
        $tableName = implode(',', $tableName);
        $query = "select $field from $tableName where $where";
        $result = mysqli_query($this->con, $query);
        return $result;
    }
    function fetchAll($field, $tableName, $where=1){
        $tableName = implode(',', $tableName);
        $query = "select $field from $tableName where $where";
        $result = mysqli_query($this->con, $query);
        return $result;
    }
    function delete($where, $tableName){
        $query = "delete from $tableName where $where";
        $result = mysqli_query($this->con, $query);
        if(mysqli_query($this->con, $query)){
            return 1;
        }else{
            echo mysqli_error($this->con);
            return 0;
        }   
    }
    function update($data, $tableName, $where){
        $values = "";
        $count = 1 ; 
        foreach($data as $key=>$value){
            // if($key == "parentCatId"){
            //     if($value == ""){
            //         $value = NULL;   
            //     }
            // }
           
            $values .= "$key = '$value'";
            if(count($data) > $count){
                $values .=',';
            }
            $count++;
        }
       $query = "update $tableName set $values where $where";      
       $result = mysqli_query($this->con, $query);
        if(mysqli_query($this->con, $query)){
                return 1;
            }else{
                echo mysqli_error($this->con);
                return 0;
            }   
    }
    function isUnique($tableName, $field, $where){
        $query = "select $field from $tableName where $where";
        $result = mysqli_query($this->con, $query);
        if(mysqli_num_rows($result) > 0){
            return true;
        }else{
            return false;
        }
    }
}
?>