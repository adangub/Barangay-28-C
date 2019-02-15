<?php
	if($_POST)
	{
		include('/../_sql/config.php');
		$eTime = mysql_real_escape_string($_POST['eTime']);
		$sTime = mysql_real_escape_string($_POST['sTime']);
		$date = mysql_real_escape_string($_POST['date']);
		
		$eTime = date("H:i", strtotime($eTime));
		$sTime = date("H:i", strtotime($sTime));
		$date = date("Y-m-d",strtotime($date));
		
		
		$result = mysqli_query($conn, "SELECT GET_BLOTSCHEDULECONFLICT('$date', '$sTime', '$eTime');");
		$row = mysqli_fetch_array($result);
		$conflict = $row[0];
		echo $conflict;
		mysqli_close($conn);
	}
?>
