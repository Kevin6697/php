<?php

	$d = date('D');
	if($d == "Fri" || $d == "Sat" || $d == "Sun")
	{
		echo "It is also most weekend it is ".$d."<br>";
	}
	else
	{
		echo "Go to work ".$d."<br>";	
	}

	$age="19";
	if($age >= 18)
	{
		echo"You are mature";
	}
	else
	{
		echo "You are a teenegar";
	}
	echo"<br/>";

	if(1)
	{
		echo"1";
	}
	else
	{
		echo "0";
	}
	echo"<br/>";

	if(1 == TRUE)
	{
		echo"1";
	}
	else
	{
		echo "0";
	}
	echo"<br/>";

	if(1 === TRUE)
	{
		echo"1";
	}
	else
	{
		echo "0";
	}

	$a = 1;
	while($a)
	{
		if($a > 5)
		{
			echo"After 5 loop will be breaked<br>";
			break;
		}
		else
		{
			echo "$a<br/>";
		}
		$a++;
	}

	for($b = 1;$b <= 10;$b++)
	{
		if($b >= 5)
		{
			echo"After 5 loop will be breaked";
			break;
		}
		else
		{
			echo "$b<br/>";
		}
	}

?>