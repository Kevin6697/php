<?php

$names=["Alex","Billy","Sam"];
$string = implode(',', $names);

$file = fopen("1.txt", "w");
fwrite($file, $string);
fclose($file);

?>