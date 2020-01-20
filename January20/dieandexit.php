<?php

for ($i = 0; $i <= 5; $i++) 
{ 
	echo $i." ";
	if($i == 3)
	{
		die("Error while looping");
	}
}


die();
@$q = mysqli_connect("localhost","root","","test") or exit("Could not connect to the database");
exit();

?>