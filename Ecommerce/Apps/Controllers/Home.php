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
  
}