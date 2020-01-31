<?php

$filename ='1.txt';
$fileR = fopen($filename,'r');
$read = fread($fileR,filesize($filename)); 
$csvValues = explode(',', $read);
// print_r($csvValues);
foreach($csvValues as $values){
    echo $values."<br>";
}
fclose($fileR);



?>