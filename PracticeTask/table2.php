<?php
echo"<table border=2 style=width:70% cellpadding=5>";
for ($i=1; $i <= 10 ; $i++) { 
    echo "<tr>";
    for ($j=1; $j <= 10 ; $j++) { 
        echo "<td>$i x $j = ".$i *$j. "</td>";
    }
    echo "</tr>";
}



?>