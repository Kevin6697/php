<?php

namespace Apps\Controllers;
use \Core\View;
use Apps\Models\User;

class UserConfig extends \Core\Controller{
    public function getCategories(){
        $query = "SELECT categoryName, categoryUrlKey FROM categories WHERE parentCategory IS NULL";
        $data = User::fetchAll($query);
        View::renderTemplate("header.html",['data' => $data]);
    }
}