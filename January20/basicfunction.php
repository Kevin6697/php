<?php

function f1()
{
	f2();
	echo "Function 1 called<br/>";
}
function f2()
{
	echo "Function 2 called<br/>";
}
f1();
f2();


function add()
{
	$a = 10;
	$b = 20;
	$c = $a + $b;
	echo "$a + $b = $c";
}
add();

?>