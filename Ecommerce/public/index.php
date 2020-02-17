<?php

session_start();

require_once '../vendor/autoload.php';

$_SESSION['base_url'] = "http://localhost/Internship/Ecommerce";


$router = new \Core\Router();

$router->add('admin/cms/{controller}/{action}',['namespace'=>'Admin\\Cms']);
$router->add('admin/cms/{controller}',['namespace'=>'Admin\\Cms']);
$router->add('admin/cms/{controller}/{action}/{id:\d+}',['namespace'=>'Admin\\Cms']);
$router->add('admin/{controller}',['namespace'=>'Admin']);
$router->add('admin',['controller' => 'login', 'action' =>'index','namespace'=>'Admin']);
$router->add('admin/{controller}/{action}',['namespace'=>'Admin']);
$router->add('admin/{controller}/{action}/{id:\d+}',['namespace'=>'Admin']);

$router->add('{controller}/{action}/{filename}');
$router->add('{controller}/{action}/{filename}/{url:[A-z0-9-]+}');
$router->add('',['controller'=>'home', 'action'=>'index']);
$router->add('{controller}');
$router->add('{controller}/{action}');
// $router->add('{controller}/{action}/{url:[A-z0-9-]+}');
$url = $_SERVER['QUERY_STRING'];
$router->dispatch($url);