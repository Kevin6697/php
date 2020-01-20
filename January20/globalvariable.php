<?php

$a = 1;
function f1()
{
	$a = 1;
	echo $a;
	echo"<br/>";
	echo "After variable  converted to global variable";
	echo"<br/>";
	global $a;
	$a++;
}
f1();
echo $a;
echo"<br/>";

$userip = $_SERVER['REMOTE_ADDR'];
echo "Before Function Calling".$userip."<br>";
function ip()
{
	global $userip;
	echo "Inside Function ".$userip."<br>";
	$userip++;
	echo "After Some Manipulation ".$userip."<br>";
}
ip();
echo "After Function Calling".$userip."<br>";
echo"<br/>";
?>