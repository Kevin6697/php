<?php

$userip=$_SERVER['REMOTE_ADDR'];
function hit_count($userip)
{
	$filename = 'ip.txt';
	$handle = file($filename);
	$boolean = 'false';
	foreach ($handle as $key) 
	{
		$key = trim($key);
		if($userip == $key)
		{
			$boolean = 1;
			break;
		}
		else
		{
			$boolean = 0;	
		}
	}
	if($boolean == 0)
	{
		$file = fopen($filename,'a');
		fwrite($file,"\n");
		fwrite($file,$userip);
		fclose($file);
		
		$readcount = file('count.txt');
		$count_inc = 1;
		foreach ($readcount	as $key) {
			$count_inc = $key+1;
		}
		$file=fopen('count.txt','w');
		fwrite($file,$count_inc);
		fclose($file);
		echo"New IP Added Succesfully";
	}
	else
	{
		echo"Found";
	}
}
hit_count($userip);

?>