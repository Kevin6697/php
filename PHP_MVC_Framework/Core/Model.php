<?php
namespace Core;
use PDO;
abstract class Model {
    protected static function connection() {
        static $db = null;
        if ($db == null) {
            $host = "localhost";
            $dbName = "php_custom_mvc";
            $username = "root";
            $pwd = "";
            try {
                $db = new PDO("mysql:host=$host;dbname=$dbName;
                               charset=utf8", $username, $pwd);
                return $db;
            }
            catch(Exception $e) {
                echo $e->getMessage();
            }
        } else {
            return $db;
        }
    }
}
