<?php

$number1 = 20;
$number2 = 6;
$number3 = 2;
$factorialArray = array();

function findFactorial($num){
    $tmp = array();
    for ($i = $num; $i >= 1 ; $i--) { 
        if($num % $i == 0){
            array_push($tmp,$i);
        }
    }    
    return $tmp;
}

array_push($factorialArray, findFactorial($number1));
array_push($factorialArray, findFactorial($number2));
array_push($factorialArray, findFactorial($number3));

function findHCF($factorialArray){
    $commonValues = array_intersect($factorialArray[0],$factorialArray[1],$factorialArray[2]);
   foreach($commonValues as $values){
      return $values;
   }
}
$hcf = findHCF($factorialArray);
echo "HCF of $number1 and $number2  and $number3 is :  $hcf";

?>