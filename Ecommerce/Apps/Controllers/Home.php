<?php

namespace Apps\Controllers;
use \Core\View;
use Apps\Models\User;

class Home extends \Core\Controller{
    public function indexAction(){
        UserConfig::getCategories();
        View::renderTemplate("User/index.html");
    }
  
}