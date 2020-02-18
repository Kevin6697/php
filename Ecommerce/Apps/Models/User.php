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
}