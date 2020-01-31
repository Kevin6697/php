<?php

$file ='1.txt';
if(@unlink($file)){
    echo "File Deleted";
}else{
    echo "Error while deleting file";
}

?>