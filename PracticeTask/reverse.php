<?php

$number = 123;
$reverse=0;
echo "Reverse Number of $number  is : ";
while($number >= 1){
    $mod = $number % 10;
    $reverse = ($reverse*10) + $mod ;
    $number = $number / 10;
}
echo "$reverse";

?>