<!DOCTYPE html>

<?php 
	include("dash-top.php"); 
	
	if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id()) 
	{
		include '/_sql/config.php';
?>
<html>
    <head>
		<style>	
			hr{
				border: 0;
				height: 1px;
				background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
			}
		</style>
    </head>
    <body>
			
		
                <!-- Content Header (Page header) -->
				
			
                <!-- Main content -->
                <section class="content">
                    <div class="row" style="margin-left: 180px" >
						<div class="col-lg-12">
							<section class="panel">
								
									<!--************************************
										*
										*		PERSONAL INFORMATION
										*
										************************************ -->	
										
									<?php
										
										
										if(isset($_GET['user']) && isset($_GET['type']))
										{
											$requestType = mysql_real_escape_string($_GET['type']);
											$bID = mysql_real_escape_string($_GET["user"]);
											$result=mysqli_query($conn,"SELECT id, complaint, date, status, complainant_id, GET_COMPLAINANTRESID(complainant_id) resID, GET_BLOTTERTYPEBYID(complaint_type_id) type,  GET_COMPLAINANTNAME(complainant_id) comname, GET_BLOTTERTYPE(complaint_type_id) blotterType, GET_COMPLAINANTADDRESS(complainant_id) address FROM blotter WHERE id = '$bID' LIMIT 1;");
											$row = mysqli_fetch_array($result);
											
											$hearings = 1;
											
											
											if(isset($_POST['thestat']))
											{
												
												$new = mysqli_real_escape_string($conn, $_POST['thestat']);
												mysqli_query($conn, "UPDATE blotter SET status = '$new' WHERE id = '$bID';");
												
												

											}
										?>
										<header class="panel-heading">
											<center>Complaint Information</center>
										</header>
										

										<div class="panel-body">
										
										
											<div style="float:left; margin-left: 250px;">
											
												<div class="col-lg-12 control-label form-group">
													<label class="">Event Number:</label>
													<br><p class="form-control-static"><?php echo str_pad($row['id'],10,"0",STR_PAD_LEFT);  ?></p>
													
													<br>
													<label class="">Type:</label>
													<br><p class="form-control-static"><?php echo $row['type'];?></p>
													
													<br>
													<label class="">Location:</label>
													<br><p class="form-control-static"><?php echo $row['address'];  ?></p>


													
												</div>
												
											</div>
											
											
											<div style="float:right; margin-right: 250px;">
											
												<div class="col-lg-12 control-label form-group">
													<label class="">Date/Time:</label>
													<br><p class="form-control-static"><?php echo date('F d, Y g:i A', strtotime($row['date']));  ?></p>
													
													<br>
													<label class="">Complainant:</label>
													<br>
													<?php
													if($row['resID'] != NULL): ?>
														<form action = "" method = "GET">
															<?php if (isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id() && $_SESSION['u_isemployee'] == 1): ?>
																<input type="hidden" value="<?php echo $row['resID']; ?>" id="user" name="user">
																<input type="hidden" value="View Profile" id="type" name="type">
																<button type="submit" class="hyperbutton" formaction="resident" formmethod="GET" class="form-control-static"><?php echo $row['comname']; ?></button>
															<?php else: echo $row['comname']; endif; ?>
														</form>
													<?php 
													else:
													?>
														<p class="form-control-static">"<?php echo $row['comname'];  ?>"</p>
													<?php 
													endif;
													?>
													<br>
													
													<label class="">Eligibility/Respondent(s):</label>
													<form action = "" method = "GET">
														<?php 
															
															
															$qry = "SELECT respondents.id, GET_FULLNAME(resident_id, 0) as respondentname, GET_ISSTILLRESP(resident_id) as stillresp, resident.eligibility, resident_id FROM respondents LEFT JOIN resident ON respondents.resident_id = resident.id WHERE respondents.blotter_id=".$row['id'];
															$result = mysqli_query($conn,$qry);
															while($respondents = mysqli_fetch_array($result))
															{
																$curID = $respondents['resident_id'];
																$el = $respondents['eligibility'];
																$stillresp = $respondents['stillresp'];
																if(!$el) $el = 0;
																?>
																<form action = "" method = "GET">
																	<!-- Eligibility -->
																	<?php if (isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id() && $_SESSION['u_isemployee'] == 1): ?>
																		<input type="checkbox" <?php if($el == 1) echo "checked=''"; ?> name="eligible" class="eligible" id="eligible" value="<?php echo $curID; ?>">
																		
																		<!-- Eligibility -->
																		<input type="hidden" value="<?php echo $curID ?>" id="user" name="user">
																		<input type="hidden" value="View Profile" id="type" name="type">
																		<button type="submit" class="hyperbutton" formaction="resident" formmethod="GET"  class="form-control-static"><?php echo $respondents['respondentname']; ?></button>
																	<?php else: echo $respondents['respondentname']; endif; ?>
																</form>
	
	
																<?php 
																if(isset($_POST['thestat']))
																{
																	$new = mysqli_real_escape_string($conn, $_POST['thestat']);
																	$eligibility = 0;
																	if($new == "Settled (Not Guilty)") $eligibility = 1;
																	if($stillresp == 0 || $stillresp == "0" && $new == "Settled (Not Guilty)") 
																		mysqli_query($conn, "UPDATE resident SET eligibility = '$eligibility' WHERE id = '$curID';");
																	if($new != "Settled (Not Guilty)") 
																		mysqli_query($conn, "UPDATE resident SET eligibility = '$eligibility' WHERE id = '$curID';");
																}
																
																if(isset($_POST['checkedID']))
																{
																	$new = mysqli_real_escape_string($conn, $_POST['checkedID']);
																	$checkedData = explode(',', $new);
																	if(in_array(strval($curID), $checkedData))
																		mysqli_query($conn, "UPDATE resident SET eligibility = 1 WHERE id = '$curID'");
																	else 
																		mysqli_query($conn, "UPDATE resident SET eligibility = 0 WHERE id = '$curID'");
																}
															}
															
															if(isset($_POST['thestat']))
															{
																$url = $_SERVER['REQUEST_URI'];
																die("<script>location.href = '".$url."'</script>");
															}
															if(isset($_POST['checkedID']))
															{
																$url = $_SERVER['REQUEST_URI'];
																die("<script>location.href = '".$url."'</script>");
															}
															
														?>
															
													</form>
														<!-- Hidden Update Button -->
															<input type="button" class="btn btn-default" name="eligibilityUpdate" value="Update" id="eligibilityUpdate" style="display:none"/>
															<form method="POST" action="" id="elForm" name="elForm">
																<input type="hidden" name="checkedID" id="checkedID" value=""/>
															</form>		
														<!-- Hidden Update Button -->
													<br>
													
													<label class="">Status:</label>
													<?php 
													$status = $row['status'];
													if($status === "Hearing #3" || $status == "Cancelled") $label = "label label-danger";
													else if($status == "No Meeting Set" || $status == "Forwarded" || $status == "Delayed") $label = "label label-warning";
													else $label = "label label-success";
													?>
													<br><span class="<?php echo $label; ?>" id="changeStat" name="changeStat" style='cursor: pointer; cursor: hand;'><?php echo $status;?></span>
													<select id="newStat" style="display:none;">
														<option>Settled (Guilty)</option>
														<option>Settled (Not Guilty)</option>
														<option>Forwarded</option>
														<option>Delayed</option>
														<option>Cancelled</option>
														<option>Hearing #1</option>
														<option>Hearing #2</option>
														<option>Hearing #3</option>
													</select>
													<input type="button" class="btn btn-default" name="statusUpdate" style="display:none;" value="Update" id="statusUpdate"/>
													<form method="POST" action="" id="statForm" name="statForm">
														<input type="hidden" name="thestat" id="thestat" value=""/>
													</form>


												</div>
													
											</div>
											
											<div class="col-lg-9 col-sm-9 control-label form-group" style="float:left; margin-left: 150px;">
												<label class="" style="margin-left: 100px;">Details:</label>
												<br><p style="margin-left: 100px;" class="form-control-static">"<?php echo $row['complaint'];  ?>"</p>
											</div>
										</div>
										
										
										
										
										
										
										
										
										<?php 
										
											$qry = "SELECT hearing_schedule.id hearingID, schedule_date, start_time, end_time, blotter_id blotterID, GET_EMPNAME(lupong_id,1) lups1, GET_EMPNAME(lupong2_id,1) lups2, lupong_id, lupong2_id FROM hearing_schedule INNER JOIN blotter ON blotter.id = hearing_schedule.blotter_id WHERE hearing_schedule.blotter_id = '$bID';";
											$result = mysqli_query($conn,$qry);
												?><?php
											while($row = mysqli_fetch_array($result))
											{
												$lups1 = $row['lups1'];
												$lups2 = $row['lups2'];
												$schedule_date = $row['schedule_date'];
												$end_time = $row['end_time'];
												if($hearings < 3)
													echo "<center><hr><h6>Hearing Number ".$hearings."</h6><hr></center>"; 
												else echo "<center style='color:red'><hr><h6>Hearing Number ".$hearings."</h6><hr></center>"; 
												?>
												<!--<img src="/img/seal.png" style="float:left; width:150px; height:150px; margin-left: 20px;"/>-->
												<table style="margin-left: 50px;">	
													<tr>
														<div class="form-group" style="margin-left: 10%;">
															<label class="col-lg-8 control-label" style="margin-left: 3%; margin-bottom: 0px; margin-right: -50%;">Schedule #:</label>
																<p class="form-control-static"> <?php echo $hearings; ?></p>
														</div>
													</tr>
													<tr>
														<div class="form-group" style="margin-left: 10%;">
															<label class="col-lg-8 control-label" style="margin-left: 3%; margin-bottom: 0px; margin-right: -50%;">Hearing Number:</label>
																<p class="form-control-static"> <?php echo $row['hearingID']; ?></p>
														</div>
													</tr>
													<tr>
														<div class="form-group" style="margin-left: 10%;">
															<label class="col-lg-8 control-label" style="margin-left: 3%; margin-bottom: 0px; margin-right: -50%;">Date:</label>
																<p class="form-control-static"> <?php echo $schedule_date; ?></p>
														</div>
													</tr>
													<tr>
														<div class="form-group" style="margin-left: 10%;">
															<label class="col-lg-8 control-label" style="margin-left: 3%; margin-bottom: 0px; margin-right: -50%;">Start/End Time:</label>
																<p class="form-control-static"> <?php echo date("g:i a", strtotime($row['start_time']))." - ".date("g:i a", strtotime($row['end_time'])); ?></p>
														</div>
													</tr>

															
												<?php
												if ($hearings !=3)
												?> <?php if ($hearings >= 3)?>
															<?php 
															if($hearings >= 3):
															?>
															
														<tr>
															<div class="form-group">
																<label class="col-lg-8 control-label" style="margin-left: 32%; margin-bottom: 0px; margin-right: -37.5%; color:red;" >Lupong 1:</label>
																<form action = "" method = "GET" style="float:right; margin-right: 120px;">
																	<input type="hidden" value="<?php echo $row['lupong_id']; ?>" id="user" name="user">
																	<input type="hidden" value="View Profile" id="type" name="type">
																	<?php echo $lups1; ?>
																</form>
															</div>
														</tr>
														
														<tr>
															<div class="form-group">
																<label class="col-lg-8 control-label" style="margin-left: 32%; margin-bottom: 0px; margin-right: -37.5%; color:red;" >Lupong 2:</label>
																<form action = "" method = "GET" style="float:right; margin-right: 123px;">
																	<input type="hidden" value="<?php echo $row['lupong2_id']; ?>" id="user" name="user">
																	<input type="hidden" value="View Profile" id="type" name="type">
																	<?php echo $lups2; ?>
																</form>
															</div>
														</tr>
												</table>
													
															<?php 
												endif;
												
												if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id() && $_SESSION['u_isemployee'] == 1):
															?>
												<center><button id="<?php echo $row['blotterID']; ?>" name="<?php echo $row['hearingID']; ?>" class="btn btn-default" onClick="blotterprint(this.id, this.name)">Print</button></center>
												<br>
											
												<?php 
												endif;
												$hearings++;
											}
										
										?>

										<center>
											<div id="newSched" style="display:none;">
												
												<br><br><br><br><br><br>
												<hr>
												<!-- On month day, year at start time until end time [FORMAT]-->
												<b>On</b> &nbsp;
													<select id="month" class="asd">
														<?php 
															$curDay = date("j") + 1;
															$curMonth = date("M");
														?>
														<option <?php if($curMonth === "Jan") echo "selected='selected'";?> >Jan</option>
														<option <?php if($curMonth === "Feb") echo "selected='selected'";?> >Feb</option>
														<option <?php if($curMonth === "Mar") echo "selected='selected'";?> >Mar</option>
														<option <?php if($curMonth === "Apr") echo "selected='selected'";?> >Apr</option>
														<option <?php if($curMonth === "May") echo "selected='selected'";?> >May</option>
														<option <?php if($curMonth === "Jun") echo "selected='selected'";?> >Jun</option>
														<option <?php if($curMonth === "Jul") echo "selected='selected'";?> >Jul</option>
														<option <?php if($curMonth === "Aug") echo "selected='selected'";?> >Aug</option>
														<option <?php if($curMonth === "Sep") echo "selected='selected'";?> >Sep</option>
														<option <?php if($curMonth === "Oct") echo "selected='selected'";?> >Oct</option>
														<option <?php if($curMonth === "Nov") echo "selected='selected'";?> >Nov</option>
														<option <?php if($curMonth === "Dec") echo "selected='selected'";?> >Dec</option>
													</select>
													<select id="day" class="asd">
														<option>Day</option>
														<?php
															$days = 1;
															while($days <= 31)
															{
																?><option
																
																<?php 
																	
																	if($days == $curDay)
																		echo "selected='selected'";
																	
																?>
																
																
																
																>
																<?php echo $days; ?></option> <?php
																$days = $days + 1;
															}
														?>
													</select>
													&nbsp;<b>,</b>&nbsp;
													<select id="year" class="asd">
														<?php
															$year = date("Y");
															echo "<option>".$year."</option>";
															$year+=1;
															$plus = $year+1;
															while($year <= $plus)
															{
																?><option>
																<?php echo $year; ?></option> <?php
																$year = $year + 1;
															}
														?>
													</select>

												


													&nbsp;<b>from</b>&nbsp;
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
														&nbsp;<b>until</b>&nbsp;
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
														<option>12:30 P.M.</option>";
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
												
												<br>
													
													
													
												<?php 
												if($hearings >= 3): ?>
													&nbsp;<b>Lupong 1: </b>&nbsp;
												<select id="lupong1">
													<?php
														$qry = "SELECT id, GET_EMPNAME(id, 1) name FROM employee WHERE position IS NOT NULL;";
														$result = mysqli_query($conn, $qry);
														while($row = mysqli_fetch_array($result))
														{
															echo "<option name=".$row['id'].">".$row['name']."</option>";
														}
													?>
												</select>
												
													&nbsp;<b>Lupong 2: </b>&nbsp;
												<select id="lupong2">
													<?php
														$qry = "SELECT id, GET_EMPNAME(id, 1) name FROM employee WHERE position IS NOT NULL;";
														$result = mysqli_query($conn, $qry);
														
														while($row = mysqli_fetch_array($result))
														{
															echo "<option name=".$row['id'].">".$row['name']."</option>";
														}
													?>
												</select>

												<?php 
												endif;
												?>
												
														<!--<a href="<?php if($requestType === "View Blotter") { ?>blotterList.php <?php } else if($requestType ==="Transaction History") {?> history.php <?php } ?>" class="btn btn-danger" style="margin-left:1000px">Go Back</a> -->

												<p class="help-block" id="conflictExists" style="color:red"></p>
												<input type="hidden" id="conflictError"/>
											<hr>
											</div>
												<?php 
												if($hearings <= 3 && (isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id() && $_SESSION['u_isemployee'] == 1)):
												?>
													<input type="hidden" id="hearings" value="<?php echo $hearings; ?>"/>
													<center name="clickable" id="clickable"><hr><h6><input type="button" class="btn btn-primary" value="+"/></h6><hr></center>
													<input style="margin-top: 1%; margin-bottom: 2%; display:none;" type="button" name="newHear" id="newHear" class="btn btn-danger" value="Add Hearing" onClick="NewHearing()"/>
													<br>
													<br>
												<?php 
												endif;
												?>
										</center>
										
											<?php
										}
										mysqli_close($conn);
	}
										?>
											
										</div>
							</section>
						</div>	
					</div>
					
					
					 
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
			
        </div><!-- ./wrapper -->
		
        <!-- jQuery 2.0.2 -->
        
		
		
		
		
		
		
		<form name="newSchedule" method="post" action="/success/blottersummary.php">
			<input type="hidden" value="<?php echo $bID; ?>" id="blotID" name="blotID">
			<input type="hidden" value="<?php echo $hearings; ?>" id="hearings" name="hearings">
			<input type="hidden" value="" id="startT" name="startT">
			<input type="hidden" value="" id="endT" name="endT">
			<input type="hidden" value="" id="scheduleD" name="scheduleD">
			<input type="hidden" value="" id="lupong1" name="lupong1">
			<input type="hidden" value="" id="lupong2" name="lupong2">
		</form>	
		<form name="blotterform" method="post" action="docs/print.php">	
			<input type="hidden" id="blotterid" name="blotterid">
			<input type="hidden" id="hearingid" name="hearingid">
			<input type="hidden" value="blotter" id="transactionType" name="transactionType">
		</form>	
	
    </body>
	
	
</html>


<script>
		
		$("#statusUpdate").click(function()
		{
			var x = document.getElementById("newStat");
			var status = String(x.options[x.selectedIndex].value);
			document.getElementById("thestat").value = status;
			document.getElementById("statForm").submit();
		});
		
		
		$(".eligible").click(function()
		{
			$("#eligibilityUpdate").slideDown();
		});
		$("#eligibilityUpdate").click(function()
		{
			var str = "";

			$(':checkbox').each(function() {
				if(this.checked)
					str+=""+this.value+",";
			});

			str = str.substr(0, str.length - 1);
			document.getElementById("checkedID").value = str;
			document.getElementById("elForm").submit();
		});
		
		$("#newStat").hide();
		$("#statusUpdate").hide();
		<?php if (isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id() && $_SESSION['u_isemployee'] == 1): ?>
		$("#changeStat").click(function()
		{
			$("#changeStat").fadeOut();
			$("#newStat").slideDown();
			$("#statusUpdate").slideDown();
		});
		<?php endif; ?>

		$("#clickable").click(function()
		{
			$("#newSched").slideDown();
			$("#newHear").show();
			$("#clickable").hide();
		});
</script>


<script>
			$(function()
			{
				$(".time, .asd").change(function() 
				{
					var a = $('#start').val();
					var b = $('#end').val();
					var c = $('#programdate').val();
				
					
					
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
							url: "/ajax/ac_bschedule.php",
							success: function(data)
							{
								
								
								if(data == 1)
								{
									document.getElementById('conflictExists').innerHTML = "<br>There's already another hearing occuring at the specified date/time.";
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



<script src="/js/jquery.timeago.js" type="text/javascript"></script>
<script>
		jQuery(document).ready(function($){
		 $("abbr.timeago").timeago()

		});
</script>
