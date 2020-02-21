<?php

namespace Core;
use \Apps\Config;
use PDO;
abstract class Model{

    public static function connection(){
        static $db = null;
        if($db == null){
            try{
                $dsn ="mysql:hostname=".Config::HOSTNAME.";dbname=".Config::DBNAME.";charset=utf8";
                $db = new PDO($dsn, Config::USERNAME, Config::PASSWORD);
                return $db;
            }catch(Exception $e){
                return $e->getMessage();
            }
            
        }else{
            return $db;
        }
    }

}