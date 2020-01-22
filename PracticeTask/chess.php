<?php

echo"<table border=2 style=width:15%;'>";
for ($i = 0; $i < 8 ; $i++) { 
    echo"<tr>";
    for ($j = 0; $j < 8 ; $j++) { 
        if($i % 2 == 0){
            if($j % 2 == 0){
                echo"<td style='background:black;color:black'>s</td>";
            }
            else{
                echo"<td style=background:white;color:white>s</td>";
            }
        }
        else{
            if($j % 2 != 0){
                echo"<td style='background:black;color:black;'>s</td>";
            }
            else{
                echo"<td style=background:white;color:white;>s</td>";
            }
        }

    }
    echo"</tr>";
}
echo"</table>";

?>