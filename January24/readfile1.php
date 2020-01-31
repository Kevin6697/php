<?php

$filename="read.txt";

$file=fopen($filename,'r');
echo $read=fread($file, filesize($filename));
fclose($file);
// echo"<br>";
// $explode_demo=explode('@',$read);
// print_r(implode(',',$explode_demo));
// echo"<br>";
// print_r($explode_demo);	
// $file=fopen($filename,'w');
// echo $read=fwrite($file,"Demo");
// fclose($file);

// $file=fopen($filename,'a');
// echo $read=fwrite($file,"Demo");
// fclose($file);

$reading=file($filename);
foreach ($reading as $key) {
	# code...
	echo"<br>";
	echo "New : ".$key;
}
?>