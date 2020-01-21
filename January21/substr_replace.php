<?php

$string1 = "This is a String";
// echo substr($string1,-6);
echo"<br/>";
echo "---substr_replace--";
echo"<br/>";
echo substr_replace($string1,'Stringify',-8);
echo"<br/>";
echo substr_replace($string1,' 10',16);
echo"<br/>";
echo substr_replace($string1,'Hello',-6);
echo"<br/>";
var_dump(substr_replace(1234.5,5,4));
echo"<br/>";




?>