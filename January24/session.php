<?php
    session_start();
    if(isset($_POST['login'])){
        if(empty($_POST['username']) && empty($_POST['password'])){
            echo "All fields are required";
        }else{
            $_SESSION['username'] = $_POST['username'];
            header('Location: displaySession.php');
        }
    }

?>
<!DOCTYPE HTML>
    <html>
        <head></head>
        <body>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <input type=username name=username placeholder="Username">
                <br/><br/>
                <input type=password name=password placeholder="password">
                <br/><br/>
                <input type=submit name=login value="Login">     
            </form>
        </body>
    </html>
