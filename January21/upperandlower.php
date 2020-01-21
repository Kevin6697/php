<?php

$string1 = "This is a String";
echo "<br/>";
echo "---upper and lower---";
echo "<br/>";
echo "Use of lower case : ".strtolower($string1);
echo "<br/>";
echo "Use of upper case : ".strtoupper($string1);
echo "<br/>";
var_dump(strtolower(NULL));
echo "<br/>";
var_dump(strtoupper(null));
echo "<br/>";
echo "Use of ucfirst : ",ucfirst($string1);
echo "<br/>";
echo "Use of ucwords : ",ucwords($string1);
echo "<br/>";
echo "Use of ucwords : ",lcfirst($string1);
echo "<br/>";
echo "<br/>";

?>