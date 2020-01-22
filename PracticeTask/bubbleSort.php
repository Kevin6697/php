<?php

$numbers = [100,10,40,50,60,20,30,200,600,900,16,28];

for ($i=0; $i < count($numbers)-1; $i++) { 
    for ($j=0; $j < count($numbers)-1; $j++) { 
        if($numbers[$j] > $numbers[$j+1]){
             $numbers[$j] = $numbers[$j+1]+$numbers[$j];
             $numbers[$j+1] = $numbers[$j]-$numbers[$j+1];
             $numbers[$j] = $numbers[$j]-$numbers[$j+1];
        }
    }
}
print_r($numbers);


?>