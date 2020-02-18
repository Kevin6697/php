<?php

namespace Apps\Controllers;
use \Core\View;
use Apps\Models\User;

class UserConfig extends \Core\Controller{
    public function getCategories(){
        $ParentCategories = [];   
        $query1 = "SELECT categoryId, categoryName, categoryUrlKey FROM categories WHERE parentCategory IS NULL";
        $data1 = User::fetchAll($query1);
        foreach($data1 as $categories){
            $query2 = "SELECT categoryId, categoryName, categoryUrlKey FROM categories WHERE parentCategory = $categories[categoryId]";
            $data2 = User::fetchAll($query2);
            $categories['child'] = $data2;
             array_push($ParentCategories, $categories);
        }
       
            // echo"<pre>";
            // print_r($ParentCategories);
            // echo"</pre>";
        View::renderTemplate("header.html",['data' => $ParentCategories]);
    }
}