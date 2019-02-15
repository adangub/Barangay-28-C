<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="refresh" content="1;url=../home" />
	</head>
	<body>
		Announcement Posted...
	</body>
</html>
<?php	
	if(isset($_POST['ann_content']) && isset($_POST['ann_priority']) && isset($_POST['ann_empid']) && isset($_COOKIE['ux'])) 
	{
		include("/../_sql/config.php");
		$emp_id = mysqli_real_escape_string($conn, $_POST["ann_empid"]);
		$ann_content = mysqli_real_escape_string($conn, $_POST["ann_content"]);
		$ann_priority = mysqli_real_escape_string($conn, $_POST["ann_priority"]);
		
		$success = mysqli_query($conn, "INSERT INTO announcements (date, content, priority, employee_id) VALUES (NOW(), '$ann_content', $ann_priority, $emp_id);");
		if(!($success))
			echo "Error: ".mysqli_error($conn);
	
		mysqli_close($conn);
	}
	else die("<script>location.href = '../home'</script>");
	
?>