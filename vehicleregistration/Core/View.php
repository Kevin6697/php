<?php

namespace Core;
use Twig;

class View{
    public static function render($file, $args = []){
        extract($args, EXTR_SKIP);
        $location = "../Apps/Views/".$file;
        if(is_readable($location)){
            require_once $location;
        }else{
            throw new  \Exception("No such View Found");
            
        }
    }
    public static function renderTemplate($template, $args = []){
        extract($args, EXTR_SKIP);
        static $twig = null;
        if($twig == null){
            $loader = new Twig\Loader\FilesystemLoader("../Apps/Views");
            $twig = new Twig\Environment($loader);
            $twig->addGlobal('session', $_SESSION);
        }
        echo $twig->render($template, $args);
        $_SESSION['errorMessage'] ="";
        $twig->addGlobal('session', $_SESSION);
    }   
}