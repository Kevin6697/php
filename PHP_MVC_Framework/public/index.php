<?php

/* 
    Twig
*/
require_once '../vendor/autoload.php';


/*
     Autoloader
*/
/* spl_autoload_register(function ($class){
    $root = dirname(__DIR__); // get parent directory
    $file = $root.'/'.str_replace('\\', '/', $class).'.php';
    if(is_readable($file)){
        require_once $root.'/'.str_replace('\\', '/', $class).'.php';
    }

}); */


$router = new Core\Router;



$router->add('', ['controller' => 'Home', 'action' =>'indexAction']);
// $router->add('posts', ['controller' => 'Posts', 'action' =>'index']);
// $router->add('posts/123/new', ['controller' => 'posts', 'action' =>'new']);
// $router->add('products/list', ['controller' => 'Products', 'action' =>'list',]);
$router->add('{controller}/{action}');
$router->add('admin/{controller}/{action}',['namespace'=>'admin']);
$router->add('{controller}/{id:\d+}/{action}');
// echo"<pre>";
// print_r($router->getRoutes());
// echo"</pre>";
// die();
$url = $_SERVER['QUERY_STRING'];
// if($router->match($url)){
//     var_dump($router->getParams());
// }else{
//     echo "404 - Not Found ";
// }

$router ->dispatch($url);