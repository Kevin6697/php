<?php

$number1 = 0;
$number2 = 1;
$count = 10;

echo "Fibonnacci Series is :";

while($count > 0){
    echo $number1;
    if($count != 1){
        echo ",";
    }
    $tmp = $number1;
    $number1 = $number1 + $number2 ;
    $number2 =$tmp ;
    $count--;
}

?>