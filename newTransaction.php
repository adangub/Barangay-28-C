<!DOCTYPE html>
<html>
    <head></head>
    <body>
	<?php
		include("dash-top.php");
	
			if(isset($_POST['requestID']) && isset($_POST['transactionType']) && isset($_POST['transResidentID']) && isset($_POST['transactionTypeText']) && isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id())
			{
				include("/_sql/config.php");
				$transactionType = mysql_real_escape_string($_POST['transactionType']);
				$transactionTypeText = mysql_real_escape_string($_POST['transactionTypeText']);
				$requestID = mysql_real_escape_string($_POST['requestID']);
				$transResidentID = mysql_real_escape_string($_POST['transResidentID']);
				
				
				
				
?>
				<div class="col-lg-offset-3 col-lg-7" ><br><br>
					<section class="panel">
						<header class="panel-heading">
							<?php echo $transactionTypeText; ?>
						</header>
							<div class="form-group">
			
			
			
			
			
						<div class="panel-body">
									<div class="col-lg-12">
										<!--************************************
											*
											*		OTHER INFORMATION
											*
											************************************ -->
											<?php $transactionTypeText = strtolower($transactionTypeText); 

											if($transactionTypeText == "blotter request"):
												$qry = "SELECT id, date, complaint, GET_COMPLAINANTNAME(complainant_id) complainant FROM blotter WHERE requests_id = GET_REQUESTID('$transResidentID', 8, 0);";
												$result = mysqli_query($conn, $qry);
												$row = mysqli_fetch_array($result);

												$bid = $row['id'];
												$complaint = $row['complaint'];
												$complainant = $row['complainant'];
												
												

												$year = date("Y");?>
												<table cellpadding="5" style="border: 3px solid #dfe3ee;background-color: #fafafa;">
												<tr><td>ID: </td><td><?php echo $bid; ?></td> </tr>
												<tr><td>Complaint : </td><td><?php echo $complaint; ?></td> </tr>
												<tr><td>Complainant : </td><td><?php echo $complainant; ?></td> </tr>
												<tr><td>Respondent/s: </td><td>
												<?php 
												$qry = "SELECT GET_FULLNAME(resident_id, 1) rname FROM respondents WHERE blotter_id = '$bid';";
												$result = mysqli_query($conn, $qry);
												while($row = mysqli_fetch_array($result))
												{
												?>
													<?php echo $row['rname'].'<br>'; ?>
												<?php 
												}
												?></td>
												</tr>
												

											<?php elseif($transactionTypeText == "profile edit request"):
												$qry = "SELECT GET_FULLNAME(resident_id, 0) name, precinctNo, civilstatus, height, weight, personal_income, contact_number, email, dependent, position, GET_FULLNAME(fathers_id, 0) fatha, GET_FULLNAME(mothers_id, 0) motha, GET_FULLNAME(guardians_id, 0) guard, GET_ADDRESS(new_household_id) addr FROM editprofile WHERE resident_id=$transResidentID;";
												$result = mysqli_query($conn, $qry);
												$row = mysqli_fetch_array($result);

												$motha = $row['motha'];
												$fatha = $row['fatha'];
												$guard = $row['guard'];
												$position = $row['position'];
												$dependent = $row['dependent'];
												if(!$motha)
													$motha = '-';
												$fatha = $row['fatha'];
												if(!$fatha)
													$fatha = '-';
												if(!$guard)
													$guard = '-';
												if(!$position)
													$position = '-';
												if(!$dependent)
													$dependent = '-';

												$year = date("Y");?>
												<table cellpadding="5" style="border: 3px solid #dfe3ee;background-color: #fafafa;">
												<tr><td>Year: </td><td><?php echo $year; ?></td> </tr>
												<tr><td>Name : </td><td><?php echo $row['name']; ?></td> </tr>
												<tr><td>Height/Weight : </td><td><?php echo $row['height'].' / '.$row['weight'].' kg'; ?></td> </tr>
												<tr><td>Mothers Name  : </td><td><?php echo $motha; ?></td> </tr>
												<tr><td>Fathers Name : </td><td><?php echo $fatha; ?></td> </tr>
												<tr><td>Guardians Name : </td><td><?php echo $guard; ?></td> </tr>
												<tr><td>Address : </td><td><?php echo $row['addr']; ?></td> </tr>
												<tr><td>Civil Status : </td><td><?php echo $row['civilstatus']; ?></td> </tr>
												<tr><td>Precinct : </td><td><?php echo $row['precinctNo']; ?></td> </tr>											
												<tr><td>Income : </td><td><?php echo 'PHP '.number_format($row['personal_income'],2); ?></td> </tr>
												<tr><td>Contact : </td><td><?php echo $row['contact_number']; ?></td> </tr>
												<tr><td>Dependent : </td><td><?php echo $dependent; ?></td> </tr>
												<tr><td>Position : </td><td><?php echo $position; ?></td> </tr>											
											

											<?php else: 
												$qry = "SELECT resident.family_name, resident.first_name, resident.middle_name, resident.birth_date, resident.birth_place, household.address, resident.gender, resident.civilstatus, resident.height, resident.weight FROM resident INNER JOIN household ON resident.household_id=household.id WHERE resident.id=$transResidentID;";
												$result = mysqli_query($conn, $qry);
												$row = mysqli_fetch_array($result);
												
												$year = date("Y");
												$curDate = date("m/d/y");
												$surname = $row['family_name'];
												$first = $row['first_name'];
												$middle = $row['middle_name'];
												$birthdate = date('m/d/Y', strtotime($row['birth_date']));
												$birthplace = $row['birth_place'];
												$address = $row['address'];
												$gender = $row['gender'];
												$civilstatus = $row['civilstatus'];
												$height = $row['height'];
												$weight = $row['weight'];
												?>


												<table cellpadding="5" style="border: 3px solid #dfe3ee;background-color: #fafafa;">
												<tr><td>Year: </td><td><?php echo $year; ?></td> </tr>
												<tr><td>Place of Issue : </td><td>Barangay 28-C D.Suazo St., Poblacion District, Davao City</td> </tr>
												<tr><td>Date Issued : </td><td><?php echo $curDate; ?></td> </tr>
												<tr><td>Surname : </td><td><?php echo $surname; ?></td> </tr>											
												<tr><td>Firstname  : </td><td><?php echo $first; ?></td> </tr>
												<tr><td>Middlename : </td><td><?php echo $middle; ?></td> </tr>
												<tr><td>Date of Birth : </td><td><?php echo $birthdate; ?></td> </tr>
												<tr><td>Place of Birth : </td><td><?php echo $birthplace; ?></td> </tr>
												<tr><td>Address : </td><td><?php echo $address; ?></td> </tr>											
												<tr><td>Sex : </td><td><?php echo $gender; ?></td> </tr>
												<tr><td>Civil Status : </td><td><?php echo $civilstatus; ?></td> </tr>
												<tr><td>Height / Weight : </td><td><?php echo $height." / ".$weight."Kg"; ?></td> </tr>

											<?php endif; ?>



											<tr><td>Amount: </td><td><input type="text" colspan="2" class="form-control" id="amountPaid" name="amountPaid" size=10 placeholder="0"></td> </tr>
											<tr><td>Optional Comment: </td><td style="width: 50%"><input type="text" colspan="1" class="form-control" id="optionalComment" name="optionalComment" style="" size=30 placeholder="Leave blank if none"></td> </tr>
											
											</table>
											<input type="hidden" value="<?php echo $requestID; ?>" id="requestID" name="requestID">
											<input type="hidden" value="<?php echo $transactionType; ?>" id="transactionType" name="transactionType">
											<input type="hidden" value="<?php echo $transResidentID; ?>" id="transResidentID" name="transResidentID">
											<center><td width="250" colspan="4" style="text-align:Center; right:-50px;">
												<button name="approve" id="approve" class="btn btn-primary" onClick="TransactionSuccess(1)"> Approve </button>
												<button name="deny" id="deny" class="btn btn-danger" onClick="TransactionSuccess(2)"> Deny </button>
											</td></center>										
											
								  
										
									</div>
								</div>
			
			<!-- 
			<div>
				<table>
					<tr>
					   <td width="10"><label class="control-label">Year</label><p class="form-control-static"><?php echo $year; ?></p></td>
					   <td width="500" ><label class="control-label">Place of Issue (City/Mun./Prov.)</label><p class="form-control-static">Barangay 28-C D.Suazo St., Poblacion District, Davao City</p></td>
					   <td width="200" ><label class="control-label">Date Issued</label><p class="form-control-static"><?php echo $curDate; ?></p></td>
					   <td width="300" style="text-align:center"><label class="control-label"> </label><p class="form-control-static">CNXXXXXXXX</p></td>
					</tr>   
					<tr>
						<td width="100" ><label class="control-label">Surname</label><p class="form-control-static"><?php echo $surname; ?></p></td>
						<td width="21" ><label class="control-label">First</label><p class="form-control-static"><?php echo $first; ?></p></td>
						<td width="2" ><label class="control-label">Middle</label><p class="form-control-static"><?php echo $middle; ?></p></td>
						<td width="2" ><label class="control-label">Date of Birth</label><p class="form-control-static"><?php echo $birthdate; ?></p></td>
					   
					</tr>
					<tr>
						<td width="250" colspan="2" ><label class="control-label">Place of Birth</label><p class="form-control-static"><?php echo $birthplace; ?></p></td>
						<td width="250" colspan="2" ><label class="control-label">Address</label><p class="form-control-static"><?php echo $address; ?></p></td>
					</tr>
					<tr>
						<td width="250" colspan="1" ><label class="control-label">Sex</label><p class="form-control-static"><?php echo $gender; ?></p></td>
						<td width="250" colspan="2" ><label class="control-label">Civil Status</label><p class="form-control-static"><?php echo $civilstatus; ?></p></td>
						<td width="250" colspan="1" ><label class="control-label">Height / Weight</label><p class="form-control-static"><?php echo $height." / ".$weight."Kg"; ?></p></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td width="250" colspan="1" style="text-align:center"><label class="control-label">Total</label><p class="form-control-static"></p></td>
						<td><input type="text" class="form-control" id="amountPaid" name="amountPaid" size=45 placeholder="Payment"></td>
					</tr>
					<tr>
						<input type="hidden" value="<?php echo $requestID; ?>" id="requestID" name="requestID">
						<input type="hidden" value="<?php echo $transactionType; ?>" id="transactionType" name="transactionType">
						<input type="hidden" value="<?php echo $transResidentID; ?>" id="transResidentID" name="transResidentID">
						<td></td>
						<td><input type="text" colspan="2" class="form-control" id="optionalComment" name="optionalComment" size=45 placeholder="Optional Comment"></td>
						<td width="250" colspan="4" style="text-align:right; right:-50px;"><button name="deny" id="deny" class="btn btn-primary" onClick="TransactionSuccess()"> Mark as Paid </button></td>
					</tr>
				</table>
			</div>
			-->
				
				
											<?php 
					mysqli_close($conn);
			}
			else die("<script>location.href = 'index.php'</script>");		
											?>
			
			</div>
		</div>
				
				<form name="transactionRequestSuccess" method="POST" action="/success/newTransaction.php"> <!-- Add Transaction -->
						<input type="hidden" value="" id="rID" name="rID">
						<input type="hidden" value="" id="tType" name="tType">
						<input type="hidden" value="" id="tRID" name="tRID">
						<input type="hidden" value="" id="amount" name="amount">
						<input type="hidden" value="" id="optionalComment" name="optionalComment">
						<input type="hidden" name="trans_empid" id="trans_empid" value="<?php echo $_SESSION['u_employeeid']; ?>">
				</form>
				
				<form name="denySuccess" method="POST" action="/success/denyTransaction.php"> <!-- Deny Transaction -->
						<input type="hidden" value="" id="requestID" name="requestID">
						<input type="hidden" value="" id="transactionType" name="transactionType">
						<input type="hidden" value="" id="transResidentID" name="transResidentID">
						<input type="hidden" value="" id="optionalReason" name="optionalReason">
						<input type="hidden" name="trans_empid" id="trans_empid" value="<?php echo $_SESSION['u_employeeid']; ?>">
				</form>
				
				
			</section>
		</div>
		
	<?php	
		
		include("dash-bot.php");
	?>

    </body>
</html>

<!-- AC -->

<script type="text/javascript">




		
</script>
<script>
	$("#amountPaid, #optionalComment").keyup(function(event){
		if(event.keyCode == 13){
			$("#deny").click();
		}
	});	
</script>