<?php

$number1 = 10;
$number2 = 20;

echo "Original numbers : <br/>";
echo "Number 1 = $number1 <br/>";
echo "Number 2 = $number2 <br/>";

echo "<br/>";
echo "<br/>";

$number1 = $number1 + $number2;
$number2 = $number1 - $number2;
$number1 = $number1 - $number2;

echo "Swapped numbers : <br/>";
echo "Number 1 = $number1 <br/>";
echo "Number 2 = $number2 <br/>";

?>