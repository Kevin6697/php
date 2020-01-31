<?php

$fileW = fopen('1.txt','w');
fwrite($fileW,"Hello\n");
fwrite($fileW,"How are you ?");
fclose($fileW);

$fileR = fopen('1.txt','r');
while(!feof($fileR)){
    $line = fgets($fileR);
    echo $line."<br>";
}

fclose($fileR);

?>