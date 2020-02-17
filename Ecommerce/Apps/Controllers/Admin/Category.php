<?php

namespace Apps\Controllers\Admin;
use \Core\View;
use Apps\Controllers\Admin\AdminConfig;
use \Apps\Models\Admin;

class Category extends \Core\Controller{
    public function indexAction(){
        $checked = AdminConfig::isLoginAction();
          if($checked){
              $query = "SELECT C.*, PC.categoryName as parent FROM `categories` C LEFT JOIN categories PC ON C.parentCategory = PC.CategoryId";
              $data = Admin::fetchAll($query); 
              View::renderTemplate("admin/viewCategory.html",['data' => $data]);
       }else{
            AdminConfig::redirect('/public/admin/login');
       }
    }
    public function addFormAction(){
        $checked = AdminConfig::isLoginAction();
        if($checked){
            $query = "SELECT categoryName, categoryId FROM categories WHERE parentCategory IS NULL";
            $result = Admin::fetchAll($query);
            View::renderTemplate("admin/addCategory.html",
                                [
                                    'data' => $result,
                                ]);
     }else{
          AdminConfig::redirect('/public/admin/login');
     }
    }
    public function addAction(){
        $checked = AdminConfig::isLoginAction();
        if($checked && isset($_POST['cname'])){
            $hasUploaded =  $this->fileUploadAction($_FILES);
            if($hasUploaded){
                $data = [];
                $img = $_FILES['cimg']['name'];
                $data = $this->cleanArray($_POST);
                $data['categoryImage'] = $img;
                $data['createdAt'] = date('d-m-y  h:i:s');
                $data['categoryUrlKey'] = AdminConfig::cleanUrl($_POST['cname']);
                $table = 'categories';
                $result = Admin::insert($data, $table);
                if($result){
                    $_SESSION['errorMessage'] = "Category Added Successfully";
                    AdminConfig::redirect('/public/admin/category');
                }else{
                    $_SESSION['errorMessage'] = "Cannot Insert";
                    AdminConfig::redirect('/public/admin/category/addForm');
                }       
            }else{
                $_SESSION['errorMessage'] = "Error in file uploading";
                AdminConfig::redirect('/public/admin/category/addForm');
            }
     }else{
          AdminConfig::redirect('/public/admin/login');
     }

    }
    public function editFormAction(){
        $checked = AdminConfig::isLoginAction();
        if($checked){
            $id = $this->route_params['id'];
            $query1 = "SELECT * FROM categories WHERE categoryId =$id ";
            $data = Admin::fetchRow($query1); 
            $query2 = "SELECT categoryName, categoryId FROM categories WHERE parentCategory IS NULL";
            $result = Admin::fetchAll($query2);
            View::renderTemplate("admin/editCategory.html",[
                                'data' => $data,
                                'parentData' => $result
                                ]);
        }else{
            AdminConfig::redirect('/public/admin/login');
        }
    }
    public function editAction(){
        extract($_POST);
        $checked = AdminConfig::isLoginAction();
        if($checked){
            if($_FILES['cimg']['name'] == null){
                $hasUploaded = true;
            }else{
                $data['categoryImage'] = $img;
                $hasUploaded =  $this->fileUploadAction($_FILES);
            }
            if($hasUploaded){
                $data = [];
                $img = $_FILES['cimg']['name'];
                $data = $this->cleanArray($_POST);
                $data['updatedAt'] = date('d-m-y  h:i:s');
                $data['categoryUrlKey'] = AdminConfig::cleanUrl($_POST['cname']);
                $table = 'categories';
                $where = 'categoryId ='.$cid;
                $result = Admin::update($data, $table, $where);
                if($result){
                    $_SESSION['errorMessage'] = "Category Updated Successfully";
                    AdminConfig::redirect('/public/admin/category');
                }else{
                    $_SESSION['errorMessage'] = "Cannot Update";
                    AdminConfig::redirect("/public/admin/category/editForm/$cid",['data' => $_POST]);
                }   
            }else{
                $_SESSION['errorMessage'] = "Error in file uploading";
                AdminConfig::redirect("/public/admin/category/editForm/$cid");
            }
        }else{
            AdminConfig::redirect('/public/admin/login');
        }
    }
    public function deleteAction(){
        $checked = AdminConfig::isLoginAction();
        if($checked){
            $where = "categoryId =". $_POST['id'];
            $table = "categories";
            $result = Admin::delete($table, $where);
            if($result){
                $_SESSION['errorMessage'] = "Deleted Successfully";
            }else{
                $_SESSION['errorMessage'] = "Cannot Delete";
            }
            AdminConfig::redirect('/public/admin/category');
        }else{
            AdminConfig::redirect('/public/admin/login');
        }    
    }

    public function fileUploadAction($files){
        $name = $files['cimg']['name'];
        $tmpname = $files['cimg']['tmp_name'];
        $dir = '../resources/uploads/categories';
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
               case 'cname':
                  $data['categoryName']  = $value;
               break;
               case 'cstatus':
                    $data['categoryStatus']  = $value;
                break;
                case 'cdesc':
                    if($value != ""){
                        $data['categoryDescription']  = $value;
                    }
                break;
                
           }
        }
        return $data;
    }

}