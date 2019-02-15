<!DOCTYPE html>
<html>
    <head></head>
    <body>
	<?php
		include("dash-top.php");
	
			if(isset($_POST['requestID']) && isset($_POST['transactionType']) && isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id())
			{
				include("/_sql/config.php");
				$transactionType = mysql_real_escape_string($_POST['transactionType']);
				$requestID = mysql_real_escape_string($_POST['requestID']);
				
				$selectSql=mysqli_query($conn,"SELECT * from requests where id = '$requestID';");
					$row = mysqli_fetch_array($selectSql);
					$id = $row['id'];
					$date = $row['date'];
					$resident_id = $row['resident_id'];

				$selectSql=mysqli_query($conn,"SELECT * from resident where id = '$resident_id';");
					$row = mysqli_fetch_array($selectSql);
					$household_id = $row['household_id'];
					$first_name = $row['first_name'];
					$middle_name = $row['middle_name'];
					$family_name = $row['family_name'];
					$full_name = $first_name.' '.$middle_name.' '.$family_name;
					
				$selectSql=mysqli_query($conn,"SELECT * from household where id = '$household_id';");
					$row = mysqli_fetch_array($selectSql);
					$address = $row['address'];
					$purokNo = $row['purokNo'];
				
				
				
				
?>
				<div class="col-lg-offset-4 col-lg-6" ><br><br>
					<section class="panel">
						<header class="panel-heading">
							<?php echo $transactionType; ?>
						</header>
							<div class="form-group">
								<div class="panel-body">
									<div class="col-lg-12">
										<!--************************************
											*
											*		OTHER INFORMATION
											*
											************************************ -->
										
										
											<br>
											<table cellpadding="5" style="border: 3px solid #dfe3ee;background-color: #fafafa;">
											<tr><td>Full name : </td><td><?php echo $full_name; ?></td> </tr>
											<tr><td>Request : </td><td><?php echo $transactionType; ?></td> </tr>
											<tr><td>Address : </td><td><?php echo $address; ?></td> </tr>
											<tr><td>Purok No. : </td><td><?php echo $purokNo; ?></td> </tr>
											
											<?php
											if($transactionType=='Barangay Clearance Request' || $transactionType=='Police Clearance Request' || $transactionType=='NBI Clearance Request'){ ?>
											<form id="ctc" name="ctc">
											<tr><td>Community Tax Certificate # :</td><td><input type="text" class="form-control" id="ctcno" name="ctcno"></td></tr>
											<tr><td>CTC Date Issued : </td><td>											
											<div class="form-group">
													<div class="col-lg-4">	
														<select class="form-control m-b-10" id="ctcmonth" name="ctcmonth">
															<option>Month</option>
															<option>Jan</option>
															<option>Feb</option>
															<option>Mar</option>
															<option>Apr</option>
															<option>May</option>
															<option>Jun</option>
															<option>Jul</option>
															<option>Aug</option>
															<option>Sep</option>
															<option>Oct</option>
															<option>Nov</option>
															<option>Dec</option>
														</select>
													</div>
													<div class="col-lg-4">	
														<select class="form-control m-b-10" id="ctcday" name="ctcday">
															<option>Day</option>
															<?php
																$days = 1;
																while($days <= 31)
																{
																	?><option>
																	<?php echo $days; ?></option> <?php
																	$days = $days + 1;
																}
															?>
														</select>
													</div>
													<div class="col-lg-4">	
														<select class="form-control m-b-10" id="ctcyear" name="ctcyear">
															<option>Year</option>
															<?php
																$year = date("Y");
																$minuseighty = $year-80;
																while($year >= $minuseighty)
																{
																	?><option>
																	<?php echo $year; ?></option> <?php
																	$year = $year - 1;
																}
															?>
														</select>
													</div>
												</div>
												</td></tr>
											</form>
											<?php } ?>
											
											<?php
											if($transactionType=='Residency Request'){ ?>
											<form id="ctc" name="ctc">
											<tr><td>FURTHER CERTIFIES that he/she belongs to.. </td><td><textarea name="ctcno" id="ctcno" rows=5 cols=54 maxlength="400"></textarea></td></tr>
											<tr><td>This certification is issued.. </td><td><textarea name="ctcdate" id="ctcdate" rows=5 cols=54 maxlength="300"></textarea> </td></td></tr>
											</form>
											<?php } ?>
											
											
											</table>
											<button name="print" id="<?php echo $transactionType; ?>" class="btn btn-primary" value="print" onClick="print(this.id)"> Print Preview </button></td>
																			
								  
										
									</div>
								</div>
			
														<?php 
				mysqli_close($conn);
			}
			else die("<script>location.href = 'index.php'</script>");		
?>
			
							</div>
				</div>
				
				<form name="printing" method="post" action="docs/print.php">
				<input type="hidden" value="<?php echo $requestID; ?>" id="requestID" name="requestID">
				<input type="hidden" value="<?php echo $transactionType; ?>" id="reqType" name="reqType">
				<input type="hidden" value="" id="ctcno" name="ctcno">
				<input type="hidden" value="" id="ctcdate" name="ctcdate">
				</form>	
				
				
			</section>
	
		
	<?php	
		
		include("dash-bot.php");
	?>

    </body>
</html>

<!-- AC -->

<script>
	$("#amountPaid, #optionalComment").keyup(function(event){
		if(event.keyCode == 13){
			$("#deny").click();
		}
	});	
</script>