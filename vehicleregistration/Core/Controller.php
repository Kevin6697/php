<?php

namespace Core;

class Controller{
    protected $route_params = [];
    public function __construct($params){
        $this->route_params = $params;
    }
    public function __call($method, $args = []){
        $method .= "Action";
        if(method_exists($this, $method)){
            if($this->before() !== false){
                call_user_func_array([$this,$method],$args);
                $this->after();
            }
        }else{
            throw new \Exception("$method No such method found");
        } 
    }
    protected function before(){
    }
    protected function after(){
    }
}