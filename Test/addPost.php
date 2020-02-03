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
                   <input type="text" name="blogpost[title]" value=<?php echo getValues("blogpost","title");?> >
                </td>
            </tr>
            <tr>
                <td>
                    Content :
                </td>
            </tr>
            <tr>
               <td>
               <input type="text" name="blogpost[content]" value=<?php echo getValues("blogpost","content");?> >
               </td>
           </tr>
           <tr>
                <td>
                    URL :
                </td>
            </tr>
            <tr>
               <td>
               <input type="text" name="blogpost[url]" value=<?php echo getValues("blogpost","url");?> >
               </td>
           </tr>
           <tr>
                <td>
                    Published At :
                </td>
            </tr>
            <tr>
               <td>
               <input type="date" name="blogpost[publish]" value=<?php echo getValues("blogpost","publish");?> >
               </td>
           </tr>
           <tr>
                <td>
                    Category:
                </td>
            </tr>
            <tr>
               <td>
                   <select name="blogpost[parentId]" multiple> 
                <?php
                     $tableName = 'category'; 
                     $field = ['catId','catTitle'];
                     $where = "1";
                     $obj = new DBConfig;
                     $resultId = $obj->fetchRow($where, $field, $tableName);  
                     if(mysqli_num_rows($resultId) <= 0){
                         echo "";
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