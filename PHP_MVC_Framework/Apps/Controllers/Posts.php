<?php

namespace Apps\Controllers;

use \Core\View;
use Apps\Models\Post;
 
class Posts extends \Core\Controller{

    public function indexAction(){
        $posts = Post::getAll();
        // print_r($posts);
        View::renderTemplate('posts/index.html',[
            'posts' => $posts,
            'base_url' =>dirname($_SERVER['SCRIPT_NAME'])
        ]);
    }
    public function newAction(){
        extract($_POST);
        $q = "insert into posts (postTitle, postContent) values('$txt1', '$ta1')";
        $status = Post::insert($q);
        $posts = Post::getAll();
        if($status){
            View::renderTemplate('posts/index.html',[
                'posts' => $posts,
                'base_url' =>dirname($_SERVER['SCRIPT_NAME'])
            ]);
        }else{
            View::renderTemplate('posts/index.html',[
                'posts' => $posts,
                'base_url' =>dirname($_SERVER['SCRIPT_NAME']),
                'errorMessage' =>"Cannot insert"
            ]);
        }
    }
    public function deleteAction(){
        extract($_POST);
        $q = "delete from posts where postId =$id";
        $status = Post::delete($q);
        $posts = Post::getAll();
        if($status){
            View::renderTemplate('posts/index.html',[
                'posts' => $posts,
                'base_url' =>dirname($_SERVER['SCRIPT_NAME'])
            ]);
        }else{
            View::renderTemplate('posts/index.html',[
                'posts' => $posts,
                'base_url' =>dirname($_SERVER['SCRIPT_NAME']),
                'errorMessage' =>"Cannot Delete"
            ]);
        }
    }
    public function editAction(){
        print_r($this->route_params);
    }
}