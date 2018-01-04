<?php

$conn=mysqli_connect("localhost","root","root","concentration");
//$conn=mysqli_connect("localhost","root","password","concentration");

if(!$conn)
{
	die("Connection failed: " . mysqli_connect_error());
}

?>
