<?php

namespace Core;

class Router{

    protected $routes = [];
    protected $params = []; 
    public function add($route, $params = []){
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        // Convert variables e.g. {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-.]+)', $route);
        
        // Convert variables with custom regular expressions e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // Add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
        // echo"<pre>";
        // print_r($this->routes);
        // echo"</pre>";
    }
    public function getRoutes(){
        return $this->routes;
    }
    public function match($url){
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {  
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }
    public function dispatch($url){
        $url = $this->removeQueryString($url);
        if($this->match($url)){
            $controller = $this->params['controller'];
            $controller = $this->convertStudly($controller);
            $controller = $this->getNamespace().$controller;
            if(class_exists($controller)){
                $controller_object = new $controller($this->params);
                if(array_key_exists('action', $this->params)){
                    $action = $this->params['action'];
                }else{
                    $action = 'index';
                } 
                $action = $this->convertCamelCase($action);
                if(is_callable([$controller_object,$action])){
                    $controller_object->$action();
                }else{
                    throw new \Exception("$action method not found");
                    
                }
            }else{
                throw new \Exception("$controller no such class found");
            }
        }else{
            throw new \Exception("$url Router Not Found",404);
        }
    }
    protected function removeQueryString($url){
        $urlParts = '';
        if($url != ""){       
        $parts = explode("&",$url,2);
         if(strpos('=', $parts[0])== false){
            $urlParts = $parts[0];
          }
        }else{
            $urlParts = $url;
        }
        return $urlParts;
    }
    protected function getNamespace(){
        $namespace = "Apps\Controllers\\";
        if(array_key_exists('namespace', $this->params)){
            $namespace .= $this->params['namespace']."\\";
        }
        return $namespace;
    }
    protected function convertStudly($controller){
        return str_replace(' ','',ucwords(str_replace('-',' ',$controller)));
    }
    protected function convertCamelCase($action){
        return lcfirst($this->convertStudly($action));
    }
}