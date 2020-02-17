<?php
namespace Apps\Controllers\Admin;
use \Core\View;
use \Apps\Models\Admin;
use Apps\Controllers\Admin\AdminConfig;

// use \Core\Model;
class Login extends \Core\Controller {
    public function indexAction() {
        if(!array_key_exists('adminId', $_SESSION)){
            View::renderTemplate("admin/index.html");
        }else{
                AdminConfig::redirect('/public/admin/dashboard');
            // $redirect = $_SESSION['base_url'].'/public/admin/dashboard';
            // header("Location:$redirect");
        }
    }
    public function checkCredentialsAction() {
        // if($_SEE)
        $validationErrors = $this->isValid($_POST);
        if (sizeof($validationErrors) > 0) {
            View::renderTemplate("admin/index.html", ['errors' => $validationErrors]);
        }else{
            extract($_POST);
            $psw =md5($psw);
             $query ="Select adminId from adminlogin where adminEmail = '$email' AND adminPassword = '$psw'";
           $data = Admin::fetchRow($query);
            if($data == false){
                View::renderTemplate("admin/index.html", ['errorsMessage' => "Invalid Username and password"]);
            }else{
               $_SESSION['adminId'] = $data['adminId'];
               AdminConfig::redirect('/public/admin/dashboard');
                // $redirect = $_SESSION['base_url'].'/public/admin/dashboard';
                // header("Location:$redirect");
            }
        }
    }
    public function isValid($data) {
        $validationErrors = [];
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'email':
                    if ($value == "") {
                        $validationErrors['emailError'] = "Email Required";
                    }
                break;
                case 'psw':
                    if ($value == "") {
                        $validationErrors['pwdError'] = "Password Required";
                    }
            }
        }
        return $validationErrors;
    }
    public function logoutAction(){
        unset($_SESSION['adminId']);
        AdminConfig::redirect('/public/admin/login');
        // $redirect = $_SESSION['base_url'].'/public/admin/login';
        // header("Location:$redirect");
    }
}
