<?php

$numbers = [10,20,100,40,50];
$max = 0;

for ($i = 0; $i < count($numbers); $i++) { 
    if($numbers[$i] > $max){
        $max = $numbers[$i];
    }
}
print_r($numbers);
echo "<br/>";
echo "Maximun number from array is : $max";
?>