<?php

namespace Apps\Controllers;
use Apps\Models\User;
use \Core\View;

class Category extends \Core\Controller{
    // public function viewAction(){
    //     UserConfig::getCategories();
    //     $query = "SELECT * FROM `categories` WHERE parentCategory = (SELECT categoryId FROM categories WHERE `categoryUrlKey` = '".$_POST['urlkey']."')";
    //     $data = User::fetchAll($query);  
    //     View::renderTemplate('User/categoryView.html',['data' => $data,'categoryName' =>$_POST['catname'] ]);     
    // }
    public function viewAction(){
        UserConfig::getCategories();
        $query = "
                SELECT 
                    P.*,
                    C.categoryUrlKey,
                    GROUP_CONCAT(C.categoryName) AS Cat
                FROM
                    products P
                INNER JOIN
                    products_categories Pc
                ON
                    PC.productId = P.productId
                Inner JOIN
                    categories c
                ON
                    C.categoryId = Pc.categoryId
                GROUP BY	
                    PC.productId
                
                HAVING
                    C.categoryUrlKey = '".$_POST['urlkey']."'
                ";
        $data = User::fetchAll($query);
        $file = $this->route_params['filename'];  
        View::renderTemplate("User/$file",['data' => $data,'categoryName' =>$_POST['catname'] ]);     
    }
}