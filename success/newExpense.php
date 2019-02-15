<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="refresh" content="1;url=../home" />
	</head>
	<body>
		Expense added...
	</body>
</html>
<?php	
	if(isset($_POST['programID']) && isset($_POST['eName']) && isset($_POST['eAmount']) && isset($_POST['eDate']) && isset($_COOKIE['ux'])) 
	{
		include("/../_sql/config.php");
		$programID = mysqli_real_escape_string($conn, $_POST["programID"]);
		$eAmount = mysqli_real_escape_string($conn, $_POST["eAmount"]);
		$eDate = mysqli_real_escape_string($conn, $_POST["eDate"]);
		$eName = mysqli_real_escape_string($conn, $_POST["eName"]);
		
		$success = mysqli_query($conn, "INSERT INTO program_expense (expense_name, amount, date, program_id) VALUES ('$eName', '$eAmount', '$eDate', '$programID');");
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