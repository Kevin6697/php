<?php

$rows = 8;
echo"<table>";
for($i = 1; $i <= $rows; $i++){
    echo "<tr>";
    for($j = 1; $j <= $i; $j++){
            echo "<td>$j</td>";
    }
    echo "</tr>";
}
echo"</table>";
?>