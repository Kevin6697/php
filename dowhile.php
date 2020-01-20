<?php

    $a = 0;
    do
    {
    	echo $a."<br>";
    	$a++;
    }while($a <= 1);

    $sum = 12345678910;
    $ans = 0;
    do{
    	$a = $sum % 10;
    	$ans = $ans + $a;
    	$sum = $sum / 10;
    }while($sum != 0);
    echo $ans;


    $sum = 123456789;
    $ans = 0;
    $count = strlen($sum);
    do
    {
    	$a = $sum % 10;
    	$ans = $ans * 10 + $a;
    	$sum = intval($sum / 10);
    	$count--;
    }while($count != 0);
    echo $ans;

?>