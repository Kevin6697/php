<?php

namespace Apps\Controllers;
use \Core\View;
use Apps\Models\User;

class Home extends \Core\Controller{
    public function indexAction(){
        UserConfig::getCategories();
        if(!isset($this->route_params['filename'])){
            $urlKey = 'home-page';
        }else{
            $urlKey = $this->route_params['filename'];
        }
        $query = "SELECT * FROM cms_pages WHERE cmsPageUrlKey = '$urlKey'";
        $data = User::fetchRow($query);
        View::renderTemplate("User/index.html",['data' => $data]);
    }
    
    public function loginFormAction(){
        UserConfig::getCategories();
        $checked = UserConfig::isLoginAction();
        if($checked)
        {
            $_SESSION['errorMessage'] = "Already Logged In"; 
            UserConfig::redirect("/public/home"); 
        }else{
            View::renderTemplate('user/loginForm.html');
        }
    }
    public function checkCredentialsAction(){
        UserConfig::getCategories();
        $checked = UserConfig::isLoginAction();
        if($checked)
        {
            $_SESSION['errorMessage'] = "Already Logged In"; 
            UserConfig::redirect("/public/home"); 
        }else{
            extract($_POST);
            $psw =md5($psw);
            $query ="Select custId from customer where custEmail = '$email' AND custPassword = '$psw'";
            $data = User::fetchRow($query);
            if($data == false){
                $_SESSION['errorMessage'] = "Invalid Username and password";
                UserConfig::redirect("/public/home/loginForm");
            }else{
                $_SESSION['custId'] = $data['custId'];
                $_SESSION['errorMessage'] = "Login Successfully"; 
                UserConfig::redirect("/public/home");
            }
        }
    }
    public function logout(){
        UserConfig::getCategories();
        $checked = UserConfig::isLoginAction();
        if($checked)
        {
            unset($_SESSION['custId']);
            $_SESSION['errorMessage'] = "Logout Successfully"; 
            USerConfig::redirect('/public/home');
        }else{
            $_SESSION['errorMessage'] = "Please Login First "; 
            USerConfig::redirect('/public/home');
        }
    }
}