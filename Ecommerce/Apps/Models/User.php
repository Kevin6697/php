<?php

namespace Apps\Models;
use PDO;
use \Core\Model; 

class User extends \Core\Model{
    public static function fetchAll($query){
        $db = Model::connection();  
        $stmt = $db->query($query);
       return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function fetchRow($query){
        $db = Model::connection();  
        $stmt = $db->query($query);
       return $stmt->fetch(PDO::FETCH_ASSOC);
    } 
    public static function insert($data, $table){
        $db = Model::connection();  
        $keys = implode(",",array_keys($data));
        $values = "'".implode("','", $data)."'";
        $query = "INSERT INTO $table ($keys) values($values)";
        $db->exec($query);
        $lastid = $db->lastInsertId();
        return $lastid;
    }
    public static function update($data, $where, $table){
        $db = Model::connection();  
        $count = 0; 
        $values = "";
        foreach($data as $key=>$value){
            $values .= "$key = '$value'";
            if($count < sizeof($data)-1){
                $values .= ",";
            } 
            $count++;
        }
        $query = "UPDATE $table SET $values WHERE $where";
        return $db->exec($query);
    }
}