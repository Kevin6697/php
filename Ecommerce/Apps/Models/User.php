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
}