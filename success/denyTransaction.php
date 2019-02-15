<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="refresh" content="1;url=/../home" />
	</head>
	<body>
		Request Denied...
	</body>
</html>
<?php
	include("/../_sql/config.php");
	
	if(isset($_POST['requestID']) && isset($_POST['transactionType']) && isset($_POST['optionalReason']) && isset($_POST['transResidentID'])) 
	{
		$requestID = mysqli_real_escape_string($conn, $_POST["requestID"]); //Request Table ID
		$transactionType = mysqli_real_escape_string($conn, $_POST["transactionType"]); //1 - Residency | 2 - Clearance | 3 - Blotter | 4 - Cedula
		$optionalReason = mysqli_real_escape_string($conn, $_POST["optionalReason"]); //Resident responsible for request
		$transResidentID = mysqli_real_escape_string($conn, $_POST["transResidentID"]); //Resident responsible for request
		$trans_empid = mysqli_real_escape_string($conn, $_POST["trans_empid"]);
		
		
		// DEBUGGING PURPOSE
		//echo "requestID: ".$requestID. " | transactionType: ".$transactionType." | optionalReason: ".$optionalReason." | transResidentID: ".$transResidentID; 
		
		if($transactionType == 8)
		{
			$success = mysqli_query($conn, "CALL DELETE_BLOTTERBYREQUESTID('$requstID');");
			if(!($success))
				echo "Error: ".mysqli_error($conn);
		}
		
		$success = mysqli_query($conn, "CALL DENY_TRANSACTION('$requestID', '$transactionType', '$optionalReason', '$transResidentID', '$trans_empid');");
		if(!($success))
			echo "Error: ".mysqli_error($conn);
		
		
		
		
		
	}
	
	mysqli_close($conn);
	
?>