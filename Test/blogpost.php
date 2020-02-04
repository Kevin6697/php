<!DOCTYPE html>
<html lang="en">
  <head>
    <title>View Blog Posts</title>
    <style>
        @import url('style.css');
    </style>
  </head>
  <body>

    <?php
        session_start();
        if(!isset($_SESSION['custId'])){
            header("Location: index.php");
        }
        require_once 'header.php';
        require_once 'controller.php';
        unset($_SESSION['dataObj']);
    $result = displayBlog(); 
    if(mysqli_num_rows($result) <= 0){
        echo "<br/>No Data Found";
    }else{
    ?>
    
    <br>
    <a href="addPost.php" class="likeabutton">Add New Post</a>
    <br/><br/>
    <br/><br/>
    <table class="displayTable">
        <th class="displayTable"> Id</th>
        <th class="displayTable"> Title</th>
        <th class="displayTable"> URL</th>
        <th class="displayTable"> Content</th>
        <th class="displayTable"> Category</th>
        <th class="displayTable"> Image</th>
        <th class="displayTable"> Published At</th>
        <th class="displayTable"> Created At</th>
        <th class="displayTable"> Updated At</th>
        <th class="displayTable" Colspan =2> Action</th>
    <?php    
        while($data = mysqli_fetch_assoc($result)){
    ?>
        <tr>
            <td class="displayTable"><?=  $data['postId'];?></td>
           <td class="displayTable"><?=  $data['postTitle'];?></td>
            <td class="displayTable"><?=  $data['postUrl'];?></td>
            <td class="displayTable"><?=  $data['postContent'];?></td>
            <td class="displayTable">
                <?php
                    $categoryPost = displayCategoryPost($data['postId']);
                    while($cpData = mysqli_fetch_assoc($categoryPost)){ 
                        echo $cpData['catTitle']."<br/>";    
                    }
                ?>
            </td>
            <td class="displayTable"><img alt="Blog Post" src = "uploads/<?=  $data['postImage'];?>" height=100 width=100></td>
            <td class="displayTable"><?=  $data['postPublishedAt'];?></td>
            <td class="displayTable"><?=  $data['postCreatedAt'];?></td>
            <td class="displayTable"><?=  $data['postUpdatedAt'];?></td>
            <td class="displayTable"><a class="likeabutton" href='updateBlogPost.php?postId=<?=  $data['postId'];?>'>Update</a></td>
            <td class="displayTable"><a class="likeabutton" href='blogpost.php?postId=<?=  $data['postId'];?>'>Delete</a></td>
        </tr>    
    <?php
        }
    }
    ?>
    </table>
<?php
    if(isset($_GET['postId'])){
        deletePost($_GET['postId']);
    }


?>

  </body>  
</html>
  