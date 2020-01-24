
<?php
   
   $offset = 0;
  if(isset($_POST['submit'])){
   $user_input = $_POST['userValue'];
   $find = $_POST['find'];
   $replace = $_POST['replace'];
   $length = strlen($find);
//    $user_input_new = str_replace($find, $replace, $user_input);
//    echo $user_input_new;
    while($strpos = strpos($user_input, $find, $offset)){
        $user_input = substr_replace($user_input, $replace, $strpos, $length);    
        $offset = $strpos + $length ;
    }
}
 
 ?>

<!DOCTYPE HTML>
    <html>
        <head></head>
        <body>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <textarea name=userValue rows=5 cols=20><?php if(isset($user_input)){echo $user_input;} ?></textarea>
                <br/><br/>
                <input type=text name=find placeholder="find" value=<?php if(isset($_POST['find'])){echo $_POST['find'];} ?>>
                <br/><br/>
                <input type=text name=replace placeholder="replace" value=<?php if(isset($_POST['replace'])){echo $_POST['replace'];} ?>>
                <br/><br/>
                <input type=submit name=submit value=submit>
            </form>
        </body>
    </html>
    