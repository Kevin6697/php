<?php

	$browser = get_browser($_SERVER['HTTP_USER_AGENT'], true);
	echo $browser['browser'];
	// print_r($browser);
	// echo $_SERVER['HTTP_USER_AGENT'];

?>