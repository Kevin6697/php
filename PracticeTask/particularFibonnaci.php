<?php

$number = 5;

function fibbo($num){
    if($num <= 2){
        return 1;
    }
    return fibbo($num - 1) + fibbo($num - 2);
}
echo "Fibonnaci for 5<sup>th</sup> series is : ".fibbo($number);

?>