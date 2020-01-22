<?php

for ($i = 1; $i <= 5 ; $i++) { 
    for ($j = 1; $j <= $i ; $j++) {
        echo str_repeat("*",$j);
    }
    echo str_repeat("0",$i);
    echo"<br>";
}


?>
