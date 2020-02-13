<?php

namespace Apps\Controllers;

use \Core\View;
use Apps\Models\Post;
 
class Posts extends \Core\Controller{

    public function indexAction(){
        $posts = Post::getAll();
        View::renderTemplate('posts/index.html',[
            'postsAll' => $posts
        ]);
    }
    public function newAction(){
        extract($_POST);
        $q = "insert into posts (postTitle, postContent) values('$txt1', '$ta1')";
        $status = Post::insert($q);
        if($status){
            $_SESSION['errorMessage'] = "Inserted Successfully"; 
        }else{
            $_SESSION['errorMessage'] = "Error while adding";
        }
        $redirect =$_SESSION['base_url'].'/public/posts/index';
        header("Location:$redirect");
    }
    public function deleteAction(){
        extract($_POST);
        $q = "delete from posts where postId =$id";
        $status = Post::delete($q);
        if($status){
            $_SESSION['errorMessage'] = "Deleted Successfully"; 
        }else{
            $_SESSION['errorMessage'] = "Error while deleting";
        }
        $redirect =$_SESSION['base_url'].'/public/posts/index';
        header("Location:$redirect");
    }
    public function fetchEditAction(){
        $id = $this->route_params['id'];
        $query = "select * from posts where postId = $id ";
        $postsRow = Post::fetchRow($query);
        $postsAll = Post::getAll();
        View::renderTemplate('posts/edit.html',[
            'postsUpdate' => $postsRow,
            'postsAll' =>$postsAll,
            'base_url' =>dirname($_SERVER['SCRIPT_NAME'])
        ]);
    }
    public function editAction(){
        extract($_POST);
         $q = "update posts set postTitle = '$txt1', postContent = '$ta1' where postId = $id";
       $status = Post::update($q);
        if($status){
            $_SESSION['errorMessage'] = "Updated Successfully"; 
        }else{
            $_SESSION['errorMessage'] = "Error while updating";
        }
        $redirect =$_SESSION['base_url'].'/public/posts/index';
        header("Location:$redirect");
    }
}