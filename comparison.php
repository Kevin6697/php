<?php

$a = 10;
$b = 20;
var_dump($a != $b);


if($a == $b)
{
	echo"use of ==<br/>";
}
if($a <> $b)
{
	echo"use of != or <><br/>";
}
if($a > $b)
{
	echo"use of ><br/>";
}
if($a < $b)
{
	echo"use of <<br/>";
}
if($a >= $b)
{
	echo"use of >=<br/>";
}
if($a <= $b)
{
	echo"use of <=<br/>";
}
echo $a <=> $b;

?>