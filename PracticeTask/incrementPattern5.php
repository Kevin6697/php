<?php

    $tmpNumber = 1;
    for($i = 1; $i <= 4; $i++){
        for($j = 1; $j <= 3; $j++){
            echo $tmpNumber."\t";
            $tmpNumber =$tmpNumber + 4;
        }
        $tmpNumber = $i+1;
       echo "<br/>";
    }

?>