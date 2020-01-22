<?php

$string1 = "JOHN";
$string2 ="SMITH";
$txt='';
if($string1 > $string2){
    $length = strlen($string2);  
    $extra = strlen($string2)-strlen($string1);
    $tmpString = $string1;  
}
else{
    $length = strlen($string1);
    $extra = strlen($string1)-strlen($string2);
    $tmpString = $string2;
}
for ($i = 0; $i < $length; $i++) { 
    @$txt.= $string1[$i].$string2[$i];
}
for ($j=$extra; $j <=-1 ; $j++) { 
    $txt.= $tmpString[$j];
}
$txt.='';
echo $txt;



?>