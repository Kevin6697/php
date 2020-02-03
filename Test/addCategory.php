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
    ?>
    <h1>Add New Category</h1>
    <form action=<?php echo $_SERVER['PHP_SELF'];?> method="post" enctype="multipart/form-data">
        <table>
             <tr>
                 <td>
                    Title :
                 </td>
             </tr>
             <tr>
                <td>
                   <input type="text" name="category[title]" value=<?php echo getValues("category","title");?> >
                </td>
            </tr>
            <tr>
                <td>
                    Content :
                </td>
            </tr>
            <tr>
               <td>
               <input type="text" name="category[content]" value=<?php echo getValues("category","content");?> >
               </td>
           </tr>
           <tr>
                <td>
                    URL :
                </td>
            </tr>
            <tr>
               <td>
               <input type="text" name="category[url]" value=<?php echo getValues("category","url");?> >
               </td>
           </tr>
           <tr>
                <td>
                    Meta Title :
                </td>
            </tr>
            <tr>
               <td>
               <input type="text" name="category[meta]" value=<?php echo getValues("category","meta");?> >
               </td>
           </tr>
           <tr>
                <td>
                    Parent Id :
                </td>
            </tr>
            <tr>
               <td>
                   <select name="category[parentId]"> 
                <?php
                     $tableName = 'category'; 
                     $field = ['catId','catTitle','parentCatId'];
                     $where = "1";
                     $obj = new DBConfig;
                     $resultId = $obj->fetchRow($where, $field, $tableName);  
                     if(mysqli_num_rows($resultId) <= 0){
                        echo "<option value =".NULL."><option>";
                     }else{
                        while($dataId = mysqli_fetch_assoc($resultId)){
                            echo "<option value =".$dataId['catId'].">".$dataId['catTitle']."<option>";
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
               <input type="submit" value="category" name="cat">
             </td>
        </tr>
        </table>
     </form>
<?php
    if(isset($_POST['cat'])){
        passCategoryValues('category',$_FILES);
    }
?>



   </body>
</html>    