<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Update Category</title>
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
    $tableName =["category"];
    $field = ["*"];
    $where = "catId = ".$_GET['id'];
    $obj = new DBConfig;
    $data = $obj->fetchRow($where, $field,$tableName);
    $_SESSION['dataObj'] = mysqli_fetch_assoc($data);
    ?>
    <h1>Category Update</h1>
    <form method=post action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" >
    <table>
             <tr>
                 <td>
                    Title :
                 </td>
             </tr>
             <tr>
                <td>
                <input type="hidden" name="categoryUpdate[catId]" value=<?php echo getValues("categoryUpdate","catId");?> >
                   <input type="text" name="categoryUpdate[title]" value="<?php echo getValues("categoryUpdate","title");?>" >
                </td>
            </tr>
            <tr>
                <td>
                    Content :
                </td>
            </tr>
            <tr>
               <td>
               <textarea  rows=8 cols=20 name="categoryUpdate[content]"><?php echo getValues("categoryUpdate","content"); ?></textarea>
               </td>
           </tr>
           <tr>
                <td>
                    URL :
                </td>
            </tr>
            <tr>
               <td>
               <textarea  rows=8 cols=20 name="categoryUpdate[url]"><?php echo getValues("categoryUpdate","url"); ?></textarea>
               </td>
           </tr>
           <tr>
                <td>
                    Meta Title :
                </td>
            </tr>
            <tr>
               <td>
               <input type="text" name="categoryUpdate[meta]" value="<?php echo getValues("categoryUpdate","meta");?>" >
               </td>
           </tr>
           <tr>
                <td>
                    Parent Id :
                </td>
            </tr>
            <tr>
               <td>
                   <select name="categoryUpdate[parentId]"> 
                <?php
                     $tableName = ['category']; 
                     $field = ['catId','catTitle','parentCatId'];
                     $where = "1";
                     $obj = new DBConfig;
                    $resultId = $obj->fetchRow($where, $field, $tableName);  
                    if(mysqli_num_rows($resultId) >= 0){
                        while($dataId = mysqli_fetch_assoc($resultId)){
                            $selected = in_array(getValues("categoryUpdate","parentId"),[$dataId['catId']]) ? "selected" : "";
                            echo "<option " . $selected." value =".$dataId['catId']." >".$dataId['catTitle'];
                            echo"</option>";
                        }
                     }
                        echo "<option value =''>No Parent Id<option>";
                    
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
               <input type="submit" value="update" name="updateCat">
             </td>
        </tr>
        </table>
    </form>
<?php
    if(isset($_POST['updateCat'])){
      passUpdateCategory('categoryUpdate', $_POST['categoryUpdate']['catId']);
  }
?>    
  </body>  
</html>
