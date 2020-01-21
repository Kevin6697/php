<?php

echo"---Numeric Array---";
echo"<br/>";
$a = array('1',1,2);
var_dump($a);
echo"<br/>";
print_r($a);
echo"<br/>";
$a[3] = "2";
$a[0] = "2";
print_r($a);
echo"<br/>";

echo"<br/>";
echo"---Associative Array--- ";
$assoc=array("abc"=>1,"xyz"=>2,3,4,"pqr"=>5);
echo"<br/>";
echo $assoc["abc"];
echo"<br/>";
echo $assoc[0];
echo"<br/>";
print_r($assoc);
echo"<br/>";
foreach ($assoc as $key => $value) {
	echo $key."[".$value."]<br>";
}

echo"<br/>";
echo"---Multi-Dimensional Array---";
echo"<br/>";
$multi=array('Healthy'=>array('salad'=>100,'fruits'=>200),'Unhealthy'=>array('burger'=>800,'pizza'=>900));
print_r($multi);
echo"<br/>";
print_r($multi['Healthy']);
echo"<br/>";
echo $multi['Healthy']['salad'];
echo"<br/>";
foreach ($multi as $key => $value) 
{
	echo $key."<br>";
	echo"<ul>";
	foreach ($value as $ans=>$calories)
	{
		echo "<li><strong>&nbsp&nbsp&nbsp&nbsp&nbsp".ucfirst($ans)." - ".$calories."<br></strong></li>";
	}
	echo"</ul>";
}

?>