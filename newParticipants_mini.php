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
				
				<div class="panel-body" style="padding-left: 0px; padding-top: 0px; padding-right: 0px;">
														<section class="panel">
										<header class="panel-heading">
											Participant (Must be Resident)
										</header>
									<div>
										<form method="post" style="padding: 2.7% 2.7% 2.7% 2.7%; align: right;">
											<form id='login_form' name="login_form" class="form-inline" role="form">
											<br>
											<form id='login_form' name="login_form" class="form-inline" role="form">
												<label for="respondent1">Name of Resident</label>
												<div class="input_fields_wrap">
													
													<input type="text" class="form-control search" id="NameORid" name='NameORid' placeholder="Search for ID or Name" size=45 >
													<input type="hidden" value="" id="userID" name='userID'>
													<div id="result"></div>
													<p class="help-block">Searches all members via ID or part of name.</p>
													
												</div> 
											
											
											<form id='login_form' name="login_form" class="form-inline">
											
										</form>
										</form>
										
										
										
										
										<!-- <label for="respondent1">Respondent 1 (Required)</label>
											<div class="input_fields_wrap">
												
												<input type="text" class="form-control respondent1" id="respondent1" name='mytext[]' placeholder="Search Name" size=45 >
												<input type="hidden" value="" id="respondent1ID" name="respondent1ID">
												<div id="respondent1Result">
												
											</div> -->
										
										
										
										
										
										
										
									</div>
									</section>

		</div>
		
		<center>
			<div style="padding: 0px 0px 10px 0px;">
					<input type="button" name="edit" id="edit" class="btn btn-primary" value="Add Participant" onClick="AddParticipant()"/>
					
					<form action="viewParticipants_mini.php" method="GET">
						<a href="javascript:;" onclick="parentNode.submit();">Go back</a>
						<input type="hidden" name="requestID" id="requestID" value="<?php echo $eventID; ?>"/>
						<input type="hidden" name="budget" id="budget" value="<?php echo $budget; ?>"/>
					</form>
			</div>
		</center>
		
		
		<form name="newParticipants" method="post" action="/success/newParticipants.php">
			<input type="hidden" name="programID" id="programID" value="<?php echo $eventID; ?>">
			<input type="hidden" name="uID" id="uID" value="">
		</form>

		
		
		
		<?php 
			mysqli_close($conn);
		}
		
	?>

		
    </body>
</html>


<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
<script type="text/javascript">

$(function()
{
	$(".search").keyup(function() 
	{ 
	var searchid = $(this).val();
	var progID = document.getElementById("programID").value;
	var dataString = {'search':searchid,'program':progID};
	
	if(searchid!='')
	{
		
		$.ajax
		({
			type: "POST",
			url: "ajax/ac_participants.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#result").html(html).show();
			}
		});
	}return false;    
	});
	
	jQuery("#result").on("click", function(e)
	{
		$name = $('span.returnName',this).html(); 
		$name = $("<div/>").html($name).text().toString();
		$id = $('span.returnID',this).html(); 
		$id = $("<div/>").html($id).text().toString();
		$('#userID').val($id);
		$('#NameORid').val($name); //Cool 
	});
	
	jQuery(document).on("click", function(e) 
	{ 
		var $clicked = $(e.target);
		if (! $clicked.hasClass("search")){
		jQuery("#result").fadeOut(); 
		}
	});
	$('#NameORid').click(function()
	{
		jQuery("#result").fadeIn();
	});
	
});


		
</script>