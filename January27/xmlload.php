<?php

$xml = simplexml_load_file('example.xml');
foreach ($xml->producer as $key) {
	echo "<pre>Name : ".$key->name."<br>"."Age:".$key->age."<br>";
	foreach ($key->show as $show) {
		echo "&nbsp&nbsp&nbsp Show Name:".$show->showname;
		echo"<br>";
		echo"&nbsp&nbsp&nbsp Time :".$show->time."<br/>";
	}
	echo"</pre><br>";
}
?>