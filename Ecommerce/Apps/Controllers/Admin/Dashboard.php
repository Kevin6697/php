<?php

namespace Apps\Controllers\Admin;
use \Core\View;
use Apps\Controllers\Admin\AdminConfig;


class Dashboard extends \Core\Controller{
    public function indexAction(){
       $checked = AdminConfig::isLoginAction();
          if($checked){
        View::renderTemplate("admin/dashboard.html");
       }else{
            AdminConfig::redirect('/public/admin/login');
        // $redirect = $_SESSION['base_url'].'/public/admin/login';
            // header("Location:$redirect");
       }
    }
} 