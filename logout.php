
<!DOCTYPE html>
<html>
<body>
	Logging out...
<?php
include '/_sql/config.php';
	session_start();
	$_SESSION = array(); // truncate all data associated with the session
	if(isset($_COOKIE['ux']))
		setcookie("ux", "ux", strtotime( '-1 days' ), '/');
	if(isset($_COOKIE['PHPSESSID']))
		setcookie("PHPSESSID", "PHPSESSID", strtotime( '-1 days' ), '/');
	session_destroy();
	
	if(isset($_SESSION['u_username']) && isset($_SESSION['u_id']))
	{
		alert("Logout Failed");
	} 
	else header('Refresh: 1; url="home"');
	
?></body>
</html>
