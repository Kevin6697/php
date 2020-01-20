<?php

	for($i = 1 ; $i <= 5 ; $i++)
	{
		echo $i."<br/>";
	}
	echo "<br/>";

	for($i = 1 ; $i <= 5 ; $i++)
	{
		for($j = 1 ; $j <= $i ; $j++)
		{
				echo"*";
		}
		echo "<br/>";
	}
	echo "<br/>";	

	for($i = 5 ; $i >= 1 ; $i--)
	{
		
		for($j = $i ; $j >= 1 ; $j--)
		{
				echo"*";
		}
		echo "<br/>";
	}
	echo "<br/>";


	for($i = 1 ; $i <= 5 ; $i++)
	{
		for ($k = 1 ; $k <= 5 - $i ; $k++)
		{ 
			echo "&nbsp";
		}
		for($j = 1 ; $j <= $i ; $j++)
		{
				echo"*";
		}
		echo "<br/>";
	}
	echo "<br/>";

	for($i = 5 ; $i >= 1 ; $i--)
	{

		for ($k = 1 ; $k <= 5-$i ; $k++)
		{ 
			echo "&nbsp";
		}
		for($j = 1 ; $j <= $i ; $j++)
		{
			echo"*";
		}
		echo "<br/>";
	}
	echo "<br/>";

	for($i = 1; $i <= 5; $i++)
	{
		for ($k = 1; $k <= 5 - $i; $k++)
		{ 
			echo "&nbsp";
		}
		for($j = 1; $j <= $i; $j++)
		{
				echo"*";
		}
		echo "<br/>";
	}
	for($i = 5; $i >= 1; $i--)
	{

		for ($k = 1; $k <= 5-$i; $k++)
		{ 
			echo "&nbsp";
		}
		for($j = 1; $j <= $i; $j++)
		{
			echo"*";
		}
		echo "<br/>";
	}

?>