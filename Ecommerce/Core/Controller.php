<?php

namespace Core;
abstract class Controller{
   public  $route_params = [];
    public function __construct($param){
        $this->route_params = $param;
    }

    public function __call($method, $args){
            $method = $method."Action";
            if(method_exists($this, $method)){
                if($this->before() !== false){
                    call_user_func_array([$this,$method],$args);
                    $this->after();
                }
            }else{
                echo "No such method found";
            }
            
    }
    protected function before(){
    }
    protected function after(){
    }

}