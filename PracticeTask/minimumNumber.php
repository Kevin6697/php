<?php

$numbers = [200,2,10,20,40,50,100];
$max = $numbers[0];

for ($i = 0; $i < count($numbers); $i++) { 
    if($numbers[$i] < $max){
        $max = $numbers[$i];
    }
}
print_r($numbers);
echo "<br/>";
echo "Minimum number from array is : $max";
?>