<?php

namespace Core;
use Twig;

abstract class View{
    public static function render($file, $args = []){
        extract($args, EXTR_SKIP);
        $filename = "../Apps/Views/".$file;
        if(is_readable($filename)){
            require_once $filename;
        }else{
            throw new \Exception("No such file found");
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