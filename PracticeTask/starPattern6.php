<?php

echo"<table border=0 >";
for ($i=1; $i <=5 ; $i++) {
    echo "<tr>"; 
    for ($j=1; $j <=5 ; $j++) { 
            if($i==1 || $i==5){
                echo "<td>*</td>";
            }
            else{
                if($j == 1 || $j == 5){
                    echo "<td>*</td>";
                }
                else{
                    echo "<td></td>";
                }
            }
       }
       echo "</tr>";
}


?>