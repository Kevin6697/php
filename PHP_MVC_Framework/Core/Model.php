<?php
namespace Core;
use PDO;
use Apps\Config;

abstract class Model {
    protected static function connection() {
        static $db = null;
        if ($db == null) {
            // try {
                $dsn = "mysql:host=".Config ::HOST.";dbname=".Config::DBNAME.";charset=utf8";
                $db = new PDO($dsn, Config::USERNAME, Config::PASSWORD);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $db;
            // }
            // catch(Exception $e) {
            //     echo $e->getMessage();
            // }
        } else {
            return $db;
        }
    }
}
