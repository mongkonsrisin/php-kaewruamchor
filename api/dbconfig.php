<?php
// File : ANSI encoding
$dbhost = "192.168.1.31";
//$dbhost = "localhost";
$dbuser = "ssru80";
$dbpass = "krcSSru#80th";
$dbname = "kaewruamchor";
$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
mysqli_query($con,"SET NAMES UTF8");
// Check connection
if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
//else echo "<br>Connected<br>";
?>