<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="refresh" content="1;url=/../home" />
	</head>
	<body>
		Request Sent...
	</body>
</html>
<?php
	include("/../_sql/config.php");
	
	if(isset($_POST['noredflags'])) 
	{
		$firstname = mysqli_real_escape_string($conn, $_POST["validatedfname"]);
		$lastname = mysqli_real_escape_string($conn, $_POST["validatedlname"]);
		$midname = mysqli_real_escape_string($conn, $_POST["validatedmname"]);
		$birthdate = mysqli_real_escape_string($conn, $_POST["validatedBirthdate"]);
		$birthplace = mysqli_real_escape_string($conn, $_POST["validatedBirthplace"]);
		$address = mysqli_real_escape_string($conn, $_POST["validatedAddress"]);
		$weight = mysqli_real_escape_string($conn, $_POST["validatedWeight"]);
		$personalincome = mysqli_real_escape_string($conn, $_POST["validatedPersonalincome"]);
		$phone = mysqli_real_escape_string($conn, $_POST["validatedPhone"]);
		$email = mysqli_real_escape_string($conn, $_POST["validatedEmail"]);
		$username = mysqli_real_escape_string($conn, $_POST["validatedUsername"]);
		$password = hash('whirlpool', mysqli_real_escape_string($conn, $_POST["validatedSecurepass"]));
		
		$gender = mysqli_real_escape_string($conn, $_POST["validatedGender"]);
		$precinct = mysqli_real_escape_string($conn, $_POST["validatedPrecinct"]);
		$height = mysqli_real_escape_string($conn, $_POST["validatedHeight"]);
		$relationship = mysqli_real_escape_string($conn, $_POST["validatedRelationship"]);
		
		$dependent = mysqli_real_escape_string($conn, $_POST["validatedDependency"]);
		
		//Capitalize every first letter of every word
		$firstname = ucwords($firstname);
		$lastname = ucwords($lastname);
		$midname = ucwords($midname);
		
		
	
		$success = mysqli_query($conn, "CALL NEW_RESIDENT('$lastname', '$midname', '$firstname', '$gender', '$precinct', '$birthdate', '$birthplace', '$relationship', '$height', '$weight', '$dependent', '$personalincome', '$username', '$password', '$email', '$phone', '$address');");
		if(!($success))
			echo "NEW_RESIDENT ERROR: ". mysqli_error($conn);
	}
	
	mysqli_close($conn);
	
?>