<?php

namespace Apps\Controllers;
use \Core\View;
use Apps\Models\Vehicle;

class User  extends \Core\Controller{
    public function index(){
        if($this->isLoggedIn()){
            $redirect = $_SESSION['base_url']."/public/vehicle/services";
            header("Location:$redirect"); 
        }else{
            if(!isset($_POST['login'])){
                View::renderTemplate('index.html');
            }else{
                $data = $this->cleanArray($_POST['user']);
                $query = "SELECT user_id FROM users WHERE email = '".$data['email']."' AND password = '".$data['password']."'";    
                $result = Vehicle::fetchRow($query);
                if ($result == 0){
                    $_SESSION['errorMessage'] = "Invalid Username and Password";
                    View::renderTemplate('index.html',['data' => $_POST]);
                }else{
                    $_SESSION['user_id'] = $result['user_id'];
                    $redirect = $_SESSION['base_url']."/public/vehicle/services";
                    header("Location:$redirect");  
                }
            }
        }
    }
    public function registerAction(){
        if($this->isLoggedIn()){
            $redirect = $_SESSION['base_url']."/public/vehicle/services";
            header("Location:$redirect"); 
        }else{    
            if(!isset($_POST['register'])){
                View::renderTemplate('registration.html');
            }else{
                if($_POST['user']['password'] == $_POST['user']['Confirm Password']){
                    $table = 'users';
                    $where = "email ='".$_POST['user']['email']."'";
                    $unique = Vehicle::is_unique('*',$table, $where);
                    if($unique){
                        $_SESSION['errorMessage'] = "Email Already Exists";
                      View::renderTemplate('registration.html',['data' =>$_POST]);  
                    }else{
                        $data = $this->cleanArray($_POST['user']);
                        $user_id = Vehicle::insert($data, $table);
                        if($user_id > 0){
                            $data = [];
                            $data = $this->cleanArray($_POST['address']);
                            $data['user_id'] = $user_id;
                            $table = 'user_addresses';
                            $user_id = Vehicle::insert($data, $table);
                            if($user_id > 0){
                                $_SESSION['errorMessage'] = "Registered Successsfully";
                                $redirect = $_SESSION['base_url']."/public/user/index";
                                header("Location:$redirect");  
                            }else{
                                $_SESSION['errorMessage'] = "Cannot Register";
                                View::renderTemplate('registration.html',['data' =>$_POST]);         
                            }
                        }else{
                            $_SESSION['errorMessage'] = "Cannot Register";
                            View::renderTemplate('registration.html',['data' =>$_POST]);         
                        }
                    }
                }else{
                    $_SESSION['errorMessage'] = "Password Does not match";
                    View::renderTemplate('registration.html',['data' =>$_POST]);   
                }
            }
        }
    }
    public function logout(){
        unset($_SESSION['user_id']);
        $redirect = $_SESSION['base_url']."/public/user/index";
        header("Location:$redirect"); 
    }
    protected function isLoggedIn(){
        if(isset($_SESSION['user_id'])){
            return true;
        } else{
            return false;
        }
    }
    protected function cleanArray($fieldValues){
        $data = [];
        foreach($fieldValues as $key=>$value){
            switch($key){
                case 'first_name':
                    $data['first_name'] = $value;
                break;
                case 'last_name':
                    $data['last_name'] = $value;
                break;
                case 'email';
                    $data['email'] = $value;
                break;
                case 'password':
                    $data['password'] = $value;
                break;
                case 'number';
                    $data['phone_number'] = $value;
                break;
                case 'street':
                    $data['street'] = $value;
                break;
                case 'city' :
                    $data['city'] = $value;
                break;
                case 'state':
                    $data['state'] = $value;
                break;
                case 'zip':
                    $data['zip_code'] = $value;
                break;
                case 'country':
                    $data['country'] = $value;
                break;    
            }
        }
        return $data;
    }
}