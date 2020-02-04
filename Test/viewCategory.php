<!DOCTYPE html>
<html lang="en">
  <head>
    <title>View Category</title>
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
    
    $result = displayCategory(); 
    if(mysqli_num_rows($result) <= 0){
        echo "<br/>No Data Found";
    }else{
    ?>
    
    <br>
    <a href="addCategory.php" class='likeabutton'>Add New Category</a>
    <br><br>
    <table border=2 cellpadding=10>
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
            <td><?php
                    if($data['parentCatId'] == ""){
                        echo "-";
                    }else{
                        echo $data['parentCatId'];   
                    }
                ?></td>
            <td><?=  $data['catTitle'];?></td>
            <td><?=  $data['catMetaTitle'];?></td>
            <td><?=  $data['catUrl'];?></td>
            <td><?=  $data['catContent'];?></td>
            <td><img alt="Category" src="uploads/<?=  $data['catFile'];?>" height=100 width=100></td>
            <td><?=  $data['catCreatedAt'];?></td>
            <td><?=  $data['catUpdatedAt'];?></td>
            <td><a class='likeabutton'  href='updateCategory.php?id=<?=  $data['catId'];?>'>Update</a></td>
            <td><a class='likeabutton' href='viewCategory.php?catId=<?=  $data['catId'];?>'>Delete</a></td>
        </tr>    
    <?php
        }
    }
    ?>
    </table>
<?php
    if(isset($_GET['catId'])){
        deleteCategory($_GET['catId']);
    }


?>

  </body>  
</html>
  