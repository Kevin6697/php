<?php

namespace Apps\Controllers;
use Apps\Models\User;
use \Core\View;

class Product extends \Core\Controller{
    public function viewAction(){
        $filename  =  $this->route_params['filename'];
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
                    P.productUrlKey = '".$this->route_params['url']."'
                ";
        $data = User::fetchAll($query);
        View::renderTemplate("User/$filename",['data' => $data]);     
    }
}