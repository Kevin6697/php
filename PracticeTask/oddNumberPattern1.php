<?php

for($i = 15; $i >= 1; $i--){
    for($j = $i; $j >= 1; $j--){
        if($i % 2 != 0){
            echo "*";
        }
    }
    echo "<br/>";
}

?>