<?php

$variable1 = "World";
$variable2 = "variable1";
$variable3 = 1.23;
echo 'Hello'."-".$variable1;
echo "<br/>";
echo  "Hello"."-";
echo $$variable2;
echo "<br/>";
echo "<strong>$variable2"."-".$variable3."</strong>";
echo "<br/>";
echo "The sum is " . (1 | 2);
echo "<br/>";
echo "The sum is ", 1 | 2;
echo "<br/>"; 
echo (int)((0.1 + 0.7) * 10);
echo "<br/>";


print("------Use of print-------");
print "<br>";
print 'Hello'."-".$variable1;
print "<br>";
print "Hello"."-";
print $$variable2;
print "<br>";
print "<strong>$variable2"."-".$variable3."</strong>";
    
?>