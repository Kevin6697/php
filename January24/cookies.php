<?php
setcookie('name','Kevin',time()+3600);
echo $_COOKIE['name'];

echo date('h:i:s',strtotime(+3600));
?>