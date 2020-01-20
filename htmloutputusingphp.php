<?php

	$variable1 = 'abc';
	echo '<input type="text" name="name1" value=Hello>';
	echo "<input type=text name=name1 value=Hello>";
	echo "<input type=\"text\" name='name1' value=Hello>";
	echo "<br/>";
	echo "<input type=\"text\" name='name2' value=$variable1>";
	echo "<br/>";
	echo "<a href=demo.php?t1=$variable1&t2=hello>Demo</a>";
	?>
	<br>
	<input type="text" name="name3" value="<?php echo $variable1; ?>">
	<br>
	<a href=demo.php?t1=<?php echo $variable1; ?> &t2=hello>Demo</a>
	<br>
	<?php

		for($i = 0 ; $i < 5 ; $i++)
		{
?>
		<a href="demo.php?t1=<?php echo $i;?>&t2=hello">Demo<?php echo $i; ?></a>
		<br>
<?php	
		}
		for($i = 0;$i < 5;$i++)
		{
			echo"<a href=\"demo.php?t1=$i&t2=hello\">Demo $i</a>
			<br/>";
		}

?>