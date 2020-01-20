<?php

// $string = "This is & a String. ";
$string = " This is a String. ";

// for simple count
	echo"-----Word Count method-----";
	echo"<br/>";
	echo str_word_count($string, 0);
	echo"<br/>";
// to print as array
	print_r(str_word_count($string, 1));
	echo"<br/>";
// array with word position 
	print_r(str_word_count($string, 2));
	echo"<br/>";
// 3rd parameter to add full stop and & as count
	print_r(str_word_count($string, 2, '&.'));
	echo"<br/>";

//for string shuffling
	echo "<br/>";
	echo "-----String shuffle method-----";
	echo "<br/>";
	echo str_shuffle($string);
	echo "<br/>";
//for size limit in shuffle we can use substr 
	echo substr(str_shuffle($string), 0, strlen($string) / 2);
	echo "<br/>";

//for reverse
	echo "<br/>";
	echo "-----String reverse method-----";
	echo "<br/>";
	echo strrev($string);
	echo"<br/>";
	echo substr(strrev($string), 0, 7);
	echo"<br/>";


//for comparison
	echo "<br/>";
	echo "-----Similar text method-----";
	echo "<br/>";
	$string2="This is a String.String is a best way to define your name "; 
	echo similar_text($string, $string2, $percent);
	echo"<br/>";
// produces percentage as a result	

//to trim
	echo "<br/>";
	echo "-----String trim method-----";
	echo "<br/>";
	echo trim($string);
	echo"<br/>";
//to right trim
	echo rtrim($string);
	echo"<br/>";
//to left trim
	echo ltrim($string);
	echo"<br/>";


//to add slashes 
	echo "<br/>";
	echo "-----add slashes method-----";
	echo "<br/>";	
	$string2 ='This is a <img src="image.jpg">String';
	echo htmlentities(addslashes($string2));
	echo $string2;
	echo"<br/>";
//to remove slashes
	echo "<br/>";
	echo "-----remove slashes method-----";
	echo "<br/>";
	echo stripslashes($string2);
	echo"<br/>";
	

?>