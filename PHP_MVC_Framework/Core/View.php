<?php

namespace Core;

class View{

    public static function render($view, $args = []){
        extract($args, EXTR_SKIP);
        $file = "../Apps/Views/$view";
        if(is_readable($file)){
            require_once $file;
        }else{
            throw new \Exception('$file not found');
        }
    }
    public static function renderTemplate($template, $args = []){
        static $twig = null;
        if($twig == null){
            $loader = new \Twig\Loader\FilesystemLoader('../Apps/Views');
            $twig = new \Twig\Environment($loader);
            $twig->addGlobal('session', $_SESSION);
        }
        
        echo $twig->render($template, $args);
        $_SESSION['errorMessage'] = "";
        $twig->addGlobal('session',$_SESSION);
    } 
}