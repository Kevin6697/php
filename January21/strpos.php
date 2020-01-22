<?php

$string1 = "This is a String";
echo "---uage of string position---";
echo "<br/>";
$find = 'is';
$length = strlen($find);
$offset = 0;
echo strpos($string1, 'is');
echo"<br/>";
//3rd parameter as an offset
echo strpos($string1, 'is', 5);
echo"<br/>";
//to find position for all
while($str_pos = strpos($string1,$find,$offset)){
    echo $find." @ position : ".$str_pos."<br/>";
    $offset = $str_pos + $length;
}	

echo"<br/>";
var_dump ("Use of á in string : ",strpos("Fábio", 'b')) ;
echo"<br/>";


?>