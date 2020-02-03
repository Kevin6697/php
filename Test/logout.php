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
        }else{
            session_destroy();
            header("Location: index.php");
        }
        require_once 'header.php';
    ?>
  
  </body>  
</html>
  