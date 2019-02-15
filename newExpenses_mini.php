<!DOCTYPE html>
<html>
    <head>
	
	<link rel="icon" type="image/png" href="/img/favicon.png" />

	<script src="/js/everythingvalidation.js" type="text/javascript"></script>
	<meta charset="UTF-8">
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<meta name="description" content="Developed By M Abdur Rokib Promy">
	<meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">
	<!-- bootstrap 3.0.2 -->
	<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- font Awesome -->
	<link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<!-- Ionicons -->
	<link href="/css/ionicons.min.css" rel="stylesheet" type="text/css" />

	<!--<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>-->
	<!-- Theme style -->
	<link href="/css/style.css" rel="stylesheet" type="text/css" />

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
		
	<link href='/css/fullcalendar.css' rel='stylesheet' />
	<link href='/css/fullcalendar.print.css' rel='stylesheet' media='print' />
	<script src='/js/moment.min.js'></script>
	<script src='/js/fullcalendar.min.js'></script>	
	
		
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
		session_start();
		if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id()) 
		{
			include("/_sql/config.php");
			$eventID = mysqli_real_escape_string($conn, $_GET['requestID']);
			$budget = mysqli_real_escape_string($conn, $_GET['budget']);
		?>

		<div class="col-lg-4" style="padding: 0px 0px 0px 0px;">
				<header class="panel-heading">
					Add New Expense
				</header> 
				
				
				
				<div class="panel-body">
					<div class="col-lg-11">
				  
						<!--************************************
							*
							*		ADD NEW EXPENSE
							*
							************************************ -->
							
							<div class="form-group">
								<label for="exampleInputEmail1">Expense Name</label>
										<input type="text" class="form-control" id="name" name="name" placeholder="What expense?">
							</div>
							
							<div class="form-group">
								<label for="exampleInputEmail1">Amount</label>
										<input type="text" class="form-control" id="amount" name="amount" placeholder="Pesos">
							</div>
							
							<div class="form-group">
								<label for="exampleInputEmail1">Date the Expense was made</label>
								
									<div class="col-lg-1">	
									<select class="form-control m-b-10" id="month">
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
									</div>
									
									<div class="col-lg-1">	
									<select class="form-control m-b-10" id="day">
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
									</div>
									
									<div class="col-lg-1">	
									<select class="form-control m-b-10" id="year">
										<option><?php $year = date("Y"); echo $year; ?></option>
										<?php
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
									</div>
							</div>
					</div>	 
				</div>

		</div>
		
		<center>
			<div style="padding: 0px 0px 10px 0px;">
					<input type="button" name="edit" id="edit" class="btn btn-primary" value="Add Expense" onClick="AddExpense()"/>
					
					<form action="viewExpenses_mini.php" method="GET">
						<a href="javascript:;" onclick="parentNode.submit();">Go back</a>
						<input type="hidden" name="requestID" id="requestID" value="<?php echo $eventID; ?>"/>
						<input type="hidden" name="budget" id="budget" value="<?php echo $budget; ?>"/>
					</form>
			</div>
		</center>
		
		
		<form name="newExpense" method="post" action="/success/newExpense.php">
			<input type="hidden" name="programID" id="programID" value="<?php echo $eventID; ?>">
			<input type="hidden" name="eName" id="eName" value="">
			<input type="hidden" name="eAmount" id="eAmount" value="">
			<input type="hidden" name="eDate" id="eDate" value="">
		</form>
		
		
		<?php 
			mysqli_close($conn);
		}
		
	?>

		
    </body>
</html>
