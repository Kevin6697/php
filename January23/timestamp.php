<?php
	// echo time();
	echo date('c');
	echo"<br/>";
	echo date('H:i:s',time());
	echo"<br/>";
	echo date('d M Y H:i:s',time());
	echo"<br/>";
	echo date('d M Y H:i:s',time()-60);
	echo"<br/>";
	echo date('d M Y H:i:s',strtotime('+1 month 2 hours'));
?>