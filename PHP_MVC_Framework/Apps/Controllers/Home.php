<?php

namespace Apps\Controllers;
use \Core\View;

class Home extends \Core\Controller {

    public function indexAction(){
        // View::render('index.php',
        //                         [
        //                             'name' => 'abc', 
        //                             'colors' => ['green','red','blue']
        //                         ]);
        View::renderTemplate('home/index.html',[
                            'name' => 'xyz', 
                           'colours' => ['green','red','blue'],
                           'base_url' => dirname($_SERVER['SCRIPT_NAME'])
        ]);
    }
    protected function newAction(){
        echo "add new post";
    }
}