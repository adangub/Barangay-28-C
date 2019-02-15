<?php
	if($_POST)
	{
		include('/../_sql/config.php');
		$username = mysql_real_escape_string($_POST['username']);
		$result = mysqli_query($conn, "SELECT username FROM resident WHERE username = '$username' LIMIT 1;");
		if(mysqli_num_rows($result) == 0)
			echo("USER_AVAILABLE");
		else echo ("USER_EXISTS");
		mysqli_close($conn);
	}
?>
