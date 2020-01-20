<?php

	$a = 1;
	$b = 1;
	$c = "1";
	if($a === $b)
	{
		echo "Matched Properly";
	}

	if($a === $c)
	{
		echo "$c matched Properly";
	}
	else if($c !== $a)
	{
		echo '$c not matched Properly';	
	}


?>