<?php 

namespace Apps\Controllers\Admin\Cms;
use Apps\Controllers\Admin\AdminConfig;  
use \Core\View;
use \Apps\Models\Admin;

class Pages extends \Core\Controller{
    public function indexAction(){
        $checked = AdminConfig::isLoginAction();
        if($checked){
            $query = "SELECT * FROM cms_pages";
            $data = Admin::fetchAll($query); 
            View::renderTemplate('admin/viewCmsPage.html',['data' => $data]);
        }else{
          AdminConfig::redirect('/public/admin/login');
        }
    }
    public function addFormAction(){
        $checked = AdminConfig::isLoginAction();
        if($checked){
            View::renderTemplate('admin/addCmsPage.html');
        }else{
          AdminConfig::redirect('/public/admin/login');
        }  
    }
    public function addAction(){
        $checked = AdminConfig::isLoginAction();
        if($checked && isset($_POST['cmstitle'])){
            $data = [];
            $data = $this->cleanArray($_POST);
            $data['createdAt'] = date('d-m-y  h:i:s');
            $data['cmsPageUrlKey'] = AdminConfig::cleanUrl($_POST['cmstitle']);
            $table = 'cms_pages';
            $result = Admin::insert($data, $table);
            if($result){
                $_SESSION['errorMessage'] = "CMS Added Successfully";
                AdminConfig::redirect('/public/admin/cms/pages');
            }else{
                $_SESSION['errorMessage'] = "Cannot Insert";
                AdminConfig::redirect('/public/admin/cms/pages/addForm');
            }       
        }else{
             AdminConfig::redirect('/public/admin/login');
        }
    }
    public function deleteAction(){
        $where = "cmsPagesId =". $_POST['id'];
        $table = "cms_Pages";
        $result = Admin::delete($table, $where);
        if($result){
            $_SESSION['errorMessage'] = "Deleted Successfully";
        }else{
            $_SESSION['errorMessage'] = "Cannot Delete";
        }
        AdminConfig::redirect('/public/admin/cms/pages');
    }
    public function editFormAction(){
        $checked = AdminConfig::isLoginAction();
        if($checked){
            $id = $this->route_params['id'];
            $query1 = "SELECT * FROM cms_pages WHERE cmsPagesId = $id ";
            $data = Admin::fetchRow($query1); 
            View::renderTemplate("admin/editCms.html",[
                                'data' => $data
                                ]);
        }else{
            AdminConfig::redirect('/public/admin/login');
        }
    }
    public function editAction(){
        extract($_POST);
        $checked = AdminConfig::isLoginAction();
            if($checked){
                $data = [];
                $data = $this->cleanArray($_POST);
                $data['updatedAt'] = date('d-m-y  h:i:s');
                $data['cmsPageUrlKey'] = AdminConfig::cleanUrl($_POST['cmstitle']);
                $table = 'cms_pages';
                $where = 'cmsPagesId ='.$cmsId;
                $result = Admin::update($data, $table, $where);
                if($result){
                    $_SESSION['errorMessage'] = "CMS Page Updated Successfully";
                    AdminConfig::redirect('/public/admin/cms/pages');
                }else{
                    $_SESSION['errorMessage'] = "Cannot Update";
                    AdminConfig::redirect("/public/admin/cms/pages/editForm/$cmsId",['data' => $_POST]);
                }   
            }else{
                AdminConfig::redirect('/public/admin/login');
            }
    }
    public function cleanArray($post){
        $data = [];
        foreach($post as $key=>$value){
           switch($key){
               case 'cmstitle':
                  $data['cmsPageTitle']  = $value;
               break;
               case 'cmsstatus':
                    $data['cmsPageStatus']  = $value;
                break;
                case 'cmscontent':
                    if($value != ""){
                        $data['cmsPageContent']  = $value;
                    }
                break;
           }
        }
        return $data;
    }
}
