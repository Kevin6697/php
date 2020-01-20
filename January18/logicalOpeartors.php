<?php

	$a = 100;
	$b = 200;
	$c = 300;

	echo 8 << 1;
	echo"<br/>";
	echo 8 >> 1;
	echo"<br/>";
	if($a > $b && $a > $c)
	{
		echo "$a is max";
	}
	elseif($b > $a && $b > $c)
	{
		echo "$b is max";
	}
	else
	{
		echo "$c is max";
	}
	echo"<br/>";

	if($a > $b || $a > $c)
	{
		echo "$a is max";
	}
	elseif($b > $a || $b > $c)
	{
		echo "$b is max";
	}
	else
	{
		echo "$c is max";
	}
	echo"<br/>";
	
	if(!($a == $b))
	{
		echo "$a and $b are not equal";
	}

?>