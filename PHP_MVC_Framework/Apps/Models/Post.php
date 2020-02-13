<?php

namespace Apps\Models;
use PDO;

class Post extends \Core\Model{
    
    public static function getAll(){
        $db = static::connection(); 
        $stmt = $db->query("select * from posts");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;             
    }
    public static function insert($query){
        $db = static::connection(); 
        $stmt = $db->exec($query);
        // echo $lastid = $db->lastInsertId();
        return $stmt;
    } 
    public static function delete($query){
        $db = static::connection(); 
        $stmt = $db->exec($query);
        return $stmt;
    } 
    public static function fetchRow($query){
        $db = static::connection(); 
        $stmt = $db->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;        
    }
    public static function update($query){
        $db = static::connection(); 
        $stmt = $db->exec($query);
        return $stmt;
    } 
}