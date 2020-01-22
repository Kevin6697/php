<?php

$number = 153;
$tmp = $number;
$arm=0;

while($number >= 1){
    $mod = $number % 10;
    $arm = $arm + ($mod * $mod * $mod);
    $number = $number / 10;
}

if($arm == $tmp){
    echo "$tmp is an Armstrong Number";
}else{
    echo "$tmp is not an Armstrong Number";
}

?>