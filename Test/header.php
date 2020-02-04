  <?php
        if(!isset($_SESSION['custId'])){
            header("Location: index.php");
        }
    ?>
    <br/>
    <a href="blogpost.php" class="likeabutton">Manage Post</a> 
    <a href="viewCategory.php" class="likeabutton">Manage Category</a>
    <a href="manageProfile.php" class="likeabutton">Manage Profile</a>
    <a href="logout.php" class="likeabutton">Logout</a>
    <br/><br/>
