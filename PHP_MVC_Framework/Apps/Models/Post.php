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
        return $stmt;
    } 
    public static function delete($query){
        $db = static::connection(); 
        $stmt = $db->exec($query);
        return $stmt;
    } 
}