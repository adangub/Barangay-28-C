<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="refresh" content="1;url=../home" />
	</head>
	<body>
		Program deleted...
	</body>
</html>
<?php	
	if(isset($_POST['evID']) ) 
	{
		include("/../_sql/config.php");
		$evID = mysqli_real_escape_string($conn, $_POST['evID']);
		
		$success = mysqli_query($conn, "DELETE FROM employee_program_assignment WHERE programs_id = '$evID';");
		if(!($success))
			echo "Error: ".mysqli_error($conn);

		$success = mysqli_query($conn, "DELETE FROM participants WHERE program_id = '$evID';");
		if(!($success))
			echo "Error: ".mysqli_error($conn);
			
		$success = mysqli_query($conn, "DELETE FROM program_expense WHERE program_id = '$evID';");
		if(!($success))
			echo "Error: ".mysqli_error($conn);
		
		$success = mysqli_query($conn, "DELETE FROM program WHERE id = '$evID';");
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