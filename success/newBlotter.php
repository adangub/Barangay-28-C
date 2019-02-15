<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="refresh" content="1;url=/../home" />
	</head>
	<body>
		Complaint filed...
		
	</body>
</html>
<?php
	
	include("/../_sql/config.php");
	
	if((isset($_POST['userID']) || (isset($_POST['userID']))) && (isset($_POST['cons1']) || isset($_POST['complainantName'])) && isset($_POST['res1']) && (isset($_POST['addID']) || isset($_POST['disabledAdd'])) && isset($_POST['blotDetails']) && isset($_POST['blotType']) && isset($_POST['NumberOfRespondents']))
	{
		
		$userID = mysqli_real_escape_string($conn, $_POST['userID']); //ID of user currently logged in 
		$empID = mysqli_real_escape_string($conn, $_POST['empID']); //ID of employee currently logged in 
		$complainant = mysqli_real_escape_string($conn, $_POST['cons1']); // ID of complainant in input
		$complainantName = mysqli_real_escape_string($conn, $_POST['complainantName']); // Name of non-resident complainant
		$respondent1 = mysqli_real_escape_string($conn, $_POST['res1']); // ID of respondent number one
		$addressID = mysqli_real_escape_string($conn, $_POST['addID']); // ID of address of complainant
		$addressName = mysqli_real_escape_string($conn, $_POST['addName']); // Name of address of non-resident complainant
		$blotterDetails = mysqli_real_escape_string($conn, $_POST['blotDetails']);
		$blotterType = mysqli_real_escape_string($conn, $_POST['blotType']);
		$NumberOfRespondents = mysqli_real_escape_string($conn, $_POST['NumberOfRespondents']);
		
		//echo "userID: ".$userID. " | empID: ".$empID." | complainant: ".$complainant." | complainantName: ".$complainantName." | respondent1: ".$respondent1." | addressID: ".$addressID." | addressName: ".$addressName." | blotterDetails: ".$blotterDetails." | blotterType: ".$blotterType." | NumberOfRespondents: ".$NumberOfRespondents;
		
		
		
		
		
		

		
		

		$timestamp = date("Y-m-d H:i:s");

		
		
		if($complainant) //If complainant is a resident
		{
			if($empID) //if employee ang nag create sa blotter to be approved 
			{
				$success = mysqli_query($conn, "INSERT INTO requests (verified, date, resident_id, request_type_id) VALUES (0, NOW(), '$complainant', 8);");
				if(!($success))
					echo "(1) Error: ".mysqli_error($conn);
				
				$requestID = mysqli_insert_id($conn);
				$success = mysqli_query($conn, "CALL NEW_BLOTTER('$blotterDetails', 'No Meeting Set', '$complainantName', '$addressName', NULL, $complainant, GET_BLOTTERTYPE('$blotterType'), '$timestamp', 0, '$requestID');");
			}
			else //if nag request ang resident for a blotter to be approved 
			{
				$success = mysqli_query($conn, "INSERT INTO requests (verified, date, resident_id, request_type_id) VALUES (0, NOW(), '$userID', 8);");
				if(!($success))
					echo "Error: ".mysqli_error($conn);
					
				$requestID = mysqli_insert_id($conn);
				
				$success = mysqli_query($conn, "CALL NEW_BLOTTER('$blotterDetails', 'No Meeting Set', '$complainantName', '$addressName', NULL, $complainant, GET_BLOTTERTYPE('$blotterType'), '$timestamp', 0, '$requestID');");
				if(!($success))
					echo "(1.5) Error: ".mysqli_error($conn);
			}
		}
		else //if complainant is non-resident
		{
			if($empID) //if employee ang nag create sa blotter to be approved 
			{
				$success = mysqli_query($conn, "CALL NEW_BLOTTER('$blotterDetails', 'No Meeting Set', '$complainantName', '$addressName', NULL, NULL, GET_BLOTTERTYPE('$blotterType'), '$timestamp', 1, NULL);");
				if(!($success))
					echo "(2) Error: ".mysqli_error($conn);
				
			}
			else
			{
				$success = mysqli_query($conn, "INSERT INTO requests (verified, date, resident_id, request_type_id) VALUES (0, NOW(), '$userID', 8);");
				if(!($success))
					echo "Error: ".mysqli_error($conn);
					
				$requestID = mysqli_insert_id($conn);
			
				$success = mysqli_query($conn, "CALL NEW_BLOTTER('$blotterDetails', 'No Meeting Set', '$complainantName', '$addressName', NULL, NULL, GET_BLOTTERTYPE('$blotterType'), '$timestamp', 0, '$requestID');");
				if(!($success))
					echo "(2) Error: ".mysqli_error($conn);
			}
		}
		

		$result = mysqli_query($conn, "SELECT id FROM blotter WHERE complaint='$blotterDetails' AND date ='$timestamp' AND complaint_type_id=GET_BLOTTERTYPE('$blotterType') LIMIT 1");
		if(!($result))
			echo "(3) Error: ".mysqli_error($conn);
		
		$row = mysqli_fetch_array($result);
		$BlotterID = $row['id'];

		$allRespondents = "(".$respondent1.", ".$BlotterID.")";
		$i = 2;
		for($i; $i <= $NumberOfRespondents; $i++)
		{
			$cursor = "res".$i;
			$currentRespondent = mysqli_real_escape_string($conn, $_POST[$cursor]);
			$allRespondents = $allRespondents.",(".$currentRespondent.",".$BlotterID.")";
			if(!$empID)
				mysqli_query($conn, "UPDATE resident SET eligibility = 0 WHERE id = '$currentRespondent';");
		}
		
		
		$success = mysqli_query($conn, "UPDATE resident SET eligibility = 0 WHERE id = '$respondent1';");
		if(!($success))
					echo "(5.5) Error: ".mysqli_error($conn);
		$fullQuery = "INSERT INTO respondents (resident_id, blotter_id) VALUES ".$allRespondents.";";
		
		
		$success = mysqli_query($conn, $fullQuery);
		if(!($success))
					echo "(2) Error: ".mysqli_error($conn);
		
	}
	
	mysqli_close($conn);
	
?>

