<?php

session_start();
require_once '../vendor/autoload.php';

$_SESSION['base_url'] = "http://localhost/Internship/vehicleregistration";

set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

$router = new \Core\Router();

$router->add('vehicle/{controller}',['namespace' =>'vehicle']);
$router->add('vehicle/{controller}/{action}',['namespace' =>'vehicle']);

$router->add('{controller}'); 

$router->add('',['controller'=> 'user', 'action'=>'index']);

$router->add('{controller}/{action}');
$router->add('{controller}/{action}');
$url =$_SERVER['QUERY_STRING'];
$router->dispatch($url);