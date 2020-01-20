<?php  

$a = 100;
$b = 200;
$c = 300;


if($a <= 10)
{
	echo "Number less than 10";
}
elseif($a > 10 && $a <= 20)
{
	echo "Number greater than equal to 10";
}
elseif($a > 20 && $a <= 30)
{
	echo "Number greater than equal to 20";	
}
else
{
	echo "Number greater than equal to 30";
}
echo"<br/>";

if($a > $b && $a > $c)
{
	echo "$a is maximum";
}
elseif($b > $a && $b > $c)
{
	echo "$b is maximum";
}
else
{
	echo "$c is maximum";
}
echo"<br/> &nbsp&nbsp&nbsp and <br/>";

if($a < $b && $a < $c)
{
	echo "$a is minimum";
}
elseif($b < $a && $b < $c)
{
	echo "$b is minimum";
}
else
{
	echo "$c is minimum";
}

$a = 1;
while($a)
{
	if($a > 5)
	{
		echo"After 5 loop will be breaked";
		break;
	}
	elseif($a == 4)
	{
		echo"Currently at $a<br>";
	}
	else
	{
		echo "$a<br/>";
	}
	$a++;
}
for($a = 1;$a <= 5;$a++)
{
	if($a >= 5)
	{
		echo"After 5 loop will be breaked";
		break;
	}
	elseif($a == 4)
	{
		echo"Currently at $a<br/>";
	}
	else
	{
		echo "$a<br/>";
	}
}

?>