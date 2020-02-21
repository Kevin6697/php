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
        // $data3 = \Apps\Controllers\Cart::viewCartAction();
        // print_r($data3);
       
            // echo"<pre>";
            // print_r($ParentCategories);
            // echo"</pre>";
        View::renderTemplate("header.html",['data' => $ParentCategories]);
    }
    public static function redirect($redirect){
        $location = $_SESSION['base_url'].$redirect;
        $error = $_SESSION['errorMessage'];
        echo "<script>alert('$error');window.location.href ='$location'</script>";
    }
    public static function isLoginAction(){
        if(array_key_exists('custId', $_SESSION)  && $_SESSION['custId'] != null){
            return true;
        }else{
            return false;
        }
    }   
}