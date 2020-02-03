<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Registration Page</title>
  </head>
  <body>
    <?php
        session_start();
        if(!isset($_SESSION['custId'])){
            header("Location: index.php");
        }
        require_once 'header.php';
        require_once 'controller.php';
    
    $result = displayBlog(); 
    if(mysqli_num_rows($result) <= 0){
        echo "<br/>No Data Found";
    }else{
    ?>
    <table>
        <th> Id</th>
        <th> Customer Id</th>
        <th> Title</th>
        <th> url</th>
        <th> content</th>
        <th> Image</th>
        <th> Published At</th>
        <th> Created At</th>
        <th> Updated At</th>
        <th Colspan =2> Action</th>
    <?php    
        while($data = mysqli_fetch_assoc($result)){
    ?>
        <tr>
            <td><?=  $data['postId'];?></td>
            <td><?=  $data['custId'];?></td>
            <td><?=  $data['postTitle'];?></td>
            <td><?=  $data['postUrl'];?></td>
            <td><?=  $data['postContent'];?></td>
            <td><img src = "uploads/<?=  $data['postImage'];?>" height=100 width=100></td>
            <td><?=  $data['postPublishedAt'];?></td>
            <td><?=  $data['postCreatedAt'];?></td>
            <td><?=  $data['postUpdatedAt'];?></td>
            <td><a href='updateCateogry.php?id=<?=  $data['postId'];?>'>Update</a></td>
            <td><a href='viewCategory.php?catId=<?=  $data['postId'];?>'>Delete</a></td>
        </tr>    
    <?php
        }
    }
    ?>
    </table>
    <br>
    <a href="addPost.php">Add New Post</a>
<?php
    if(isset($_GET['catId'])){
        deleteCategory($_GET['catId']);
    }


?>

  </body>  
</html>
  