<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="refresh" content="1;url=../home" />
	</head>
	<body>
		Program added...
	</body>
</html>
<?php	
	if(isset($_POST['titleProg']) && isset($_POST['dateProg']) && isset($_POST['venueProg']) && isset($_POST['startProg']) && isset($_POST['endProg']) && isset($_POST['budgetProg']) && isset($_POST['employee']) && isset($_COOKIE['ux'])) 
	{
		include("/../_sql/config.php");
		$titleProg = mysqli_real_escape_string($conn, $_POST["titleProg"]);
		$dateProg = mysqli_real_escape_string($conn, $_POST["dateProg"]);
		$startProg = mysqli_real_escape_string($conn, $_POST["startProg"]);
		$endProg = mysqli_real_escape_string($conn, $_POST["endProg"]);
		$venueProg = mysqli_real_escape_string($conn, $_POST["venueProg"]);
		$budgetProg = mysqli_real_escape_string($conn, $_POST["budgetProg"]);
		$employee = mysqli_real_escape_string($conn, $_POST['employee']);
		
		$dateProg = date("Y-m-d", strtotime($dateProg));
	
		$success = mysqli_query($conn, "INSERT INTO program (title, date, place, timeFrom, timeTo, budget, status) VALUES ('$titleProg', '$dateProg', '$venueProg', '$startProg', '$endProg', '$budgetProg', 'Approved');");
		if(!($success))
			echo "Error: ".mysqli_error($conn);
		
		$programid = mysqli_insert_id($conn);
		
		$success = mysqli_query($conn, "INSERT INTO employee_program_assignment VALUES ('$programid', '$employee');");
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
	else die("<script>location.href = 'index.php'</script>");
	
?>