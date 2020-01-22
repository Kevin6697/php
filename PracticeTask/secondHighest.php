<?php

$numbers = [10,20,15,58,30,60,70,80,90];
print_r($numbers);
$tmpLength = count($numbers)-2;
for ($i=0; $i < count($numbers)-1; $i++) { 
    for ($j=0; $j < count($numbers)-1; $j++) { 
        if($numbers[$j] > $numbers[$j+1]){
             $numbers[$j] = $numbers[$j+1]+$numbers[$j];
             $numbers[$j+1] = $numbers[$j]-$numbers[$j+1];
             $numbers[$j] = $numbers[$j]-$numbers[$j+1];
        }
    }
}
echo "<br/>";
echo "Maximun number from array is : $numbers[$tmpLength]";

// rsort($numbers);
// echo "Maximun number from array is : $numbers[1]";



?>