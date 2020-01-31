<?php

$directory = 'files';
$handle = opendir($directory.'/');
if($handle == true){
    echo "Looking inside the  '$directory' directory<br/>";
    while($file = readdir($handle)){
        echo "<a href=$directory/$file>$file</a><br>";
    }
}else{
    echo "No such directory found";
}


?>