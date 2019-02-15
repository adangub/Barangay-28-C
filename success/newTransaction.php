<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="refresh" content="1;url=/../home" />
	</head>
	<body>
		Request Approved...
	</body>
</html>
<?php
	include("/../_sql/config.php");
	
	if(isset($_POST['rID']) && isset($_POST['tType']) && isset($_POST['tRID']) && isset($_POST['amount']) && isset($_POST['optionalComment']) && isset($_POST['trans_empid'])) 
	{
		$amount = mysqli_real_escape_string($conn, $_POST['amount']);
		if($amount == 0)
			$amount = NULL;
		$optionalComment = mysqli_real_escape_string($conn, $_POST['optionalComment']);
		$requestID = mysqli_real_escape_string($conn, $_POST["rID"]); //Request Table ID
		$transactionType = mysqli_real_escape_string($conn, $_POST["tType"]); //1 - Residency | 2 - Clearance | 3 - Blotter | 4 - Police | 5 - NBI | 6 - Cedula | 7 - Profile Edit
		$transResidentID = mysqli_real_escape_string($conn, $_POST["tRID"]); //Resident responsible for request
		$trans_empid = mysqli_real_escape_string($conn, $_POST["trans_empid"]);
		
		if($transactionType == -1)
			$transactionType = 6;
		
		// DEBUGGING PURPOSE
		// echo "Amount: ".$amount. " | requestID: ".$requestID." | transactionType: ".$transactionType." | transResidentID: ".$transResidentID. " | Comment: ".$optionalComment." | EmpID: ".$trans_empid; 
		$success = mysqli_query($conn, "CALL NEW_TRANSACTION('$requestID', '$transactionType', '$transResidentID', '$trans_empid', '$amount', '$optionalComment');"); // ' ' damn
		if(!($success))
			echo "NEW_TRANSACTION ERROR: ". mysqli_error($conn);
			
		if($transactionType == 7)
		{
			
			$success = mysqli_query($conn, "
													UPDATE resident, editprofile SET 
												resident.precinctNo = editprofile.precinctNo, 
												resident.civilstatus = editprofile.civilstatus, 
												resident.height = editprofile.height, 
												resident.weight = editprofile.weight, 
												resident.personal_income = editprofile.personal_income, 
												resident.contact_number = editprofile.contact_number, 
												resident.email = editprofile.email, 
												resident.dependent = editprofile.dependent, 
												resident.password = editprofile.password,
												resident.household_id = editprofile.new_household_id,
												resident.fathers_id = editprofile.fathers_id,
												resident.mothers_id = editprofile.mothers_id,
												resident.guardians_id = editprofile.guardians_id
													WHERE editprofile.resident_id = resident.id;
							"); 
			if(!($success))
				echo "Update Error: ". mysqli_error($conn);
			
			
			$success = mysqli_query($conn, "CALL NEW_EMPLOYEE('$transResidentID', (SELECT position FROM editprofile WHERE resident_id='$transResidentID'));"); 
			if(!($success))
				echo "Update Error: ". mysqli_error($conn);
			
			$success = mysqli_query($conn, "DELETE FROM editprofile WHERE resident_id='$transResidentID';");
			if(!($success))
				echo "Deletion Error: ". mysqli_error($conn);
			
			
			session_start();
			$userLoggedIn = $_SESSION['u_id'];
			
			if($userLoggedIn == $transResidentID)
				echo "<meta http-equiv='refresh' content='1;url=/../logout' />";
		}
		
		if($transactionType == 8)
		{
			$sucess = mysqli_query($conn, "UPDATE blotter SET valid = 1 WHERE requests_id = '$requestID';");
			if(!($success))
				echo "Update error: ".msyqli_error($conn);
		}
	}
	
	mysqli_close($conn);
	
?>