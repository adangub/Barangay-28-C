<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="refresh" content="1;url=/../home" />
	</head>
	<body>
		Schedule Set...
	</body>
</html>
<?php	
	if(isset($_COOKIE['ux']) && isset($_POST['scheduleD']) && isset($_POST['blotID']) && isset($_POST['startT']) && isset($_POST['endT'])) 
	{
		include("/../_sql/config.php");
		$blotterID = mysqli_real_escape_string($conn, $_POST["blotID"]);
		$startTime = mysqli_real_escape_string($conn, $_POST["startT"]);
		$endTime = mysqli_real_escape_string($conn, $_POST["endT"]);
		$scheduleDate = mysqli_real_escape_string($conn, $_POST["scheduleD"]);
		$hearings = mysqli_real_escape_string($conn, $_POST['hearings']);
		$lupong1 = NULL;
		$lupong2 = NULL;
		if($hearings >= 3)
		{
			$lupong1 = mysqli_real_escape_string($conn,$_POST['lupong1']);
			$lupong2 = mysqli_real_escape_string($conn,$_POST['lupong2']);
			
			
			$success = mysqli_query($conn, "UPDATE blotter SET lupong_id = '$lupong1', lupong2_id = '$lupong2' WHERE id = '$blotterID';");
			if(!($success))
				echo "Error: ".mysqli_error($conn);
		}
		
		$status = "Hearing #".$hearings;
		$success = mysqli_query($conn, "UPDATE blotter SET status = '$status' WHERE id = '$blotterID';");
		if(!($success))
			echo "Error: ".mysqli_error($conn);
			
		$success = mysqli_query($conn, "INSERT INTO hearing_schedule (schedule_date, start_time, end_time, blotter_id) VALUES ('$scheduleDate', '$startTime', '$endTime', '$blotterID');");
		if(!($success))
			echo "Error: ".mysqli_error($conn);
		
		
		//Uncomment to debug
		//echo "Blotter ID: ".$blotterID." | startTime: ".$startTime." | endTime: ".$endTime." | scheduleDate: ".$scheduleDate;
		
		
		
		
	
		mysqli_close($conn);
	}
	else die("<script>location.href = '/../home'</script>");
	
?>