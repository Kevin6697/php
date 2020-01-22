<?php

echo"<table border=0>";
$rows = 8;
$cols = 0;
for($i = 1; $i <= $rows; $i++){
    $cols = $i;
    echo "<tr>";
    for($j = 1; $j <= $cols; $j++){
            echo "<td>*</td>";
    }
    echo "</tr>";
}
echo"</table>";
?>