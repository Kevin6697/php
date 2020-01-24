<?php
 
 $find = array('alex','billy','dale');
 $replace = array('a**x','b***y','d**e');
  if(isset($_POST['submit']) && !empty($_POST['userValue'])){
   $user_input = $_POST['userValue'];
   $user_input_new = str_ireplace($find, $replace, $user_input);
   echo $user_input_new;
}
 
 ?>   
<!DOCTYPE HTML>
    <html>
        <head></head>
        <body>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <textarea name=userValue rows=5 cols=20><?php if(isset($user_input_new)){echo $user_input_new;} ?></textarea>
                <br/>
                <input type=submit name=submit value=submit>
            </form>
        </body>
    </html>
