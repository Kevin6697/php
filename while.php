<?php

    $a = 0;
    while($a <= 10)
    {
    	echo $a."<br/>";
    	$a++;
    }


    $sum = 12345678910;
    $ans = 0;
    while($sum != 0)
    {
    	$a = $sum % 10;
    	$ans = $ans + $a;
    	$sum = $sum / 10;
    }
    echo $ans;


    $sum = 123456789;
    $ans = 0;
    $count = strlen($sum);
    while($count != 0)
    {
    	$a = $sum % 10;
    	$ans = $ans * 10 + $a;
    	$sum = intval($sum / 10);
    	$count--;
    }
    echo $ans."<br/>";


    $sum = 153;
    $ans = 0;
    $tmp = $sum;
    $count = strlen($sum);
    while($count != 0)
    {
    	$a = $sum % 10;
    	$ans = $ans + ($a * $a * $a);
    	$sum = intval($sum / 10);
    	$count--;
    }
    if($tmp == $ans)
    {
    	echo"Armstrong";
    }
    else
    {
    	echo "Not Armstrong";
    }
    echo"<br/>";

    $a = 0;
    $b = 1;
    $count = 0;
    while($count != 12)
    {
    	echo $a."<br/>";
    	$c = $a;
    	$a = $a + $b;
    	$b = $c;
    	$count++;
    }


    $n = 5;
    $ans = 1;
    while($n != 0)
    {
    	$ans = $ans * $n;
    	$n--;
    }
    echo $ans;

    $num = 20;
    $i = 1;
    while($i != $num)
    {
    	if($num % $i == 0)
    	{
    		echo $i."<br/>";
    	}
    	$i++;
    }

    $num = 123456789012;
    $count = 0;
    while($num != 0)
    {
        $num = intval($num / 10);
        $count++;
    }
    echo $count;

?>