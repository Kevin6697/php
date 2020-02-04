<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Update Blog</title>
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
         unset( $_SESSION['dataObj']);  
    $tableName =["post"];
    $field = ["*"];
    $where = "postId = ".$_GET['postId'];
    $obj = new DBConfig;
    $data = $obj->fetchRow($where, $field,$tableName);
    $whereCat = "pc.postId = ".$_GET['postId']." and pc.categoryId  = c.catId";
    $dataCatId = $obj->fetchRow($whereCat,['c.catId'],['post_category pc','category c']);
    $_SESSION['dataObj'] = mysqli_fetch_assoc($data);
    $id =[];
    while($cid = mysqli_fetch_assoc($dataCatId)){
        array_push($id,$cid['catId']);
    } 
    $_SESSION['dataSelectedCatId'] = $id;
    ?>
    <h1>Post Update</h1>
    <form method=post action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" >
    <table>
             <tr>
                 <td>
                    Title :
                 </td>
             </tr>
             <tr>
                <td>
                <input type="hidden" name="blogUpdate[postId]" value=<?php echo getValues("blogUpdate","postId");?> >
                   <input type="text" name="blogUpdate[postTitle]" value="<?php echo getValues("blogUpdate","postTitle");?>" >
                </td>
            </tr>
            <tr>
                <td>
                    Content :
                </td>
            </tr>
            <tr>
               <td>
               <textarea  rows=8 cols=20 name="blogUpdate[postContent]"><?php echo getValues("blogUpdate","postContent");?></textarea>
               </td>
           </tr>
           <tr>
                <td>
                    URL :
                </td>
            </tr>
            <tr>
               <td>
               <textarea  rows=8 cols=20 name="blogUpdate[postURL]"><?php echo getValues("blogUpdate","postURL");?></textarea>
               </td>
           </tr>
           <tr>
                <td>
                    Published At :
                </td>
            </tr>
            <tr>
               <td>
               <input type="date" name="blogUpdate[postPublish]" value="<?php echo getValues("blogUpdate","postPublish");?>" >
               </td>
           </tr>
           <tr>
                <td>
                    Category:
                </td>
            </tr>
            <tr>
               <td>
                   <select name="blogUpdate[postCategoryId][]" multiple>
                <?php
                     $tableName = ['category']; 
                     $field = ['catId','catTitle'];
                     $where = "1";
                     $obj = new DBConfig;
                     $resultId = $obj->fetchRow($where, $field, $tableName); 
                     if(mysqli_num_rows($resultId) >= 0){
                        while($dataId = mysqli_fetch_assoc($resultId)){
                            $selected = array_intersect($_SESSION['dataSelectedCatId'],[$dataId['catId']]) ? "selected" : "";
                            echo "<option " .$selected. " value =".$dataId['catId'].">".$dataId['catTitle'];
                        }
                     }
                ?>
                </select>
               </td>
           </tr>
           <tr>
                <td>
                    Image :
                </td>
            </tr>
            <tr>
               <td>
               <input type="file" name="file"  >
               </td>
           </tr>
           <tr>
            <td>
               <input type="submit" value="update" name="updatePost">
             </td>
        </tr>
        </table>
    </form>
<?php
    if(isset($_POST['updatePost'])){
      passUpdatePostBlog('blogUpdate', $_POST['blogUpdate']['postId']);
  }
?>    
  </body>  
</html>