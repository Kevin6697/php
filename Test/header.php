<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Registration Page</title>
  </head>
  <body>
  <?php
        if(!isset($_SESSION['custId'])){
            header("Location: index.php");
        }
    ?>
    <a href="viewCategory.php">Manage Category</a> <br>   
    <a href="manageProfile.php">Manage Profile</a><br>
    <a href="logout.php">Logout</a>
</body>
</html>