<!DOCTYPE html>
<html lang="en">
  <head>
    <title>My Profile Page</title>
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
    $tableName =["user"];
    $field = ["*"];
    $where = "custId = ".$_SESSION['custId'];
    $obj = new DBConfig;
    $data = $obj->fetchRow($where, $field,$tableName);
    $_SESSION['dataObj'] = mysqli_fetch_assoc($data);
    ?>
    <h1>Profile Update</h1>
    <form method=post action=<?php $_SERVER['PHP_SELF'];?>>
      <table>
        <tr>
          <td>
            Prefix :
          </td>
        </tr>
        <tr>
          <td>
            <select name="profileUpdate[prefix]">
            <?php
              $prefix = ['Mr.','Miss.','Mrs.','Dr'];
              foreach($prefix as $value):
              $selected = in_array(getValues("profileUpdate","prefix"), [$value]) 
                          ? "Selected"
                          : ""; 
            ?>
            <option value=<?= $value;?> <?=$selected;?>><?= $value;?>
            <?php endforeach; ?>
          </td>
        </tr>

        <tr>
          <td>
            First Name :
          </td>
        </tr>
        <tr>
          <td>
          <input type="text" name="profileUpdate[firstname]" 
            value="<?php echo  getValues("profileUpdate","firstname");?>" />  
          <input type="hidden" name="profileUpdate[custId]" 
            value="<?php echo  getValues("profileUpdate","custId");?>" />

          </td>
        </tr>
        <tr>
          <td>
            Last Name :
          </td>
        </tr>
        <tr>
          <td>
            <input type="text" name="profileUpdate[lastname]" value="<?php echo  getValues("profileUpdate","lastname");?>" />
          </td>
        </tr>
        <tr>
          <td>
            Email :
          </td>
        </tr>
        <tr>
          <td>
            <input type="text" name="profileUpdate[email]"  value="<?php echo  getValues("profileUpdate","email");?>" />
          </td>
        </tr>
        <tr></tr>
        <tr>
          <td>
            Mobile Number :
          </td>
        </tr>
        <tr>
          <td>
            <input type="text" name=profileUpdate[number] value="<?php echo  getValues("profileUpdate","number");?>"/>
          </td>
        </tr>
        <tr>
          <td>
            Information :
          </td>
        </tr>
        <tr>
          <td>
            <textarea name="profileUpdate[information]"><?php echo  getValues("profileUpdate","information");?></textarea>
          </td>
        </tr>

        <tr>
          <td></td>
        </tr>
        <tr>
          <td>
            <input type="submit" value="update" name="update" />
          </td>
        </tr>
      </table>
    </form>
<?php
    if(isset($_POST['update'])){
      passUpdateValues('profileUpdate', $_POST['profileUpdate']['custId']);
  }
?>    
  </body>  
</html>
