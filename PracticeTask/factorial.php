<?php

$number = 5;
$tmp=$number;
$fact = 1;
while($number>=1){
    $fact = $fact * $number;
    $number--;
}
echo "Factorial of $tmp is : $fact";
?>


<?php
echo"<br/>";
$number =5;
function fact($number){
    if($number==1){
        return 1;
    }
    return fact($number-1)*$number;
}
echo "Factorial of $number is : ".fact($number);

?>