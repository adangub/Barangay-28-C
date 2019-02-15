<!DOCTYPE html>
<?php include("dash-top.php"); 
	if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id() && $_SESSION['u_position'] != "")
	{
?>
	
<html>
<head>

</head>
      <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
            <!-- Header Navbar: style can be found in header.less -->
<!-- ===================================================================== Content ===================================================================================-->
			<aside class="right-side">
                <!-- Main content -->
                <section class="content">
							<form name="membersListSORT" method="POST" action=""> <!-- FOR SORTING -->
								<input type="hidden" value="" id="sortType" name="sortType">
								<input type="hidden" value="" id="sortTypeSTOCK" name="sortTypeSTOCK">
							</form>
							
							<form name="submitRequest" method="GET" action="resident"> <!-- VIEW PROFILE REQUEST -->
								<input type="hidden" value="" id="user" name="user">
								<input type="hidden" value="" id="type" name="type">
							</form>
							
							<form name="membersListSEARCH" method="POST" action=""> <!-- FOR SEARCHING -->
								<input type="hidden" value="" id="nameSearched" name="nameSearched">
							</form>
							<!--table table-striped table-bordered-->
							<table id="allmembers" class="" cellspacing="0" style="width:100%;">
								<thead>
									<tr>
										<th></th>
										<th></th>
										<th>Name</th>
										<th>Gender</th>
										<th>Age</th>
										<th>Hometown</th>
										<th>Current Address</th>
									</tr>
								</thead>
									<br><br>
										<?php
											include '/_sql/config.php';
											
											date_default_timezone_set('Asia/Hong_Kong');
											
											$qry = "SELECT resident.id, GET_FULLNAME(resident.id, 1) as 'fullname', GET_TOTALREQUESTS(resident.id, 1) as 'pending', resident.gender, resident.birth_date, resident.birth_place, household.address, employee.position pos FROM resident INNER JOIN household ON resident.household_id=household.id LEFT JOIN employee ON employee.resident_id=resident.id ORDER BY GET_TOTALREQUESTS(resident.id, 1) DESC;";
											if(isset($_POST['sortType'])) 
											{
												$sortType = mysql_real_escape_string($_POST['sortType']);
												$qry = "SELECT resident.id, GET_FULLNAME(resident.id, 1) as 'fullname', GET_TOTALREQUESTS(resident.id, 1) as 'pending', resident.gender, resident.birth_date, resident.birth_place, household.address, employee.position pos FROM resident INNER JOIN household ON resident.household_id=household.id LEFT JOIN employee ON employee.resident_id=resident.id $sortType;";
											}
											if(isset($_POST['nameSearched']))
											{
												$nameSearched = mysql_real_escape_string($_POST['nameSearched']);
												$qry = "SELECT resident.id, GET_FULLNAME(resident.id, 1) as 'fullname', GET_TOTALREQUESTS(resident.id, 1) as 'pending', resident.gender, resident.birth_date, resident.birth_place, household.address, employee.position pos FROM resident INNER JOIN household ON resident.household_id=household.id LEFT JOIN employee ON employee.resident_id=resident.id WHERE GET_FULLNAME(resident.id, 1) LIKE '%$nameSearched%';";
											}
											$result = mysqli_query($conn,$qry);
											
											while($row = mysqli_fetch_array($result))
											{
												?>	<tr>
													<td>
													<button id="<?php echo $row['id']; ?>" class="btn btn-default" onClick="ViewProfile(this.id)">Check Profile</button></td>
													
													<td>
												<?php 
													$pending = $row['pending'];
													if($pending > 0)
													{
														?><span class='label label-primary'><?php echo "(".$pending.")"." New Request!"; ?></span><?php
													}
													?></td><td>
												<?php
													echo $row['fullname']; ?>
													<?php 
													$position = $row['pos'];
													if(!is_null($position)): 
														?>&nbsp; &nbsp; &nbsp; &nbsp; <span class='label label-danger'><?php echo $position; 
													endif; ?>
													</span></td><td>
												<?php
													echo $row['gender']; ?></td><td>
												<?php 
													$year = date("Y");
													$birthyear = date('Y', strtotime($row['birth_date']));
													$age = $year-$birthyear;
													echo $age; ?> </td><td>
												<?php
													echo $row['birth_place']; ?> </td><td> 
												<?php

													echo $row['address']; ?> </td>
													</tr>
												
												<?php 
											}
											
											mysqli_close($conn);
	}
	else die("<script>location.href = 'home'</script>");
										?>
										
										
							</section>
						</div>
					</section>
				</aside>
			
		</body>
</html>





<script> //TO BE ABLE TO PRESS ENTER TO SEARCH
	
    $('#allmembers').DataTable({
		"iDisplayLength": 25
	});

	$("#searchedname").keyup(function(event){
		if(event.keyCode == 13){
			$("#searchbutton").click();
		}
	});	
</script>

