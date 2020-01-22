<?php
echo"<table border=0>";
for($i = 15; $i >= 1; $i--){
    echo"<tr>";
    for($j = $i; $j >= 1; $j--){
        if($i % 2 != 0){
            echo "<td>*</td>";
        }
    }
    echo "</tr>";
}
echo"</table>";
?>