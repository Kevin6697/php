<?php

$number = 132;
$flag = false;
for($i = 2; $i <= ($number/2); $i++){
    if($number % $i == 0){
        $flag = true;
        break;
    }
}
if($flag == false){
    echo "Prime";
}else{
    echo "Not Prime";
}

?>