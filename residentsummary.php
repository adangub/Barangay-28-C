<!DOCTYPE html>

<?php include("/dash-top.php"); 
	if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id()) 
	{
?>
<html>
    <head>
    </head>
    <body>
	
                <!-- Content Header (Page header) -->
				
			
                <!-- Main content -->
                <section class="content">
                    <div class="row" style="margin-left: 300px" >
						<div class="col-lg-11">
							<section class="panel">
								
									<!--************************************
										*
										*		PERSONAL INFORMATION
										*
										************************************ -->	
										
									<?php
										include '/_sql/config.php';
										$requestType = "NULL";
										$user = -1;
										$year = date("Y");
										
										if(isset($_GET['type']) && isset($_GET['user'])) 
										{
											$requestType = mysql_real_escape_string($_GET["type"]);
											$user = mysql_real_escape_string($_GET["user"]);
										}
										
										$result=mysqli_query($conn,"SELECT GET_FULLNAME($user, 0) as 'fullname', resident.first_name, GET_FULLNAME(resident.fathers_id, 0) fathersname, GET_FULLNAME(resident.mothers_id, 0) mothersname, GET_FULLNAME(resident.guardians_id, 0) guardiansname, resident.middle_name, resident.family_name, resident.gender, resident.precinctNo, resident.birth_date, resident.birth_place, resident.civilstatus, resident.height, resident.weight, resident.dependent, resident.personal_income, resident.username, resident.email, resident.contact_number, resident.regdate, resident.image, household.address, household.id FROM resident INNER JOIN household ON resident.household_id=household.id WHERE resident.id='$user' LIMIT 1;");
										$row = mysqli_fetch_array($result);
										
										$first_name = $row['first_name'];
										$middle_name = $row['middle_name'];
										$family_name = $row['family_name'];
										
										$image = $row['image'];
										
										$fullname = $row['fullname'];
										$fathersname = $row['fathersname'];
										if(!$fathersname)
											$fathersname = "-";
										$mothersname = $row['mothersname'];
										if(!$mothersname)
											$mothersname = "-";
										$guardiansname = $row['guardiansname'];
										if(!$guardiansname)
											$guardiansname = "-";
										$gender = $row['gender'];
										$birthday = date('m/d/Y', strtotime($row['birth_date']));
											$birthyear = date('Y', strtotime($row['birth_date']));
										$age = $year-$birthyear;
										$hometown = $row['birth_place'];
										$currentcity = $row['address'];
										$civilstatus = $row['civilstatus'];
										$height = $row['height'];
										$weight = $row['weight'].' kg';
										$email = $row['email'];
										$contact = $row['contact_number'];
										$precinct = $row['precinctNo'];
										$dependent = $row['dependent'];
											if ($dependent = 0)
												$dependent = "No";
											else $dependent = "Yes";
										$income = $row['personal_income'];
										$income = number_format((int)$income,2);
											if ($income == "0.00") $income = "-";
											else $income = "PHP ".$income;
										
										$householdid = $row['id'];
										$username = $row['username'];
										$registrationdate = date('l, F d, Y h:i A', strtotime($row['regdate']));
										
										?>
										<header class="panel-heading">
											Personal Information
										</header>
										<br>
										
										<div class="panel-body">
											<div class="col-lg-13">
											
												
											<div style="; float: left; width: 100%; background: #ffffff; min-height: 300px;">
												<div class="form-group"  style="float: right; width: 40%; background: #ffffff; min-height: 400px;">
													
													<?php 
														if($image != NULL)
														{	echo "<table><tr>";
															echo "<img src = '/img/user/".$image."' style='border-radius: 8px 8px 8px 8px; border-width: 3px; margin-left: 0px; cursor: pointer; cursor: hand;' id='profilepic'/>";
															echo "</tr></table>";
														}
														else
														{
															?>
															<img src = '/img/default.jpg'  style='border-style: groove; margin-left: 0px; width: 200px; height: 200px; cursor: pointer; cursor: hand;' id='profilepic'/>
															<?php
														}
														?>
													
														<div class="form-group">
															<label class="col-lg-12 col-sm-6 control-label"><p style="font-size:20px; margin-left: -15px;"><?php echo ucwords(strtolower($first_name))." ".ucfirst($middle_name)." ".ucfirst($family_name); ; ?></p></label>
														</div>

														
														<form action='imaging.php' method='post' name="imaging" id='imaging' enctype='multipart/form-data'>
															<input type="hidden" name="uploader" id="uploader" value="<?php echo $user ?>">
															<input type="file" name="image" id="image" style="margin-left: 40px; display:none;">
															<input type='button' class="btn" style="width: 205px; display:none;" id="updateButton" name="updateButton" value='Update Profile Picture' onClick="validateItem()"/>
														</form>

														<br>
														<?php 
														if ($_SESSION['u_isemployee'] == 1):?>
														<button name="edit" id="<?php echo $user; ?>" style="width: 205px" class="btn btn-primary" onClick="editProfile()"> Edit Profile </button>
														<?php 
														endif;?>
													
												</div>
												<table>	
													<tr>
														<div class="form-group">
															<label class="col-lg-3 col-sm-3 control-label">ID:</label>
																<p class="form-control-static"><?php echo str_pad($user,10,"0",STR_PAD_LEFT); ?></p>
														</div>
														
													</tr>
													
													<tr>
														<div class="form-group">
															<label class="col-lg-3 col-sm-3 control-label">Gender:</label>
																<p class="form-control-static" style=""><?php echo $gender; ?></p>
														</div>
													</tr>
													<tr>
														<div class="form-group">
															<label class="col-lg-3 col-sm-3 control-label">Birthday:</label>
																<p class="form-control-static"><?php echo $birthday; ?></p>
														</div>
													</tr>
													<tr>
														<div class="form-group">
															<label class="col-lg-3 col-sm-3 control-label">Age:</label>
																<p class="form-control-static"><?php echo $age; ?></p>
														</div>
													</tr>	
													<tr>
														<div class="form-group">
															<label class="col-lg-3 col-sm-3 control-label">Status:</label>
																<p class="form-control-static"><?php echo $civilstatus; ?></p>
														</div>
													</tr>	
													<tr>
														<div class="form-group">
															<label class="col-lg-3 col-sm-3 control-label">Hometown:</label>
																<p class="form-control-static"><?php echo $hometown; ?></p>
														</div>
													</tr>
													<tr>
														<div class="form-group">
															<label class="col-lg-3 col-sm-3 control-label">Current City:</label>
																<p class="form-control-static"><?php echo $currentcity; ?></p>
														</div>
													</tr>
													<tr>
														<div class="form-group">
															<label class="col-lg-3 col-sm-3 control-label">Height:</label>
																<p class="form-control-static"><?php echo $height; ?></p>
														</div>
													</tr>
													<tr>	
														<div class="form-group">
															<label class="col-lg-3 col-sm-3 control-label">Weight:</label>
																<p class="form-control-static"><?php echo $weight; ?></p>
														</div>
													</tr>
													<tr>
														<div class="form-group">
															<label class="col-lg-3 col-sm-3 control-label">Email:</label>
																<p class="form-control-static"><?php echo $email; ?></p>
														</div>
													</tr>
													<tr>	
														<div class="form-group">
															<label class="col-lg-3 col-sm-3 control-label">Contact:</label>
																<p class="form-control-static"><?php echo $contact; ?></p>
														</div>
													</tr>
													
													<tr>	
														<div class="form-group">
															<label class="col-lg-3 col-sm-3 control-label">Mothers Name:</label>
																<p class="form-control-static"><?php echo $mothersname; ?></p>
														</div>
													</tr>
													
													<tr>	
														<div class="form-group">
															<label class="col-lg-3 col-sm-3 control-label">Fathers Name:</label>
																<p class="form-control-static"><?php echo $fathersname; ?></p>
														</div>
													</tr>
													
													<tr>	
														<div class="form-group">
															<label class="col-lg-3 col-sm-3 control-label">Guardians Name:</label>
																<p class="form-control-static"><?php echo $guardiansname; ?></p>
														</div>
													</tr>
													
												</table>
												
												
											</div>
											
											</div>
											
										</div>
										
										
										<br>
										<header class="panel-heading">
											Barangay Information
										</header>
										<br>
										
										
										<div class="panel-body">
											<div class="col-lg-13">
												
												
												<div class="form-group">
													<label class="col-lg-3 col-sm-3 control-label">Precinct:</label>
														<p class="form-control-static"><?php echo $precinct; ?></p>
												</div>
												
												<div class="form-group">
													<label class="col-lg-3 col-sm-3 control-label">Dependent:</label>
														<p class="form-control-static"><?php echo $dependent; ?></p>
												</div>
												
												<div class="form-group">
													<label class="col-lg-3 col-sm-3 control-label">Income:</label>
														<p class="form-control-static"><?php echo $income; ?></p>
												</div>
												
												<div class="form-group">
													<label class="col-lg-3 col-sm-3 control-label">Blotter Records:</label>
													<?php
														$result = mysqli_query($conn, "SELECT COUNT(complainant.id) as complainant FROM complainant INNER JOIN blotter ON blotter.complainant_id = complainant.id WHERE resident_id = $user AND blotter.valid = 1;");
														$row = mysqli_fetch_array($result);
														$complainant = $row['complainant'];
														$result = mysqli_query($conn, "SELECT COUNT(respondents.id) as respondent FROM respondents INNER JOIN blotter ON respondents.blotter_id = blotter.id WHERE resident_id = $user AND blotter.valid = 1;");
														$row = mysqli_fetch_array($result);
														$respondent = $row['respondent'];
													?>

													<?php if($complainant > 0): ?>
													<form action = "" method = "GET" style="margin-left:25%">
														<input type="hidden" value="<?php echo $user; ?>" id="complainant" name="complainant">
														<button type="submit" class="hyperbutton" formaction="all-blotters" formmethod="GET" class="form-control-static"><?php echo "$complainant as Complainant"; ?></button>
													</form>
													<?php else: echo "$complainant as Complainant<br>"; endif; ?>
													
													<?php if($respondent > 0): ?>
													<form action = "" method = "GET" style="margin-left:25%">
														<input type="hidden" value="<?php echo $user; ?>" id="respondent" name="respondent">
														<button type="submit" class="hyperbutton" formaction="all-blotters" formmethod="GET" class="form-control-static"><?php echo "$respondent as Respondent"; ?></button>
													</form>
													<?php else: echo "$respondent as Respondent"; endif; ?>
														
													
												</div>
												
												<div class="form-group">
													<label class="col-lg-3 col-sm-3 control-label">Programs Participated:</label>
													<?php
														$result = mysqli_query($conn, "SELECT COUNT(*) as participated FROM participants WHERE resident_id = $user;");
														$row = mysqli_fetch_array($result);
														$participated = $row['participated'];
													?>
														<p class="form-control-static"><?php echo $participated; ?></p>
												</div>
												
												<div class="form-group">
													<label class="col-lg-3 col-sm-3 control-label">Transaction Records:</label>
													<?php
														$result = mysqli_query($conn, "SELECT COUNT(*) as transactions FROM transactions WHERE resident_id = $user;");
														$row = mysqli_fetch_array($result);
														$transactions = $row['transactions'];
													?>
														<p class="form-control-static"><?php echo $transactions." transaction/s"; ?></p>
												</div>
												
												<div class="form-group">
													<label class="col-lg-3 col-sm-3 control-label">Total Paid for Transactions:</label>
													<?php
														$result = mysqli_query($conn, "SELECT SUM(amount) as total FROM transactions WHERE resident_id = $user;");
														$row = mysqli_fetch_array($result);
														$total = $row['total'];
														$total = number_format($total, 2);
													?>
														<p class="form-control-static"><?php echo "PHP ".$total; ?></p>
												</div>
											</div>
										</div>
										
										<br>
										<header class="panel-heading">
											Household Information
										</header>
										<br>
										
										<div class="panel-body">
										
											<div class="form-group">
												<label class="col-lg-3 col-sm-3 control-label">Household ID:</label>
													<p class="form-control-static"><?php echo str_pad($householdid,10,"0",STR_PAD_LEFT); ?></p>
											</div>
											
											<div class="form-group">
												<label class="col-lg-3 col-sm-3 control-label">Household Count:</label>
												
												
												
												
												<?php 
													$result = mysqli_query($conn,"SELECT COUNT(resident.id) total, verified FROM resident INNER JOIN requests ON resident.id = requests.resident_id WHERE household_id='$householdid' AND request_type_id = 1;");
													$row = mysqli_fetch_array($result);
													$total = $row['total'];
													?><p class="form-control-static"><?php echo $total; ?> members </p> <?php
												?>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Household Members:</label>
												<div class="marginator">
												<?php 
													$result = mysqli_query($conn,"SELECT resident.id, resident.family_name, resident.middle_name, resident.first_name, requests.verified FROM resident INNER JOIN requests ON resident.id = requests.resident_id WHERE resident.household_id='$householdid' AND resident.id <> '$user' AND request_type_id=1;");
													
													if (!mysqli_num_rows($result))
													{
														?><p class="form-control-static"><?php echo "None"; ?> </p> <?php
													}
													while($row = mysqli_fetch_array($result))
													{
														$fullname = $row['family_name'].', '.$row['first_name'].' '.$row['middle_name'];
														$familyid = $row['id'];
														?>
															<form action = "" method = "GET" style="margin-left:25%">
																<input type="hidden" value="<?php echo $familyid; ?>" id="user" name="user">
																<input type="hidden" value="View Profile" id="type" name="type">
																<button type="submit" class="hyperbutton" formaction="resident" formmethod="GET" class="form-control-static"><?php echo $fullname; ?></button>
															</form>
														<?php
													}
												?>
												</div>	
											</div>
										</div>
										
										<br>
										<header class="panel-heading">
											Account Information
										</header>
										<br>
										
										<div class="panel-body">
										
											<div class="form-group">
												<label class="col-lg-3 col-sm-3 control-label">Username:</label>
													<p class="form-control-static"><?php echo $username; ?></p>
											</div>
											<div class="form-group">
												<label class="col-lg-3 col-sm-3 control-label"><?php if(isset($_GET['type']) && isset($_GET['user'])) { $requestType = mysql_real_escape_string($_GET["type"]); if($requestType == "View Profile") echo "Resident Since:"; else echo "Requested on:"; }?></label> <!-- Change word if resident -->
													<p class="form-control-static"><?php echo $registrationdate; ?></p>
											</div>
										</div>
										
										
										
										
										
											<header class="panel-heading">
												Previous Requests
											</header>	
										<div class="panel-body col-lg-13" style="margin-left: -115px;">
										<?php 
										
										if(isset($_GET['type']) && isset($_GET['user'])) 
										{
											$requestType = mysql_real_escape_string($_GET["type"]);
											$user = mysql_real_escape_string($_GET["user"]);
											//if($requestType === "View Profile") //Can be accessed only from View Profiles
											
												?>
												
												
												
												
												
												
												
													<!--<div class="box-tools m-b-15">				SEARCH FOR CERTAIN REQUEST. TO BE IMPLEMENTED
														<div class="input-group">			
															<input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
															<div class="input-group-btn">
																<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
															</div>
														</div>
													</div>-->
													
													<div class = "allrequests" id= "allrequests">
														<table id="requests" class="" cellspacing="0" style="">
															<thead>
																<th style="width:10%"></th>
																<th style="width:13%">Comment</th>
																<th style="width:15%">Request Type</th>
																<th style="width:10%">Amount Paid</th>
																<th style="width:10%">Serviced By</th>
																<th style="width:15%">Requested</th>
																<th style="width:10%">Paid</th>
																<th></th>
																<th></th>
															</thead>
															<?php 
																
																$qry = "SELECT requests.id, requests.optional_comment, request_type.request_name, requests.date 'request_date', requests.verified, requests.transactions_id, transactions.amount, transactions.date 'transactions_date', GET_EMPNAME(transactions.employee_id,0) 'empname' FROM requests LEFT JOIN request_type ON requests.request_type_id = request_type.id LEFT JOIN transactions ON transactions.id=requests.transactions_id WHERE requests.resident_id = $user ORDER BY requests.date DESC;";
																$result = mysqli_query($conn, $qry);
																$qry = "SELECT eligibility FROM resident WHERE id = '$user';";
																$result2 = mysqli_query($conn, $qry);
																$row2 = mysqli_fetch_array($result2);
																$el = $row2['eligibility'];
																if(!$el) $el = 0;
																
																$label = "";
																$paidLabel = "";
																$labelText = "";
																$paidText = "";
																$paid = 0;
														
																while($row = mysqli_fetch_array($result))
																{
																	$paid = is_null($row['transactions_id']); //0 if paid | 1 if unpaid
																	$verified = $row['verified'];
																	$comment = $row['optional_comment'];
																	if(is_null($comment))
																		$comment = "-";
																	else $comment = '"'.$comment.'"';
																	
																	if($paid == 1 && $verified == 0) { $paidLabel = "warning"; $paidText = "Pending"; }
																	else if($paid == 0 && $verified == 1) { $paidLabel = "success"; $paidText = "Paid"; }
																	else if($verified == 2) { $paidLabel = "danger"; $paidText = "Denied"; }
																	?>
																	<tr>
																		<td><span class="label label-<?php echo $paidLabel; ?>"><?php echo $paidText; ?></span></td>
																		<td><?php echo $comment;?></td>
																		<td><?php echo $row['request_name']; ?></td>
																		<td><?php if($paid == 0 && !is_null($row['amount']) && $row['amount'] != 0) echo "PHP ".number_format($row['amount'], 2); else echo "-"; ?></td> <!-- If not null (Denied Profile) -->
																		<td><?php if($paid == 0) echo $row['empname']; else echo "-"; ?></td> 
																		<td><abbr class="timeago" title="<?php echo $row['request_date']; ?>"></abbr></td> 
																		<td>
																			<?php 
																			if($paid == 0 && !is_null($row['amount'])) 
																				echo "<abbr class='timeago' title='".$row['transactions_date']."'></abbr>"; // another approach, naay bug if the other way
																			else
																				echo "-"; 
																			?>	
																		</td> 	
																		<td></td>
																		<td>
																			<?php 
																			$rtype = $row['request_name'];
																			if($paid == 1 && $verified != 2 && $_SESSION['u_isemployee'] == 1):{ ?>
																				<form name="newTransactionForm" method="post" action="newTransaction.php">
																					<input type="hidden" value="<?php echo $row['id']; ?>" id="requestID" name="requestID">
																					<input type="hidden" value="<?php echo $row['request_name']; ?>" id="transactionType" name="transactionType">
																					<input type="hidden" value="<?php echo $rtype; ?>" id="transactionTypeText" name="transactionTypeText">
																					<input type="hidden" value="<?php echo $user; ?>" id="transResidentID" name="transResidentID">
																					<input type="submit" class="btn btn-primary" name="select" id="select" value="Check">
																				</form>	
																				
																			<?php }
																			
																			elseif($rtype !='Cedula Request' && $rtype != 'Profile Edit Request' && $rtype != "Blotter Request" && $_SESSION['u_isemployee'] == 1 && $verified != 2 && $el == 1): ?>
																			<button name="print" id="<?php echo $row['id']; ?>" class="btn" value="<?php echo $row['request_name']; ?>" onClick="printTransaction(this.id, this.value)"> Print </button></td>
																			
																			<?php 
																			elseif($rtype !='Cedula Request' && $rtype != 'Profile Edit Request' && $rtype != "Blotter Request" && $verified != 2 && $el == 0):
																			?>
																			
																			<form action = "" method = "GET" style="margin-left:25%">
																				<input type="hidden" value="<?php echo $user; ?>" id="allblot" name="allblot">
																				<h6><i><p class="help-block">Not Eligible <button type="submit" class="hyperbutton" formaction="all-blotters" formmethod="GET" class="form-control-static"><?php echo "(Why?)"; ?></button></i><h6></p>
																			</form>
																	</tr>
																
																<?php		endif;
																}
															?>
															
														</table>
													</div>
												
												<?php 
												if ($_SESSION['u_isemployee'] == 1):
												?><!--blaze it-->
												<div style="margin-left: 243px;">
													
													<a href="<?php if($requestType === "View Profile") { ?>memberList.php <?php } else if($requestType ==="Transaction History") {?> history.php <?php } ?>" class="btn btn-danger" style="margin-left:1000px">Go Back</a> 
												</div>
											<?php
												endif;
										}
										mysqli_close($conn);
	}
	else die("<script>location.href = 'index.php'</script>");
										?>
										</div>
							</section>
						</div>	
					</div>
					
					
					 
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
			
        </div><!-- ./wrapper -->
		
        <!-- jQuery 2.0.2 -->
        
		
		<form name="newTransactionForm" method="post" action="newTransaction.php">
			<input type="hidden" value="" id="requestID" name="requestID">
			<input type="hidden" value="" id="transactionType" name="transactionType">
			<input type="hidden" value="" id="transactionTypeText" name="transactionTypeText">
			<input type="hidden" value="" id="transResidentID" name="transResidentID">
		</form>	
		
		<form name="printTrans" method="post" action="printrequest.php">
			<input type="hidden" value="" id="requestID" name="requestID">
			<input type="hidden" value="" id="transactionType" name="transactionType">	
		</form>	
		
		<form name="DenyTransactionForm" method="post" action="denyTransaction.php">
			<input type="hidden" value="" id="requestID" name="requestID">
			<input type="hidden" value="" id="transactionType" name="transactionType">
			<input type="hidden" value="" id="transactionTypeText" name="transactionTypeText">
			<input type="hidden" value="" id="transResidentID" name="transResidentID">
		</form>	
		
		<form name="editForm" method="post" action="editprofile.php">
			<input type="hidden" value="<?php echo $user; ?>" id="id" name="id">
		</form>	
	
    </body>
	
	
</html>

<script>
	$('#requests').DataTable({
		"iDisplayLength": 10,
		"bSort":false,
		
	});
	$("#updateButton").hide();
	$("#profilepic").click(function() 
	{
		$("#image").click();
		
	});
	
	$("#image").change(function()
	{
		$("#updateButton").slideDown();
	});
	

	$('#apply').click(function()
	{
		$("#apply").slideUp();
	});

	 if (window.location.hash != null && window.location.hash != '') 
        $('body').animate({
            scrollTop: $(window.location.hash).offset().top
        }, 1500);
	
	
</script>