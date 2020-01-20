<?php

function f1($a)
{
	echo "My name is $a";
}
f1("Kevin");
echo"<br/>";

function myName($a="Kevin")
{
	echo "My name is $a";
}
MyName();
echo"<br/>";

$name = "Kevin";
function f2($a)
{
	echo "My name is $a";
}
f2($name);
echo"<br/>";

function f3($a,$b)
{
	echo "My name is $a $b";
}
f3("Kevin","Shah");
echo"<br/>";

$string = "abc";
function f4(&$str)
{
	$str="d";
}
f4($string);
echo $string;
echo"<br/>";

function f5(...$a)
{
print_r($a);
}
f5('a','b','c',1);
echo"<br/>";

?>