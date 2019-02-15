<!DOCTYPE html>

<?php include("dash-top.php"); ?>
<html>
	
    <head>
    </head>
    <body>
	
                <!-- Content Header (Page header) -->
				<form id="RegistrationInformation" name="RegistrationInformation">
			
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
												<input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Middle Name</label>
												<input type="text" class="form-control" id="midname" name="midname" placeholder="Middle Name">
											</div>
										
											<div class="form-group">
												<label for="exampleInputEmail1">Last Name</label>
												<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
											</div>
										 
											<label for="exampleInputEmail1">Gender</label>
												<div class="form-group">
													<select class="form-control m-b-10" id="gender">
														<option>Male</option>
														<option>Female</option>
													</select>
												</div>
												  
											<label for="exampleInputEmail1">Precint</label>
												<div class="form-group">
													<select class="form-control m-b-10" id="precinct">
														<option>First</option>
														<option>Second</option>
														<option>Third</option>
													</select>
												</div>
											<label for="birthdate">Birth Date</label>
												<div class="form-group">
													<div class="col-lg-4">	
														<select class="form-control m-b-10" id="month">
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
														<select class="form-control m-b-10" id="day">
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
														<select class="form-control m-b-10" id="year">
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
											<label for="birthplace">Birth Place</label>
												<div class="form-group">
													<input type="text" class="form-control" id="birthplace" name="birthplace" placeholder="Birthplace">
												</div>
											
											<label for="address">Current Address</label>
												<div class="form-group">
													<!-- TURN OFF AUTOFILL; CHROME -->
													<input type="text" class="form-control search" id="address" name="address" placeholder="Current Address" autocomplete="false">
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
													<input type="radio" name="relationship" id="single" value="Single" checked="checked">
													Single
												</label><br>
												<label>
													<input type="radio" name="relationship" id="married" value="Married">
													Married
												</label>
												<label><br>
													<input type="radio" name="relationship" id="divorced" value="Divorced">
													Divorced
												</label>
											</div>
										</div>
								  
										<div class="col-lg-5">	
											<label for="exampleInputEmail1">Height</label>
												<div class="form-group">
													<select class="form-control m-b-10" id="height">
														<option>Height</option>
														<option>4'0</option>
														<option>4'1</option>
														<option>4'2</option>
														<option>4'3</option>
														<option>4'4</option>
														<option>4'5</option>
														<option>4'6</option>
														<option>4'7</option>
														<option>4'8</option>
														<option>4'9</option>
														<option>5'0</option>
														<option>5'1</option>
														<option>5'2</option>
														<option>5'3</option>
														<option>5'4</option>
														<option>5'5</option>
														<option>5'6</option>
														<option>5'7</option>
														<option>5'8</option>
														<option>5'9</option>
														<option>6'0</option>
														<option>6'1</option>
														<option>6'2</option>
														<option>6'3</option>
														<option>6'4</option>
														<option>6'5</option>
														<option>6'6</option>
														<option>6'7</option>
													</select>
												</div>
											
												<label for="weight">Weight (in kg)</label>
													<div class="col-lg-15">	
														<div class="form-group">
															<select class="form-control m-b-10" id="weight">
															<option>Weight</option>
																<?php
																	$weight = 20;
																	while($weight <= 150)
																	{
																		?><option>
																		<?php echo $weight; ?></option> <?php
																		$weight = $weight + 1;
																	}
																?>
															</select>
														</div>
													</div>
											
												
												
												<label for="personalincome">Income (in PHP)</label>
													<div class="form-group">
														<input type="text" class="form-control" id="personalincome" name="personalincome" placeholder="Personal Income">
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
													<input type="text" class="form-control" id="phone" name="phone" placeholder="09xxxxxxxxx">
												</div>
												
												<label for="email">Email</label>
												<div class="form-group">
													<label class="sr-only" for="email">Email address</label>
													<input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
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
												<input type="email" class="form-control" id="username" autocomplete="off" name="username" placeholder="Username"> 
												<p class="help-block" id="usernameExists"></p>
												<input type="hidden" id="errorInUsername"/>
											</div>
										</div>
										<div class="form-group">
											<label for="securepass" class="col-lg-7 col-sm-2 control-label">Password</label>
											<div class="col-lg-15">
												<input type="password" class="form-control" id="securepass" name="securepass" placeholder="Password">
											</div><br>
											<label for="securepass" class="col-lg-7 col-sm-2 control-label">Confirm Password</label>
											<div class="col-lg-15">
												<input type="password" class="form-control" id="securepassconf" name="securepassconf" placeholder="Confirm Password">
												<p class="help-block">Password should be at least 8 characters.</p>
											</div>
										</div>
										
								</div>
							</section>
							
							<div class="form-group">
								
								<div class="col-lg-offset-3 col-lg-10">
									<input type="button" name="submits" id="submits" class="btn btn-danger" value="Submit Residency Request" onClick="Registration()"/>
								</div>
							</div>
						</div>
					</div>
                </section>
				</form>
            </aside>
        </div>
		
		<form name="validatedform" method="post" action="/success/registration_success.php">
			<input type="hidden" value="" id="noredflags" name="noredflags">
			<input type="hidden" value="" id="validatedfname" name="validatedfname">
			<input type="hidden" value="" id="validatedlname" name="validatedlname">
			<input type="hidden" value="" id="validatedmname" name="validatedmname">
			<input type="hidden" value="" id="validatedBirthdate" name="validatedBirthdate">
			<input type="hidden" value="" id="validatedBirthplace" name="validatedBirthplace">
			<input type="hidden" value="" id="validatedAddress" name="validatedAddress">
			<input type="hidden" value="" id="validatedWeight" name="validatedWeight">
			<input type="hidden" value="" id="validatedPersonalincome" name="validatedPersonalincome">
			<input type="hidden" value="" id="validatedPhone" name="validatedPhone">
			<input type="hidden" value="" id="validatedEmail" name="validatedEmail">
			<input type="hidden" value="" id="validatedUsername" name="validatedUsername">
			<input type="hidden" value="" id="validatedSecurepass" name="validatedSecurepass">
			
			<input type="hidden" value="" id="validatedGender" name="validatedGender">
			<input type="hidden" value="" id="validatedPrecinct" name="validatedPrecinct">
			<input type="hidden" value="" id="validatedHeight" name="validatedHeight">
			<input type="hidden" value="" id="validatedRelationship" name="validatedRelationship">
			
			<input type="hidden" value="" id="validatedDependency" name="validatedDependency">
		</form>
    </body>
</html>















	<!------------------------------------------------------------------ SECURE PASS ABLE TO PRESS ENTER, AND ADDRESS AUTOFILL ------------------------------------------>
		<script>
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
				$name = $('span.acaddress',this).html(); 
				$decoded = $("<div/>").html($name).text().toString();
				$('#address').val($decoded);
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
		<script>
			$(function()
			{
				$("#username").keyup(function() 
				{
					$.ajax(
					{
						type: "POST",
						data: {
							username: $('#username').val(),
						},
						url: "/ajax/user.php",
						success: function(data)
						{
							var username = $('#username').val();
							var textOUT = "Username '";
							var regEx = /^[a-z0-9_-]{1,16}$/;
							if(username != "")
							{
								if(regEx.test(username))
								{
									if(username.length >= 4 && username.length <= 25)
									{
										if(data == "USER_EXISTS")
										{
											$('#usernameDiv').removeClass().addClass("has-error");
											textOUT = textOUT+username+"' exists.";
											document.getElementById("usernameExists").innerHTML = textOUT;
											document.getElementById("errorInUsername").value = "1";
										}
										else if(data == "USER_AVAILABLE")
										{
											$('#usernameDiv').removeClass().addClass("has-success");
											textOUT = textOUT+username+"' is available.";
											document.getElementById("usernameExists").innerHTML = textOUT;
											document.getElementById("errorInUsername").value = "0";
										}
									}
									else
									{
										$('#usernameDiv').removeClass().addClass("has-error");
										document.getElementById("usernameExists").innerHTML = "Invalid Username Length";
										document.getElementById("errorInUsername").value = "1";
									}
								}
								else 
								{
									$('#usernameDiv').removeClass().addClass("has-error");
									document.getElementById("usernameExists").innerHTML = "Invalid Username Character";
									document.getElementById("errorInUsername").value = "1";
								}
							}
						}
					})
				});
			});
		</script>