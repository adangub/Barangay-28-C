<?php
	if($_POST)
	{
		include('../_sql/config.php');
		$username = mysql_real_escape_string($_POST['username']);
		$password = hash('whirlpool', mysql_real_escape_string($_POST['password']));
		$result = mysqli_query($conn, "SELECT username FROM resident WHERE username = '$username' AND password = '$password' LIMIT 1;");
		if(mysqli_num_rows($result) == 0)
			echo("NO");
		else echo ("YES");
		mysqli_close($conn);
	}
?>
