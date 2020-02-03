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
    
    $result = displayCategory(); 
    if(mysqli_num_rows($result) <= 0){
        echo "<br/>No Data Found";
    }else{
    ?>
    <table>
        <th> Id</th>
        <th> Parent Id</th>
        <th> Title</th>
        <th> Meta Title </th>
        <th> url</th>
        <th> content</th>
        <th> Image</th>
        <th> Created At</th>
        <th> Updated At</th>
        <th Colspan =2> Action</th>
    <?php    
        while($data = mysqli_fetch_assoc($result)){
    ?>
        <tr>
            <td><?=  $data['catId'];?></td>
            <td><?=  $data['parentCatId'];?></td>
            <td><?=  $data['catTitle'];?></td>
            <td><?=  $data['catMetaTitle'];?></td>
            <td><?=  $data['catUrl'];?></td>
            <td><?=  $data['catContent'];?></td>
            <td><img src = "uploads/<?=  $data['catFile'];?>" height=100 width=100></td>
            <td><?=  $data['catCreatedAt'];?></td>
            <td><?=  $data['catUpdatedAt'];?></td>
            <td><a href='updateCateogry.php?id=<?=  $data['catId'];?>'>Update</a></td>
            <td><a href='viewCategory.php?catId=<?=  $data['catId'];?>'>Delete</a></td>
        </tr>    
    <?php
        }
    }
    ?>
    </table>
    <br>
    <a href="addCategory.php">Add New Category</a>
<?php
    if(isset($_GET['catId'])){
        deleteCategory($_GET['catId']);
    }


?>

  </body>  
</html>
  