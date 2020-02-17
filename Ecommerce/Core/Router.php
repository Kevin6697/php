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
            // print_r($this->params);
           $controller =  $this->params['controller'];
           $controller = $this->convertToStudly($controller);
           $controller = $this->getNamespace($controller).$controller;
           if(class_exists($controller)){
                $controller_object = new $controller($this->params);
                if(!array_key_exists('action', $this->params)){
                    $action = "index";
                }else{
                    $action = $this->params['action'];
                    $action = $this->convertToCamelCase($action);
                }
                if(is_callable([$controller_object,$action])){
                    $controller_object->$action();
                }else{
                    echo "$action no such method found";
                }
           }else{
               echo "$controller no such class found";
           }
        }else{
            echo "No Route match";
        }
    }
    protected function removeQueryString($url){
        $urlParts = explode("&", $url,2);
        if(strpos($urlParts[0], '=') === false){
            $url = $urlParts[0];
         }else{
             $url ="";
         }
        return $url;
    }
    protected function convertToCamelCase($action){
        return lcfirst($this->convertToStudly($action));
    }
    protected function convertToStudly($controller){
        return str_replace(' ','',ucwords(str_replace('-',' ',$controller)));
    }
    protected function getNamespace($controller){
        $namespace ="Apps\Controllers\\";
        if(array_key_exists('namespace', $this->params)){
            $namespace .=$this->params['namespace']."\\";
        }
        return $namespace;
    }
}