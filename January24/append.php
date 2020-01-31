<?php

$fileW = fopen('1.txt','a');
fwrite($fileW,"\nHi\n");
fwrite($fileW,"I am fine.");
fwrite($fileW,"How are you ?");
fclose($fileW);

$fileR = fopen('1.txt','r');
while(!feof($fileR)){
    $line = fgets($fileR);
    echo $line."<br>";
}

fclose($fileR);


?>