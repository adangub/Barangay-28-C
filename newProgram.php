<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="refresh" content="1;url=../index.php" />
	</head>
	<body>
		Program Posted...
	</body>
</html>
<?php	
	if(isset($_POST['titleProg']) && isset($_POST['dateProg']) && isset($_POST['venueProg']) && isset($_POST['startProg']) && isset($_POST['endProg']) && isset($_POST['budgetProg']) && isset($_COOKIE['ux'])) 
	{
		include("/../_sql/config.php");
		$titleProg = mysqli_real_escape_string($conn, $_POST["titleProg"]);
		$dateProg = mysqli_real_escape_string($conn, $_POST["dateProg"]);
		$startProg = mysqli_real_escape_string($conn, $_POST["startProg"]);
		$endProg = mysqli_real_escape_string($conn, $_POST["endProg"]);
		$budgetProg = mysqli_real_escape_string($conn, $_POST["budgetProg"]);
		
		$success = mysqli_query($conn, "INSERT INTO program (title, date, place, timeFrom, timeTo, budget) VALUES ('$titleProg', $dateProg, $startProg, $endProg, $budgetProg);");
		if(!($success))
			echo "Error: ".mysqli_error($conn);
	
		mysqli_close($conn);
	}
	else die("<script>location.href = 'index.php'</script>");
	
?>