<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <style>
        @import url('style.css');
    </style>
   </head>
<body>
<?php
     require_once 'controller.php'; 
    
     if(isset($_SESSION['custId'])){
        header("Location: blogpost.php");
    }
?>
    <h1>Login</h1>
    <form action=<?php echo $_SERVER['PHP_SELF'];?> method="post">
        <table>
             <tr>
                 <td>
                    Email :
                 </td>
             </tr>
             <tr>
                <td>
                   <input type="text" name="login[email]" value=<?php echo getValues("login","email");?> >
                </td>
            </tr>
            <tr>
                <td>
                   Password :
                </td>
            </tr>
            <tr>
               <td>
                  <input type="password" name="login[password]">
               </td>
           </tr>
           <tr>
                <td><br/><br/></td>
            </tr>  
            <tr>      
            <td>
               <input type="submit" value="Login" name="log" class="likeabutton">
               <a href="registration.php" class="likeabutton">Register</a>
             </td>
        </tr>
        </table>
     </form>
<?php
  if(isset($_POST['log'])){
      passLoginValues('login');
  }

?>        
</body>
</html>