<?php

$dbhost="localhost"; // hostname
$dbuser="root"; // username 
$dbpass="usbw"; // password
$dbname="28c"; // database name

$conn = mysqli_connect($dbhost,$dbuser,$dbpass);
mysqli_select_db($conn,$dbname);
date_default_timezone_set('Asia/Hong_Kong');
if(!$conn)
	die('Could not connect to MySQL: ' . mysqli_error());

?>