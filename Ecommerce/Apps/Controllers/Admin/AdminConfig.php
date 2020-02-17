<?php

namespace Apps\Controllers\Admin;
use \Core\View;
class AdminConfig extends \Core\Controller{

    public static function isLoginAction(){
        if($_SESSION['adminId'] != null){
            return true;
        }else{
            return false;
        }
    }    
    public static function redirect($url){
        $redirect = $_SESSION['base_url'].$url;
        header("Location: $redirect");
    }
    public static function cleanUrl($name){
        $name = strtolower($name);
        if(strpos($name,' ') != false){
           $name = str_replace(" ",'-',$name);
        }
        if(strpos($name,'&') != false){
            $name = str_replace("&",'%20',$name);
         }
        return $name; 
    }
}