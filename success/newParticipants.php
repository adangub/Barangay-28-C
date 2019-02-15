<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="refresh" content="1;url=../home" />
	</head>
	<body>
		Adding to list...
	</body>
</html>
<?php	
	if(isset($_POST['programID']) && isset($_POST['uID'])) 
	{
		include("/../_sql/config.php");
		$programID = mysqli_real_escape_string($conn, $_POST["programID"]);
		$uID = mysqli_real_escape_string($conn, $_POST["uID"]);
		
		
		$success = mysqli_query($conn, "INSERT INTO participants (resident_id, program_id) VALUES ('$uID', '$programID');");
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