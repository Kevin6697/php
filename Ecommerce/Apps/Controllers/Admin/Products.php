<?php

namespace Apps\Controllers\Admin;
use \Core\View;
use \Apps\Models\Admin;

class Products extends \Core\Controller{
    public function indexAction(){
        $checked = AdminConfig::isLoginAction();
        if($checked){
            $query ="
                    SELECT
                        P.*,
                        GROUP_CONCAT(C.categoryName SEPARATOR '\n') As Category
                    FROM
                        products P
                    LEFT JOIN
                        products_categories PC
                    ON
                        PC.productId = P.productId
                    LEFT JOIN
                        categories C
                    ON
                        C.categoryId = PC.categoryId
                    GROUP BY
                        P.productId
                    ";
            $data = Admin::fetchAll($query);        
           View::renderTemplate("admin/viewProduct.html",['data' => $data]);
        }else{
          AdminConfig::redirect('/public/admin/login');
     }
    }
    public function addFormAction(){
        $checked = AdminConfig::isLoginAction();
        if($checked){
            $query = "SELECT * FROM `categories`";
            $data = Admin::fetchAll($query); 
            if($data == null){
                $_SESSION['errorMessage'] = "First Add Category then you can add Products";
                AdminConfig::redirect('/public/admin/category');
            }
            View::renderTemplate("admin/addProduct.html",['categories' => $data]);
     }else{
          AdminConfig::redirect('/public/admin/login');
     }
    }
    public function addAction(){
        $checked = AdminConfig::isLoginAction();
        if($checked){
            $hasUploaded =  $this->fileUploadAction($_FILES);
            if($hasUploaded){
                $data = [];
                $img = $_FILES['pimg']['name'];
                $data = $this->cleanArray($_POST);
                $data['productImage'] = $img;
                $data['createdAt'] = date('d-m-y  h:i:s');
                $data['productUrlKey'] = AdminConfig::cleanUrl($_POST['pname']);
                $table = 'products';
                $result = Admin::insert($data, $table);
                $productId = $result;
                if($productId != 0){
                    $catData = [];
                     foreach($_POST['cat'] as $key){
                         $catData['categoryId'] = $key;
                         $catData['productId'] = $productId;
                         $table ="products_categories";
                         $result = Admin::insert($catData, $table);
                        }
                     if($result){ 
                        $_SESSION['errorMessage'] = "Product Added Successfully";
                        AdminConfig::redirect('/public/admin/products');
                    }else{
                        $_SESSION['errorMessage'] = "Cannot Insert";
                        AdminConfig::redirect('/public/admin/products/addForm');
                    }    
                }else{
                    $_SESSION['errorMessage'] = "Cannot Insert";
                    AdminConfig::redirect('/public/admin/products/addForm');
                }       
            }else{
                $_SESSION['errorMessage'] = "Error in file uploading";
                AdminConfig::redirect('/public/admin/products/addForm');
            }
     }else{
          AdminConfig::redirect('/public/admin/login');
     }
    }
    public function deleteAction(){
        $checked = AdminConfig::isLoginAction();
        if($checked){
            $where = "productId =". $_POST['id'];
            $table = "products";
            $result = Admin::delete($table, $where);
            if($result){
                $_SESSION['errorMessage'] = "Deleted Successfully";
            }else{
                $_SESSION['errorMessage'] = "Cannot Delete";
            }
            AdminConfig::redirect('/public/admin/products');
    }else{
        AdminConfig::redirect('/public/admin/login');
    }
    }
    public function editForm(){
        $checked = AdminConfig::isLoginAction();
        if($checked){
            $query1 ="
                    SELECT
                        P.*,
                        GROUP_CONCAT(C.categoryId) As Category
                    FROM
                        products P
                    LEFT JOIN
                        products_categories PC
                    ON
                        PC.productId = P.productId
                    LEFT JOIN
                        categories C
                    ON
                        C.categoryId = PC.categoryId
                    GROUP BY
                        P.productId
                    HAVING 
                        P.productId =    
                    ".$this->route_params['id'];
            $query2 = "SELECT categoryId, categoryName FROM `categories`";
            $data1 = Admin::fetchRow($query1); 
            $data2 = Admin::fetchAll($query2); 
            View::renderTemplate("admin/editProduct.html",['product' => $data1,
                                                        'categories' => $data2]);
        }else{
            AdminConfig::redirect('/public/admin/login');
        }                                                                                                
    }
    public function editAction(){
        $checked = AdminConfig::isLoginAction();
        if($checked){
            $data = [];
            $id = $_POST['pid'];
            if($_FILES['pimg']['name'] == ""){
                $hasUploaded =  true;
            }else{
                $hasUploaded =  $this->fileUploadAction($_FILES);
                $img = $_FILES['pimg']['name'];
                $data['productImage'] = $img;    
            }
            if($hasUploaded)
            {
                $data = $this->cleanArray($_POST);
                $data['productUrlKey'] = AdminConfig::cleanUrl($_POST['pname']);
                $data['updatedAt'] = date('d-m-y  h:i:s');
                $table = 'products';
                $where = "productId = $id";
                $result = Admin::update($data, $table, $where);
                if($result){
                    $table = 'products_categories';
                    $result = Admin::delete($table, $where);
                    if($result){
                        $catData = [];
                        foreach($_POST['cat'] as $key){
                            $catData['categoryId'] = $key;
                            $catData['productId'] = $id;
                            $table ="products_categories";
                            $result = Admin::insert($catData, $table);
                        }
                        if($result){ 
                            $_SESSION['errorMessage'] = "Product Updated Successfully";
                            $redirect = '/public/admin/products';
                        }else{
                            $_SESSION['errorMessage'] = "Cannot Update";
                            $redirect = "/public/admin/products/editForm/$id";
                        }      
                    }else{
                        $_SESSION['errorMessage'] = "Cannot Update";
                        $redirect  = "/public/admin/products/editForm/$id";
                    }
                }else{
                    $_SESSION['errorMessage'] = "Cannot Update";
                    $redirect  = "/public/admin/products/editForm/$id";
                }
            }else{
                $_SESSION['errorMessage'] = "Error in file uploading";
                $redirect  = "/public/admin/products/editForm/$id";
            }
            AdminConfig::redirect($redirect);
        }else{
           AdminConfig::redirect('/public/admin/login');
        }
    }
    
    public function fileUploadAction($files){
        $name = $files['pimg']['name'];
        $tmpname = $files['pimg']['tmp_name'];
        $dir = '../resources/uploads/products';
        $location = $dir.'/'.$name;
        if(move_uploaded_file($tmpname, $location)){
            return true;
        }else{
            return false;
        }
    }
    public function cleanArray($post){
        $data = [];
        foreach($post as $key=>$value){
           switch($key){
               case 'pname':
                  $data['productName']  = $value;
               break;
               case 'psku':
                    $data['productSKU']  = $value;
                break;
                case 'pdesc':
                    if($value != ""){
                        $data['productDescription']  = $value;
                    }
                break;
                case 'psdesc':
                    if($value != ""){
                        $data['productShortDescription']  = $value;
                    }
                break;
                case 'pstatus':
                    $data['productStatus']  = $value;
                break;
                case 'pprice':
                    $data['productPrice']  = $value;
                break;
                case 'pstock':
                    $data['productStock']  = $value;
                break; 
               
           }
        }
        return $data;
    }
}