<?php

$number1 = 20;
$number2 = 6;
$number3 = 1;
$multipleArray = array();

$greatestNumber = greatestNumber($number1, $number2, $number3);

function greatestNumber($num1, $num2, $num3){
    if($num1 >= $num2 && $num1 >= $num3){
        return $num1;
    }else if($num2 > $num1 && $num2 >= $num3){
        return $num2;
    }else{
        return $num3;
    }
}

function multiples($num, $greatestNumber){
    $tmpNumnber = $greatestNumber * 10;
    $tmp=[];
    for ($i = 2; $i <= $tmpNumnber ; $i++) { 
        if($i % $num == 0){
                array_push($tmp, $i);
            }    
    }
    return $tmp;
}

array_push($multipleArray, multiples($number1, $greatestNumber));
array_push($multipleArray, multiples($number2, $greatestNumber));
array_push($multipleArray, multiples($number3, $greatestNumber));

function calculateLCM($multipleArray){
    $commonValues= array_intersect($multipleArray[0],$multipleArray[1],$multipleArray[2]);
    foreach($commonValues as $values){
        return $values;
     }
  }
$lcm = calculateLCM($multipleArray);
echo "LCM of $number1 and $number2  and $number3 is :  $lcm";

?>