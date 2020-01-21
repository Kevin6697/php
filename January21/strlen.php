<?php

echo "---String length---";
echo "<br/>";
$string1 = "This is a String";
$stringLength = strlen($string1);
echo "size of given simple string \"$string1\"  is : ".$stringLength;
echo"<br/>";
$s="Hello World";
$length = strlen(md5($s));
echo  "Size of give string : ".md5($s) ." after converting it to md5  is  ".$length;
echo "<br/>";
echo "Size of give string : ".base64_decode($s) ." after converting it to base 64 is  ".strlen(base64_decode($s));
echo "<br/>";
echo "size of null is : ".strlen(null);
echo "<br/>";
// echo strlen(false);
// echo "<br/>";
// echo strlen(true);
// $string2 = "123\n";
// echo "<p>".strlen($string2)."</p>";
// echo strlen(iconv('utf-8', 'utf-16le', '✌Kevin'));

?>