<?php

echo"<table border=2 style=width:30% cellpadding=5>";
for ($i=1; $i <= 10 ; $i++) { 
    echo "<tr>";
    for ($j=1; $j <= 10 ; $j++) { 
        echo "<td>".$i *$j. "</td>";
    }   
    echo "</tr>";
}

?>