<?php

    $variable1 = "hello";
    $variable2 = "variable1";
    $variable3 = 12.0;
    $variable4 = &$variable1;
    
    echo 'Output of $b--'.$variable2;
    echo"<br>"; 
    echo 'Output of $a--'.$$variable2;
    echo"<br>"; 
    echo $variable3;
    echo"<br>"; 
    $variable4=$variable4."World";
    echo $variable1;
    
    echo isset($x);

?>