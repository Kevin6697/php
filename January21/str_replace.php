<?php

$string1 = "This is a String";
$stringArray = array('red','green','blue','red');

echo"<br/>";
echo"---str_replace---";
echo"<br/>";
echo str_replace("String","Hello",$string1);
echo"<br/>";
echo str_ireplace("string","hello", $string1);
echo"<br/>";
$i = 0;
print_r(str_replace('red','yellow',$stringArray,$i));
echo"<br/>";
echo $i;
echo"<br/>";

?>