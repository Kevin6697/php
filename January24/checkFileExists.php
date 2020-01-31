<?php

$filename ='1.txt';
if(file_exists($filename)){
    echo "file exists";
}else{
    echo "Not found";
    $file = fopen('1.txt','w');
    fwrite($file, "");
    fclose($file);
}

?>