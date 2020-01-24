<?php
    if(isset($_POST['submit'])){
        echo "You rolled :".rand(1,6);
    }
    echo"<br/>";
    echo "max random number : ".getrandmax();
    echo"<br/>";
    echo " random number : ".rand();
?>
<!DOCTYPE HTML>
    <html>
        <head></head>
        <body>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <input type=submit name=submit value=submit>
            </form>
        </body>
    </html>