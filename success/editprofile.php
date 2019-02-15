<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="refresh" content="1;url=../home" />
	</head>
	<body>
		Request Sent...
	</body>
</html>
<?php
	include("/../_sql/config.php");
	
	if(isset($_POST['noredflags'])) 
	{
		$id = mysqli_real_escape_string($conn, $_POST["id"]);
		$address = mysqli_real_escape_string($conn, $_POST["validatedAddress"]); //address id only
		$weight = mysqli_real_escape_string($conn, $_POST["validatedWeight"]);
		$personalincome = mysqli_real_escape_string($conn, $_POST["validatedPersonalincome"]);
		$phone = mysqli_real_escape_string($conn, $_POST["validatedPhone"]);
		$email = mysqli_real_escape_string($conn, $_POST["validatedEmail"]);
		$pass =  mysqli_real_escape_string($conn, $_POST["validatedPass"]);
		$currentPass = mysqli_real_escape_string($conn, $_POST["currentPass"]);
		$position = mysqli_real_escape_string($conn, $_POST['position']);
		$father = mysqli_real_escape_string($conn, $_POST['validatedFather']);
		$mother = mysqli_real_escape_string($conn, $_POST['validatedMother']);
		$guardian = mysqli_real_escape_string($conn, $_POST['validatedGuardian']);
		
		if($position == "None")
			$position = NULL;
		
		if ($pass == "")
			$pass = $currentPass;
		else 
			$pass = hash('whirlpool', $pass);
		
		$precinct = mysqli_real_escape_string($conn, $_POST["validatedPrecinct"]);
		$height = mysqli_real_escape_string($conn, $_POST["validatedHeight"]);
		$relationship = mysqli_real_escape_string($conn, $_POST["validatedRelationship"]);
		
		$dependent = mysqli_real_escape_string($conn, $_POST["validatedDependency"]);
		
		//echo "ID: ".$id." | Address: ".$address." | Weight: ".$weight." | Personal Income: ".$personalincome." | Phone: ".$phone." | Email: ".$email." | Precinct: ".$precinct. " | Height: ".$height." | Relationship: ".$relationship." | Dependent: ".$dependent;
		
		mysqli_query($conn, "INSERT INTO editprofile VALUES(0, '$precinct', '$relationship', '$height', '$weight', '$personalincome', '$phone', '$email', '$pass', '$dependent', '$position', '$father', '$mother', '$guardian', '$address', '$id');");
		mysqli_query($conn, "INSERT INTO requests VALUES(0, 0, NULL, NOW(), NULL, $id, 7);");
	}
	
	mysqli_close($conn);
	
?>