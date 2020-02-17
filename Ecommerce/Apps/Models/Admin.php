<?php

namespace Apps\Models;
use PDO;
class Admin extends \Core\Model{

    public static function fetchRow($query){
        $db = \Core\Model::connection();
        $stmt = $db->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function fetchAll($query){
        $db = \Core\Model::connection();
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function insert($data, $table){
        $db = \Core\Model::connection();
        $keys = array_keys($data);
        $values = array_values($data);
        $keys = implode(',', $keys);
        $values = "'".implode("','",$values)."'";
        $query = "INSERT INTO $table ($keys) values ($values)";
        $db->exec($query);
        $lastid = $db->lastInsertId();
        return $lastid;
    }
    public static function update($data, $table, $where){
        $db = \Core\Model::connection();
        $values = [];
            foreach ($data as $key=>$value){
                $tmp = $key."="."'$value'";
                array_push($values,$tmp);
            }
            $values = implode(',',$values);
            $query = "UPDATE $table SET $values where $where ";
            $result =  $db->exec($query);
            return $result;
    }
    public static function delete($table, $where){
        $db = \Core\Model::connection();
        $query = "DELETE FROM $table WHERE $where";
        $db->exec($query);
        return $db;
    }

}