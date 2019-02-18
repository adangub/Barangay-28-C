<!DOCTYPE html>
<html>
    <head>
	
	<link rel="icon" type="image/png" href="/img/favicon.png" />

	<script src="js/everythingvalidation.js" type="text/javascript"></script>
	<meta charset="UTF-8">
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<meta name="description" content="Developed By M Abdur Rokib Promy">
	<meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">
	<!-- bootstrap 3.0.2 -->
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- font Awesome -->
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<!-- Ionicons -->
	<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
	
	<!--<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>-->
	<!-- Theme style -->
	<link href="/css/style.css" rel="stylesheet" type="text/css" />

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
		
	<link href='css/fullcalendar.css' rel='stylesheet' />
	<link href='css/fullcalendar.print.css' rel='stylesheet' media='print' />
	<script src='js/moment.min.js'></script>
	<script src='js/fullcalendar.min.js'></script>	
	
		
    </head>
    <body>
	
	<!-- fuck all ur code here 
	Name/Title of the Program:
	<br>
	Date of the Program:
	<br>
	Venue:
	<br>
	Event Starts at:
	<br>
	Event Ends at:
	<br>
	Budget:
	<br>
	-->
		
		<?php 
			include("/_sql/config.php");
			
			
			$title = "";
			$date = "";
			$place = "";
			$status = "";
			$timeFrom = "";
			$timeTo = "";
			$midget = "";
			
			if(isset($_GET['request']))
			{
				$request = mysql_real_escape_string($_GET["request"]);
			}
			
			if($request === "hasEvent")
			{
				$eventID = mysql_real_escape_string($_GET["eventID"]);
				$result = mysqli_query($conn,"SELECT title, date, place, status, timeFrom, timeTo, budget, GET_EMPNAME(employee_program_assignment.employee_id, 1) empname FROM program LEFT JOIN employee_program_assignment ON program.id = employee_program_assignment.programs_id WHERE id = '$eventID';");
				$row = mysqli_fetch_array($result);
				
				
				$title = $row['title'];
				$date = strtotime($row['date']);
				$place = $row['place'];
				$status = $row['status'];
				$timeFrom = $row['timeFrom'];
				$timeTo = $row['timeTo'];
				$midget = $row['budget'];
				$empname = $row['empname'];
			}
			else 
			{
				$date = mysql_real_escape_string($_GET["date"]);
				$date = $date/1000;
			}
			
		
		?>

		<div class="col-lg-4" style="padding: 0px 0px 0px 0px;">
				<header class="panel-heading">
					Programs & Events
					
					<?php 
					if($request === "hasEvent"):
					?>
						<form action="viewExpenses_mini.php" method="GET">
							<a href="javascript:;" class=" btn-primary" style="float:right; padding: 4px 4px 4px 4px; margin-top: -24px" onclick="parentNode.submit();">View Expenses</a>
							<input type="hidden" name="requestID" id="requestID" value="<?php echo $eventID;?>"/>
							<input type="hidden" name="nametitle" id="nametitle" value="<?php echo $title;?>"/>
							<input type="hidden" name="venue" id="venue" value="<?php echo $place;?>"/>
							<input type="hidden" name="budget" id="budget" value="<?php echo $midget;?>"/>
						</form>
						<form action="viewParticipants_mini.php" method="GET">
							<a href="javascript:;" class=" btn-primary" style="float:right;padding: 4px 4px 4px 4px;margin-top: -24px;margin-right: 10px;" onclick="parentNode.submit();">View Participants</a>
							<input type="hidden" name="requestID" id="requestID" value="<?php echo $eventID;?>"/>
							<input type="hidden" name="nametitle" id="nametitle" value="<?php echo $title;?>"/>
							<input type="hidden" name="venue" id="venue" value="<?php echo $place;?>"/>
							<input type="hidden" name="budget" id="budget" value="<?php echo $midget;?>"/>
						</form>
					<?php 
					endif;
					?>
				</header> 
				
				<input type="hidden" name="loadtype" id="loadtype" value="<?php if($request === "hasEvent") echo "1"; else echo "0";?>"/>
				
				<div class="panel-body">
					<div class="col-lg-11">
				  
						<!--************************************
							*
							*		PROGRAM INFORMATION
							*
							************************************ -->
						
							<div class="form-group">
								<label for="exampleInputEmail1">Title of Program/Event</label>		
									<?php 
									if($request === "hasEvent"):
									?>
										<input type="text" class="form-control" id="nametitleEV" name="nametitleEV" value="<?php echo $title; ?>">
									<?php 
									else:
									?> 
										<input type="text" class="form-control" id="nametitle" name="nametitle" placeholder="Name/Title of the Program">
									<?php 
									endif;
									?>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Date of Program/Event</label>
									<?php 
									if ($request === "hasEvent"):
									?>
										<div class="col-lg-1" style="padding: 0px 0px 0px 0px;">	
										<select class="form-control m-b-10 asd" id="month">
											<option>Month</option>
											<option <?php if ($request === "hasEvent"){ if(date("M", $date) === "Jan") echo "selected='selected'"; }?>>Jan</option>
											<option <?php if ($request === "hasEvent"){ if(date("M", $date) === "Feb") echo "selected='selected'"; }?>>Feb</option>
											<option <?php if ($request === "hasEvent"){ if(date("M", $date) === "Mar") echo "selected='selected'"; }?>>Mar</option>
											<option <?php if ($request === "hasEvent"){ if(date("M", $date) === "Apr") echo "selected='selected'"; }?>>Apr</option>
											<option <?php if ($request === "hasEvent"){ if(date("M", $date) === "May") echo "selected='selected'"; }?>>May</option>
											<option <?php if ($request === "hasEvent"){ if(date("M", $date) === "Jun") echo "selected='selected'"; }?>>Jun</option>
											<option <?php if ($request === "hasEvent"){ if(date("M", $date) === "Jul") echo "selected='selected'"; }?>>Jul</option>
											<option <?php if ($request === "hasEvent"){ if(date("M", $date) === "Aug") echo "selected='selected'"; }?>>Aug</option>
											<option <?php if ($request === "hasEvent"){ if(date("M", $date) === "Sep") echo "selected='selected'"; }?>>Sep</option>
											<option <?php if ($request === "hasEvent"){ if(date("M", $date) === "Oct") echo "selected='selected'"; }?>>Oct</option>
											<option <?php if ($request === "hasEvent"){ if(date("M", $date) === "Nov") echo "selected='selected'"; }?>>Nov</option>
											<option <?php if ($request === "hasEvent"){ if(date("M", $date) === "Dec") echo "selected='selected'"; }?>>Dec</option>
										</select>
										</div>
										
										<div class="col-lg-1" style="padding: 0px 0px 0px 0px;">
										<select class="form-control m-b-10 asd" id="day">
											<option>Day</option>
											<?php
												$days = 1;
												while($days <= 31)
												{
													?><option
													
													<?php 
														if ($request === "hasEvent") 
														{
															if($days == date("j", $date))
																echo "selected='selected'";
														}
													?>
													
													>
													<?php echo $days; ?></option> <?php
													$days = $days + 1;
												}
											?>
										</select>
										</div>
										
										<div class="col-lg-1" style="padding: 0px 0px 0px 0px;">
										<select class="form-control m-b-10 asd" id="year">
											<option>Year</option>
											<?php
												$year = date("Y");
												$add = $year+4;
												while($year <= $add)
												{
													?><option
													
													<?php

													if($request === "hasEvent")
													{
														if($year === date("Y", $date))
															echo "selected='selected'";
													}
													?>
													> 
													
													<?php echo $year; ?>
													
													
													
													</option> <?php
													$year = $year + 1;
												}
											?>
										</select>
										</div>
									<?php 
									else:
										echo "<br><input type='text' class='form-control search' disabled='disable' value='".date("F d, Y", $date)."' id='programdate'/>";
									?>
									
										
									
									<?php 
									endif;
									?>
							</div>
						
							<div class="form-group">
								<label for="exampleInputEmail1">Venue</label>
									<?php 
									if($request === "hasEvent"):
									?>
										<input type="text" class="form-control" id="venueEV" name="venueEV" value="<?php echo $place; ?>">
									<?php 
									else:
									?> 
										<input type="text" class="form-control" id="venue" name="venue" placeholder="Place">
									<?php 
									endif;
									?>
							</div>
							<div class="form-group">
								<label for="committee">Committee</label>
								<select id="committee" class="form-control m-b-10">
									<option>[Select Committee]</option>
									<?php
										$qry = "SELECT id, GET_EMPNAME(id, 1) name FROM employee WHERE position IS NOT NULL;";
										$result = mysqli_query($conn, $qry);
										while($row = mysqli_fetch_array($result))
										{
											if($empname == $row['name'])
											{
												echo "<option selected='selected' name=".$row['id'].">".$row['name']."</option>";
											}
											else echo "<option name=".$row['id'].">".$row['name']."</option>";
										}
									?>
								</select>
							</div>
							<div class="form-group">
							&nbsp 	<label for="exampleInputEmail1">Start Time</label>
									<select  id="start" class="time">
										<option>-</option>
										<?php
											for($temp = 0; $temp < 2 ; $temp++)
											{
												if($temp == 0)
													echo "<option>12:00 AM</option>
														<option>12:30 AM</option>";
												else
													echo "<option>12:00 PM</option>
												<option>12:30 PM</option>";
												for($hours=1; $hours<=11; $hours++) // the interval for hours is '1'
												{
											   
													for($mins=0; $mins<60; $mins+=30) // the interval for mins is '30'
													{
														if($temp == 0)
																echo '<option>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT).' AM'.'</option>';  
														else		
																echo '<option>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT).' PM'.'</option>';
													}
												   
												}
											}
										?>
									</select>
									&nbsp
								<label for="exampleInputEmail1">End Time</label>
									<select  id="end" class="time">
										<option>-</option>
										<?php
											for($temp = 0; $temp < 2 ; $temp++)
											{
												if($temp == 0)
													echo "<option>12:00 AM</option>
														<option>12:30 AM</option>";
												else
													echo "<option>12:00 PM</option>
												<option>12:30 PM</option>";
												for($hours=1; $hours<=11; $hours++) // the interval for hours is '1'
												{
											   
													for($mins=0; $mins<60; $mins+=30) // the interval for mins is '30'
													{
														if($temp == 0)
																echo '<option>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT).' AM'.'</option>';  
														else		
																echo '<option>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT).' PM'.'</option>';
													}
												   
												}
											}
										?>
									</select>
								<p class="help-block" id="conflictExists" style="color:red"></p>
								<input type="hidden" id="conflictError"/>
							</div>
							
							<div class="form-group">
								<label for="exampleInputEmail1">Budget</label>
									<?php 
									if($request === "hasEvent"):
									?>
										<input type="text" class="form-control" id="budgetEV" name="budgetEV" value="<?php echo $midget; ?>">
									<?php 
									else:
									?> 
										<input type="text" class="form-control" id="budgetEMPTY" name="budgetEMPTY" placeholder="Budget">
									<?php 
									endif;
									?>
							</div>
					</div>	 
				</div>

		</div>
		
		<center>
			<div class="col-lg-offset-3 col-lg-10" style="padding: 0px 0px 10px 0px;">
				<?php 
				if ($request === "newEvent"):
				?>
					<input type="button" name="add" id="add" class="btn btn-primary" value="Add Program" onClick="NewProgram()"/>
				<?php 
				elseif($request === "hasEvent"):
				?>
					<input type="button" name="edit" id="edit" class="btn btn-primary" value="Save Changes" onClick="EditProgram()"/>
					<input type="button" name="delete" id="delete" class="btn btn-danger" value="Delete" onClick="DeleteProgram()"/>
				<?php 
				endif;
				?>
			</div>
		</center>
		
		
		<!-- ADD DAT PROGRAM YO --> 
		<form name="postProgram" method="post" action="/success/newProgram.php">
			<input type="hidden" name="titleProg" id="titleProg" value="">
			<input type="hidden" name="dateProg" id="dateProg" value="">
			<input type="hidden" name="venueProg" id="venueProg" value="">
			<input type="hidden" name="startProg" id="startProg" value="">
			<input type="hidden" name="endProg" id="endProg" value="">
			<input type="hidden" name="budgetProg" id="budgetProg" value="">
			<input type="hidden" name="employee" id="employee" value="">
		</form>
		
		<form name="deleteProgram" method="post" action="/success/deleteProgram.php">
			<input type="hidden" name="evID" id="evID" value="<?php echo $eventID; ?>">
		</form>
		
		
		<form name="editProgram" method="post" action="/success/editProgram.php">
			<input type="hidden" name="progID" id="progID" value="<?php echo $eventID; ?>">
			<input type="hidden" name="budgetProg" id="budgetProg" value="">
			<input type="hidden" name="titleProg" id="titleProg" value="">
			<input type="hidden" name="dateProg" id="dateProg" value="">
			<input type="hidden" name="venueProg" id="venueProg" value="">
			<input type="hidden" name="startProg" id="startProg" value="">
			<input type="hidden" name="endProg" id="endProg" value="">
			<input type="hidden" name="employee" id="employee" value="">
		</form>	
		
		<?php 
		
			mysqli_close($conn);
		?>
		
    </body>
</html>

	<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
	<script>
			$(function()
			{
				$(".time, .asd").change(function() 
				{
					var a = $('#start').val();
					var b = $('#end').val();
					var c = $('#programdate').val();
					var d = $('#loadtype').val();
					
					if(d == "1")
					{
						var x = document.getElementById("month");
						var month = String(x.options[x.selectedIndex].value);
						var x = document.getElementById("day");
						var day = String(x.options[x.selectedIndex].value);
						var x = document.getElementById("year");
						var year = String(x.options[x.selectedIndex].value);
						
						
						
						switch(month)
						{
							case 'Jan': month = "January"; break;
							case 'Feb': month = "Feburary"; break;
							case 'Mar': month = "March"; break;
							case 'Apr': month = "April"; break;
							case 'May': month = "May"; break;
							case 'Jun': month = "June"; break;
							case 'Jul': month = "July"; break;
							case 'Aug': month = "August"; break;
							case 'Sep': month = "September"; break;
							case 'Oct': month = "October"; break;
							case 'Nov': month = "November"; break;
							case 'Dec': month = "December"; break;
							default: month=-1; break;
						}
						
						c = month+" "+day+", "+year;
					}
					
					if(a != "-" && b != "-")
					{
						$.ajax(
						{
							type: "POST",
							data: {
								sTime: a,
								eTime: b,
								date:  c,
							},
							url: "/ajax/ac_schedule.php",
							success: function(data)
							{
								
								
								if(data == 1)
								{
									document.getElementById('conflictExists').innerHTML = "There's a program conflict on the specified time.";
									document.getElementById("conflictError").value = "1";
								}
								else 
								{
									document.getElementById('conflictExists').innerHTML = "";
									document.getElementById("conflictError").value = "0";
								}
								
							}
						})
					}
				});
			});
		</script>
