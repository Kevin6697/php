<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Registration Page</title>
  </head>
  <body>
    <?php
     require_once 'controller.php'; 
    ?>
    <?php
        if(isset($_SESSION['custId'])){
            header("Location: index.php");
        }
    ?>
    <h1>Registration</h1>
    <form method=post action=<?php $_SERVER['PHP_SELF'];?>>
      <table>
        <tr>
          <td>
            Prefix :
          </td>
        </tr>
        <tr>
          <td>
            <select name="register[prefix]">
            <?php
              $prefix = ['Mr.','Miss.','Mrs.','Dr'];
              foreach($prefix as $value):
              $selected = in_array(getValues("register","prefix"), [$value]) 
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
            <input type="text" name="register[firstname]" 
            value="<?php echo  getValues("register","firstname");?>" />
          </td>
        </tr>
        <tr>
          <td>
            Last Name :
          </td>
        </tr>
        <tr>
          <td>
            <input type="text" name="register[lastname]" value="<?php echo  getValues("register","lastname");?>" />
          </td>
        </tr>
        <tr>
          <td>
            Email :
          </td>
        </tr>
        <tr>
          <td>
            <input type="text" name="register[email]"  value="<?php echo  getValues("register","email");?>" />
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
            <input type="text" name=register[number] value="<?php echo  getValues("register","number");?>"/>
          </td>
        </tr>
        <tr>
          <td>
            Password :
          </td>
        </tr>
        <tr>
          <td>
            <input type="password" name="register[password]" />
          </td>
        </tr>
        <tr>
          <td>
            Confirm Password :
          </td>
        </tr>
        <tr>
          <td>
            <input type="password" name="register[cnfPwd]" />
          </td>
        </tr>

        <tr>
          <td>
            Information :
          </td>
        </tr>
        <tr>
          <td>
            <textarea name="register[information]"></textarea>
          </td>
        </tr>

        <tr>
          <td></td>
        </tr>
        <tr>
          <td>
            <input type="checkbox" name="register[check]" checked />Hereby, I
            accept terms and conditions
          </td>
        </tr>
        <tr>
          <td>
            <input type="submit" value="register" name="reg" />
          </td>
        </tr>
      </table>
    </form>
<?php
    if(isset($_POST['reg'])){
      passRegistrationValues('register');
  }
?>    
  </body>  
</html>
