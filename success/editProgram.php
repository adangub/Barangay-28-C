<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="refresh" content="120;url=../home" />
	</head>
	<body>
		Program changed...
	</body>
</html>
<?php	
	if(isset($_POST['progID']) && isset($_POST['titleProg']) && isset($_POST['dateProg']) && isset($_POST['venueProg']) && isset($_POST['startProg']) && isset($_POST['endProg']) && isset($_POST['employee']) && isset($_POST['budgetProg']) && isset($_COOKIE['ux'])) 
	{
		include("/../_sql/config.php");
		$progID = mysqli_real_escape_string($conn, $_POST["progID"]);
		$titleProg = mysqli_real_escape_string($conn, $_POST["titleProg"]);
		$dateProg = mysqli_real_escape_string($conn, $_POST["dateProg"]);
		$startProg = mysqli_real_escape_string($conn, $_POST["startProg"]);
		$endProg = mysqli_real_escape_string($conn, $_POST["endProg"]);
		$venueProg = mysqli_real_escape_string($conn, $_POST["venueProg"]);
		$budgetProg = mysqli_real_escape_string($conn, $_POST["budgetProg"]);
		$employee = mysqli_real_escape_string($conn, $_POST['employee']);
		
		
		$dateProg = date("Y-m-d", strtotime($dateProg));
		$success = mysqli_query($conn, "UPDATE program SET title='$titleProg', date='$dateProg', place='$venueProg', timeFrom='$startProg', timeTo='$endProg', budget='$budgetProg' WHERE id='$progID';");
		if(!($success))
			echo "Error: ".mysqli_error($conn);
		
		
		
		$success = mysqli_query($conn, "UPDATE employee_program_assignment SET employee_id='$employee' WHERE programs_id='$progID';");
		if(!($success))
			echo "Error: ".mysqli_error($conn);
	
		mysqli_close($conn);
		
		echo "<script>window.onunload = refreshParent;
				function refreshParent() 
				{
					window.opener.location.reload();
				}
			  </script>";
		echo "<script>window.close()</script>";
	}
	else die("<script>location.href = '../home'</script>");
	
?>