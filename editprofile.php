<!DOCTYPE html>
<html>
<title></title>
<head></head>
<body>

<?php
if(isset($_COOKIE['ux'])){?>

<?php
	include('/_sql/config.php');
	
	$household_id = 0;
	
	if(isset($_POST['id'])){	
	
		$id = mysql_real_escape_string($_POST['id']);

		$selectSql = mysqli_query($conn,"SELECT family_name, middle_name, first_name, gender, precinctNo, birth_date, birth_place, civilstatus, height, weight, dependent, personal_income, username, password, email, contact_number, household_id, address, position, GET_TOTALREQUESTSBYTYPE('$id', 7) edit FROM resident INNER JOIN household on resident.household_id = household.id LEFT JOIN employee ON resident.id = employee.resident_id WHERE resident.id = '$id' LIMIT 1;");
		$row = mysqli_fetch_array($selectSql);

			$family_name = $row['family_name'];
			$middle_name = $row['middle_name'];
			$first_name = $row['first_name'];
			$gender = $row['gender'];
			$precinctNo = $row['precinctNo'];
			$birth_date = $row['birth_date'];
			$birth_place = $row['birth_place'];
			$civilstatus = $row['civilstatus'];
			$height = $row['height'];
			$weight = $row['weight'];
			$dependent = $row['dependent'];
			$personal_income = $row['personal_income'];
			$username = $row['username'];
			$password = $row['password'];
			$email = $row['email'];
			$contact_number = $row['contact_number'];
			$household_id = $row['household_id'];
			$address = $row['address'];
			$position = $row['position'];
			$hasEdit = $row['edit'];








			if($hasEdit > 0)
				$hasEdit = 1;
			
			
			
		
	}
	mysqli_close($conn);
	
?>

<?php
?>




<?php include("dash-top.php"); ?>

	
                <!-- Content Header (Page header) -->
				<form id="EditInformation" name="EditInformation">
			
                <!-- Main content -->
                <section class="content">
                    <div class="row" style="margin-left: 158px" >
						<div class="col-lg-4">
							<section class="panel">
								<header class="panel-heading">
									Personal Information
								</header> 
								<div class="panel-body">
									<div class="col-lg-11">
								  
										<!--************************************
											*
											*		PERSONAL INFORMATION
											*
											************************************ -->
										
											<div class="form-group">
												<label for="exampleInputEmail1">Firstname</label>										
												<input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $first_name; ?>" disabled="">
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Middle Name</label>
												<input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $middle_name; ?>" disabled="">
											</div>
										
											<div class="form-group">
												<label for="exampleInputEmail1">Last Name</label>
												<input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $family_name; ?>" disabled="">
											</div>
										 
											<label for="exampleInputEmail1">Gender</label>
												<div class="form-group">
													<input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $gender; ?>" disabled="">
												</div>
												  
											<label for="exampleInputEmail1">Precint</label>
												
													
													<div class="form-group">
														<select class="form-control m-b-10" id="precinct">
															<option <?php if ($precinctNo === "First") echo "selected"; ?>>First</option>
															<option <?php if ($precinctNo === "Second") echo "selected"; ?>>Second</option>
															<option <?php if ($precinctNo === "Third") echo "selected"; ?>>Third</option>
														</select> 
													</div>
													
											<label for="birthdate">Birth Date</label>
												<div class="form-group">
													<div class="col-lg-13">	
														<input class="form-control" id="birthdate" name="birthdate" type="text" placeholder="<?php echo date("F m, Y", strtotime($birth_date)); ?>" disabled="">
													</div>
												</div>
											<label for="birthplace">Birth Place</label>
												<div class="form-group">
													<input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $birth_place; ?>" disabled="">
												</div>
											
											<label for="address">Current Address</label>
												<div class="form-group">
													<!-- TURN OFF AUTOFILL; CHROME -->
													<input type="text" class="form-control search" id="address" name="address" value="<?php echo $address; ?>" autocomplete="false">
													<input type="hidden" value="<?php echo $household_id; ?>" id="addID" name='addID'>
													<div id="result"></div>
													<p class="help-block">Check autofill for common locality.</p>
												</span></div>
									</div>	 
								</div>
							</section>
							
						</div>
						
						
						<div class="col-lg-4">
							<section class="panel">
								<header class="panel-heading">
									Other Information
								</header>
								<div class="panel-body">
									<div class="col-lg-11">
										<!--************************************
											*
											*		OTHER INFORMATION
											*
											************************************ -->
										
										<label class="col-sm-2 control-label col-lg-2">Relationship</label>
										<div class="col-lg-5"> &nbsp;	
											<div class="radio">
											
												<label>
													<input type="radio" name="relationship" id="single" value="Single" <?php if ($civilstatus === "Single") echo "checked='checked'"; ?>>
													Single
												</label><br>
												<label>
													<input type="radio" name="relationship" id="married" value="Married" <?php if ($civilstatus === "Married") echo "checked='checked'"; ?>>
													Married
												</label>
												<label><br>
													<input type="radio" name="relationship" id="divorced" value="Divorced" <?php if ($civilstatus === "Divorced") echo "checked='checked'"; ?>>
													Divorced
												</label>
											
											</div>
											
											<div style="right: 100%; margin-left: -50%; margin-top: -10px;">
												<label for="phone">Mothers Name</label>
														<select class="form-control m-b-10" id="mothers">
															<option>None</option>
															<?php 
															include('/_sql/config.php');
															$result = mysqli_query($conn, "SELECT id, GET_FULLNAME(id, 0) fname FROM resident WHERE gender='Female' AND household_id = '$household_id' AND id <> $id;");
															$rows = mysqli_num_rows($result);
															if($rows)
															{
																while($row=mysqli_fetch_array($result))
																	echo "<option id=".$row['id'].">".$row['fname']."</option>";
															}
															
															?>
														</select> 
												
												<label for="email">Fathers Name</label>
														<select class="form-control m-b-10" id="fathers">
															<option>None</option>
															<?php 
															$result = mysqli_query($conn, "SELECT id, GET_FULLNAME(id, 0) fname FROM resident WHERE gender='Male' AND household_id = '$household_id' AND id <> $id;");
															$rows = mysqli_num_rows($result);
															if($rows)
															{
																while($row=mysqli_fetch_array($result))
																	echo "<option id=".$row['id'].">".$row['fname']."</option>";
															}
															?>
														</select> 
												
												<label for="email">Guardians Name</label>
														<select class="form-control m-b-10" id="guardians">
															<option>None</option>
															<?php 
															$result = mysqli_query($conn, "SELECT id, GET_FULLNAME(id, 0) fname FROM resident WHERE household_id = '$household_id' AND id <> $id;");
															$rows = mysqli_num_rows($result);
															if($rows)
															{
																while($row=mysqli_fetch_array($result))
																	echo "<option id=".$row['id'].">".$row['fname']."</option>";
															}
															mysqli_close($conn);
															
															?>
														</select> 
												
											</div>
											
										</div>
								 
										<div class="col-lg-5">	
											<label for="exampleInputEmail1">Height</label>
												<div class="form-group">
													<select class="form-control m-b-10" id="height">
														<option <?php if ($height == "4'5") echo "selected"; ?>>4'5</option>
														<option <?php if ($height === "4'6") echo "selected"; ?>>4'6</option>
														<option <?php if ($height === "4'7") echo "selected"; ?>>4'7</option>
														<option <?php if ($height === "4'8") echo "selected"; ?>>4'8</option>
														<option <?php if ($height === "4'9") echo "selected"; ?>>4'9</option>
														<option <?php if ($height === "5'0") echo "selected"; ?>>5'0</option>
														<option <?php if ($height === "5'1") echo "selected"; ?>>5'1</option>
														<option <?php if ($height === "5'2") echo "selected"; ?>>5'2</option>
														<option <?php if ($height === "5'3") echo "selected"; ?>>5'3</option>
														<option <?php if ($height === "5'4") echo "selected"; ?>>5'4</option>
														<option <?php if ($height === "5'6") echo "selected"; ?>>5'5</option>
														<option <?php if ($height === "5'7") echo "selected"; ?>>5'7</option>
														<option <?php if ($height === "5'8") echo "selected"; ?>>5'8</option>
														<option <?php if ($height === "5'9") echo "selected"; ?>>5'9</option>
														<option <?php if ($height === "6'0") echo "selected"; ?>>6'0</option>
													</select>
												</div>
											
												<label for="weight">Weight (in kg)</label>
													<div class="col-lg-15">	
														<div class="form-group">
															<select class="form-control m-b-10" id="weight">
																<?php
																	$weightSample = 20;
																	while($weightSample <= 150)
																	{
																		?>
																		<option <?php if ($weight == $weightSample) echo "selected"; ?>><?php echo $weightSample; ?></option>
																		<?php
																		$weightSample = $weightSample + 1;
																	}
																?>
															</select>
														</div>
													</div>
											
												
												
												<label for="personalincome">Income (in PHP)</label>
													<div class="form-group">
														<input type="text" class="form-control" id="personalincome" name="personalincome" value="<?php echo $personal_income; ?>">
													</div>
													
													
											<label for="weight">Position in Barangay</label>
													<div class="col-lg-15">	
														<div class="form-group">
															<select class="form-control m-b-10" id="employee">
																<option <?php if($position == NULL) echo "selected='selected'" ?>>None</option>
																<option <?php if($position == "Barangay Kagawad") echo "selected='selected'" ?>>Barangay Kagawad</option>
																<option <?php if($position == "Barangay Kagawad") echo "selected='selected'" ?>>Barangay Secretary</option>
																<option <?php if($position == "Barangay Tresurer") echo "selected='selected'" ?>>Barangay Tresurer</option>
																<option <?php if($position == "Lupong") echo "selected='selected'" ?>>Lupong</option>
																<option <?php if($position == "SK Chairman") echo "selected='selected'" ?>>SK Chairman</option>
																<option <?php if($position == "Barangay Captain") echo "selected='selected'" ?>>Barangay Captain</option>
															</select>
														</div>
													</div>
										</div>
									</div>
								</div>
							</section>
							
							<section class="panel">
								<header class="panel-heading">
									Contact Information
								</header>
								<div class="panel-body">
								<!--************************************
									*
									*		CONTACT INFORMATION
									*
									************************************ -->
									<div class="panel-body">
									
										<form class="form-horizontal" role="form">
										
											<div class="col-lg-5">
												<label for="phone">Cell Number</label>
												
												<div class="form-group">
													<input type="text" class="form-control" id="phone" name="phone" value="<?php echo $contact_number; ?>">
												</div>
												
												<label for="email">Email</label>
												<div class="form-group">
													<label class="sr-only" for="email">Email address</label>
													<input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
												</div>
												
											</div>
										</form>
									</div>
								</div>
							</section>
							
						</div>
					  
						<div class="col-lg-3">
							<section class="panel">
                              <header class="panel-heading">
                                  Login Credentials
                              </header>
								<div class="panel-body">
										<div class="form-group">
											<!--************************************
											*
											*		USER INFORMATION
											*
											************************************ -->
											<label for="username" class="col-lg-2 col-sm-2 control-label">Username</label>
											<div class="col-lg-15" id="usernameDiv">
												<input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $username; ?>" disabled="">
												<p class="help-block" id="usernameExists"></p>
											</div>
										</div>
										
										<div class="form-group">
											<input type="button" class="btn" id="changepass" value="Change Password"/>

											<p class="help-block" style="color: red; display:none;" id="InvalidCredentials" name="InvalidCredentials"></p>


											<br>
											<div class="col-lg-15" id="passwordDiv">
													<input class="form-control" id="password" type="password" placeholder="New Password">
													<input type="hidden" id="newPass" name="newPass" value="">

													<p class="help-block" id="usernameExists"></p>
											</div>

											<div class="col-lg-15" id="passwordConfirmDiv">
													<input class="form-control" id="passwordConfirm" type="password" placeholder="Confirm Password">
													<p class="help-block" id="usernameExists"></p>
											</div>
										</div>


										
										
								</div>
							</section>
							
							<div class="form-group">
								
								<div class="col-lg-offset-3 col-lg-10">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="button" name="submits" id="submits" class="btn btn-danger" value="Save Changes" onClick="Edit()" <?php if ($hasEdit != 0) echo "disabled"; ?>/>
									<?php if($hasEdit != 0): ?>
										<center style="color:red; margin-left:-70px;"><h6>Constituent has pending Edit Profile request.</h6>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
                </section>
				</form>
            </aside>
        </div>
		
		<form name="editform" method="post" action="/success/editprofile.php">
			<input type="hidden" value="" id="noredflags" name="noredflags">
			<input type="hidden" value="<?php echo $id; ?>" id="id" name="id">
			<input type="hidden" value="" id="validatedBirthplace" name="validatedBirthplace">
			<input type="hidden" value="" id="validatedAddress" name="validatedAddress">
			<input type="hidden" value="" id="validatedWeight" name="validatedWeight">
			<input type="hidden" value="" id="validatedPersonalincome" name="validatedPersonalincome">
			<input type="hidden" value="" id="validatedPhone" name="validatedPhone">
			<input type="hidden" value="" id="validatedEmail" name="validatedEmail">
			<input type="hidden" value="" id="validatedMother" name="validatedMother">
			<input type="hidden" value="" id="validatedFather" name="validatedFather">
			<input type="hidden" value="" id="validatedGuardian" name="validatedGuardian">
			
			<input type="hidden" value="" id="validatedPrecinct" name="validatedPrecinct">
			<input type="hidden" value="" id="validatedHeight" name="validatedHeight">
			<input type="hidden" value="" id="validatedRelationship" name="validatedRelationship">
			<input type="hidden" value="" id="validatedPass" name="validatedPass">
			<input type="hidden" value="" id="position" name="position">
			<input type="hidden" id ="currentPass" name="currentPass" value="<?php echo $password; ?>">
			
			<input type="hidden" value="" id="validatedDependency" name="validatedDependency">
		</form>
    </body>
</html>

<?php 
}?>













	<!------------------------------------------------------------------ SECURE PASS ABLE TO PRESS ENTER, AND ADDRESS AUTOFILL ------------------------------------------>
		<script>

			$('#passwordDiv').hide();
			$('#passwordConfirmDiv').hide();

			$("#passwordConfirm").keyup(function(event){
				if(event.keyCode == 13){
					$("#submits").click();
				}
			});	

			$("#changepass").click(function()
			{
				<?php 
				if($_SESSION["u_id"] == $id):
				?>
					$('#newPass').val("1");
					$('#passwordDiv').slideDown();
					$('#passwordConfirmDiv').slideDown();
					$("#changepass").slideUp();
				<?php 
				else:
				?>
					textOUT = "Cannot change password of constituent.";
					document.getElementById("InvalidCredentials").innerHTML = textOUT;
					$("#InvalidCredentials").slideDown();
				<?php 
				endif;
				?>
			});

			$("#securepassconf").keyup(function(event){
				if(event.keyCode == 13){
					$("#submits").click();
				}
			});
		</script>
		<!------------------------------------------------------------------ AutoFill data for Household ------------------------------------------>
		<script type="text/javascript">
		$(function()
		{
			$("#result").hide();
			$(".search").keyup(function() 
			{ 
			var searchid = $(this).val();
			var dataString = 'search='+ searchid;
			if(searchid!='')
			{
				
				$.ajax
				({
					type: "POST",
					url: "ajax/ac.php",
					data: dataString,
					cache: false,
					success: function(html)
					{
						$("#result").html(html).slideDown();
					}
				});
			}return false;    
			});
			
			jQuery("#result").on("click", function(e)
			{
				$name = $('span.returnAdd',this).html(); 
				$name = $("<div/>").html($name).text().toString();
				$id = $('span.returnID',this).html(); 
				$id = $("<div/>").html($id).text().toString();
				$('#addID').val($id);
				$('#address').val($name); //Cool 
			});
			
			jQuery(document).on("click", function(e) 
			{ 
				var $clicked = $(e.target);
				if (! $clicked.hasClass("search")){
				jQuery("#result").slideUp(); 
				}
			});
			$('#address').click(function()
			{
				jQuery("#result").slideUp();
			});
			
		});
		
		</script>
		<!--http://www.2my4edge.com/2013/08/autocomplete-search-using-php-mysql-and.html-->
		
		<!------------------------------------------------------------------ Check for Existing Username ------------------------------------------>
