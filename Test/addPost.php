<!DOCTYPE html>
<html lang="en">
  <head>
      <title>Add New Category</title>
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
    ?>
    <h1>Add New blogpost</h1>
    <form action=<?php echo $_SERVER['PHP_SELF'];?> method="post" enctype="multipart/form-data">
        <table>
             <tr>
                 <td>
                    Title :
                 </td>
             </tr>
             <tr>
                <td>
                   <input type="text" name="blogpost[postTitle]" value=<?php echo getValues("blogpost","postTitle");?> >
                </td>
            </tr>
            <tr>
                <td>
                    Content :
                </td>
            </tr>
            <tr>
               <td>
               <textarea  rows=8 cols=20 name="blogpost[postContent]"><?php echo getValues("blogpost","postContent");?></textarea>
               </td>
           </tr>
           <tr>
                <td>
                    URL :
                </td>
            </tr>
            <tr>
               <td>
               <textarea  rows=8 cols=20 name="blogpost[postURL]"><?php echo getValues("blogpost","postURL");?></textarea>
               </td>
           </tr>
           <tr>
                <td>
                    Published At :
                </td>
            </tr>
            <tr>
               <td>
               <input type="date" name="blogpost[postPublish]" value=<?php echo getValues("blogpost","postPublish");?> >
               </td>
           </tr>
           <tr>
                <td>
                    Category:
                </td>
            </tr>
            <tr>
               <td>
                   <select name="blogpost[categoryId][]" multiple>
                <?php
                     $tableName = ['category']; 
                     $field = ['catId','catTitle'];
                     $where = "1";
                     $obj = new DBConfig;
                     $resultId = $obj->fetchRow($where, $field, $tableName); 
                     if(mysqli_num_rows($resultId) >= 0){
                        while($dataId = mysqli_fetch_assoc($resultId)){
                            $selected = array_intersect(getValues('blogpost','categoryId',[]),[$dataId['catId']]) ? "selected" : "";
                            echo "<option ". $selected ." value =".$dataId['catId'].">".$dataId['catTitle'];
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
               <input type="submit" value="Blog" name="blog">
             </td>
        </tr>
        </table>
     </form>
<?php
    if(isset($_POST['blog'])){
        passpostValues('blogpost',$_FILES);
    }
?>



   </body>
</html>    