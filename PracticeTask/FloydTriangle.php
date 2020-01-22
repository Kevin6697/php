<?php

$tmp = 1;

for ($i=1; $i <= 5; $i++) { 
    for ($j=1; $j <= $i; $j++) { 
        echo $tmp."\t";
        $tmp = $tmp + 1;
    }    
    echo "<br/>";
}

?>