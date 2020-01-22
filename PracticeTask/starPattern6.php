<?php

for ($i=1; $i <=5 ; $i++) { 
    for ($j=1; $j <=5 ; $j++) { 
            if($i==1 || $i==5){
                echo "*";
            }
            else{
                if($j == 1 || $j == 5){
                    echo "*";
                }
                else{
                    echo "&nbsp&nbsp";
                }
            }
       }
    echo "<br/>";
}


?>