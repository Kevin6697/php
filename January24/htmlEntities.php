<?php
 if(isset($_POST['htmlenities'])){
     $date = htmlentities($_POST['date']);
     $month = htmlentities($_POST['month']);     
     $year = htmlentities($_POST['year']);
    echo "Your entered date is $date-$month-$year";
}

?>
<!DOCTYPE HTML>
    <html>
        <head></head>
        <body>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <input type=text name=date placeholder="date">
                <br/><br/>
                <input type=text name=month placeholder="month">
                <br/><br/>
                <input type=text name=year placeholder="year">
                <br/><br/>
                <input type=submit name=htmlenities value="Submit">
                
            </form>
        </body>
    </html>
