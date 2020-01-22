<?php
    echo"<table>";
    $tmpNumber = 1;
    for($i = 1; $i <= 4; $i++){
        echo "<tr>";
        for($j = 1; $j <= 3; $j++){
            echo "<td>$tmpNumber </td>";
            $tmpNumber =$tmpNumber + 4;
        }
        $tmpNumber = $i+1;
       echo "</tr>";
    }
    echo"</table>";
?>