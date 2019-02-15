<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="refresh" content="1;url=/../home" />
	</head>
	<body>
		Request Sent...
	</body>
</html>
<?php	
	if(isset($_COOKIE['ux']) && isset($_POST['clearance_uID']) && isset($_POST['cType'])) 
	{
		include("/../_sql/config.php");
		$clearance_uID = mysqli_real_escape_string($conn, $_POST["clearance_uID"]);
		$cType = mysqli_real_escape_string($conn, $_POST["cType"]);
		
		$success = mysqli_query($conn, "INSERT INTO requests (verified, date, resident_id, request_type_id) VALUES (0, NOW(), '$clearance_uID', '$cType');");
		if(!($success))
			echo "Error: ".mysqli_error($conn);
	
		mysqli_close($conn);
	}
	else die("<script>location.href = '/../home'</script>");
	
?>