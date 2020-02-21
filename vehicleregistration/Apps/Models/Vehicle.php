<?php

namespace Apps\Models;
use PDO;
use \Core\Model; 


class Vehicle extends \Core\Model{

    public static function insert($data, $table){
        $db = Model::connection();  
        $keys = implode(",",array_keys($data));
        $values = "'".implode("','", $data)."'";
        $query = "INSERT INTO $table ($keys) values($values)";
        $db->exec($query);
        $lastid = $db->lastInsertId();
        return $lastid;
    }
    public static function is_unique($field, $table, $where){
        $db = Model::connection();  
        $query = "SELECT  $field FROM $table WHERE $where";
        $stmt = $db->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result == 0){
            return false;
        }else{
            return true;
        }
    }
    public static function fetchRow($query){
        $db = Model::connection();  
        $stmt = $db->query($query);
       return $stmt->fetch(PDO::FETCH_ASSOC);
    } 
}