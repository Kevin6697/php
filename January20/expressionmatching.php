<?php

$string = "This is a String";
if(preg_match('/is/',$string))
{
	echo "is found ";
}
else
{
	echo " is not found";
}
echo "<br/>";

$string = "This is a String";
if(preg_match('/[0-9]/',$string))
{
	echo "String matched with pattern  ";
}
else
{
	echo "String not matched with pattern ";
}
echo "<br/>";

$string = "This is a String";
if(preg_match('/[a-zA-Z]/',$string))
{
	echo "String matched with pattern ";
}
else
{
	echo "String not matched with pattern ";
}
echo "<br/>";

$number = 1236547890;
if(preg_match('/[0-9]{10,10}/',$number))
{
	echo "Number matched with pattern ";
}
else
{
	echo "Number not matched with pattern ";
}
echo "<br/>";

$string = "This is a String";
if(preg_match('/^Th/',$string))
{
	echo "Th found in the string ";
}
else
{
	echo "Th not found in the string ";
}
echo "<br/>";

$string = "This is a String";
if(preg_match('/ing$/',$string))
{
	echo "ing found in the string ";
}
else
{
	echo "ing not found in the string ";
}
echo "<br/>";

$string = "shahkevin391@gmail.com";
if(preg_match('/[a-zA-Z0-9._-]+\@[a-zA-Z]+\.[a-zA-Z.]{2,5}/',$string))
{
	echo "Valid email ";
}
else
{
	echo "Invalid email ";
}
echo "<br/>";

$string = "This is a String";
if(preg_match('/b*/',$string))
{
	echo "use of * to match th string and found ";
}
else
{
	echo "use of * to match th string and not found ";
}
echo "<br/>";

$string = "This is a String";
if(preg_match('/b+/',$string))
{
	echo "use of + to match th string and found ";
}
else
{
	echo "use of + to match th string and not found ";
}
echo "<br/>";

$string1 = "This is a String";
$string2 = "This is a String";
if(preg_match("/$string1/",$string2))
{
	echo "String1 matched with String2 ";
}
else
{
	echo "String1 not matched with String2 ";
}
echo "<br/>";

?>