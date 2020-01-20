<?php

	$number = 1;
	switch ($number) 
	{
		case 1:
			echo"Number One";
			break;
		
		default:
			echo"Not One";
			break;
	}
	echo"<br/>";

	$number = 4;
	switch ($number) 
	{
		case 1:
			echo"Number One";
			break;

		case 2:
			echo"Number Two";
			break;	
		
		case 3:
			echo"Number Three";
			break;	

		default:
			echo"Not One Two or Three";
			break;
	}
	echo"<br/>";	


	$number = 4;
	switch ($number) 
	{
		case 1:
		case 4:
			echo"Number One or Four";
			break;

		case 2:
			echo"Number Two";
			break;	
		
		case 3:
			echo"Number Three";
			break;	

		default:
			echo"Not One Two Three or Four";
			break;
	}
	echo"<br/>";

	$string = "1";
	switch ($string) 
	{
		case 1:
			echo"Integer Number One";
			break;

		case "1":
			echo"String Number One";
			break;

		default:
			echo"Not One";
			break;
	}
	echo"<br/>";	


	$string = "1";
	switch ($string) 
	{
		case "1":
			echo"String Number One";

		case 1:
			echo"Integer Number One";

		default:
			echo"Not One";
	}

?>