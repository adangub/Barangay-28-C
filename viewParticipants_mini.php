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

	<script src="/js/jquery.min.js" type="text/javascript"></script>
		<script src="/js/jquery.dataTables.min.js" type="text/javascript"></script>
		<script src="/js/dataTables.bootstrap.min.js" type="text/javascript"></script>

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
		<?php 
		session_start();
		if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id()) 
		{
			include("/_sql/config.php");
			$eventID = mysqli_real_escape_string($conn, $_GET['requestID']);
			$budget = mysqli_real_escape_string($conn, $_GET['budget']);
		?>
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
		
	
		<div class="col-lg-4" style="padding: 0px 0px 0px 0px;">
				<header class="panel-heading">
					Participants
					
					<form action="newParticipants_mini.php" method="GET">
						<a href="javascript:;" class=" btn-primary" style="float:right; padding: 4px 4px 4px 4px; margin-top: -24px" onclick="parentNode.submit();">Add New Participant</a>
						<input type="hidden" name="requestID" id="requestID" value="<?php echo $eventID;?>"/>
						<input type="hidden" name="budget" id="budget" value="<?php echo $budget;?>"/>
					</form>
					
					
				</header> 
		</div>				
				
				
		<div class="panel-body" style="padding: 0px 0px 0px 0px;">
		
		
		  
				<!--************************************
					*
					*		PARTICIPANTS INFORMATION
					*
					************************************ -->
		
				
					<table id="participants" name="participants">
						<thead>
							<th>Name</th>
							<th></th>
							<th></th>
						</thead>
						
						<!-- values -->
						<?php 
							$qry = "SELECT GET_FULLNAME(resident_id, 0) name, resident_id FROM participants WHERE program_id = '$eventID';";
							$result = mysqli_query($conn,$qry);
							$total = 0;
							
							while($row = mysqli_fetch_array($result))
							{

								echo "<tr>";
								echo "<td>".$row['name']."</td>";
								echo "<td></td>";
								echo "<td><button class='btn btn-danger' id=".$row['resident_id']." onClick='DeleteParticipant(this.id)'>Remove </button></td>";
								echo "</tr>";
							}
						?>
						
						
						
					</table>
				
			
		
		</div>
		<center>
			<div style="padding: 0px 0px 10px 0px;">
			
				<form action="newProgram_mini.php" method="GET">
					<a href="javascript:;" onclick="parentNode.submit();">Go back</a>
					<input type="hidden" name="request" id="request" value="hasEvent"/>
					<input type="hidden" name="eventID" id="eventID" value="<?php echo mysql_real_escape_string($_GET["requestID"]);?>"/>
				</form>

				<form name="deleteParticipant" method="post" action="/success/deleteParticipants.php">
					<input type="hidden" name="programID" id="programID" value="<?php echo $eventID; ?>">
					<input type="hidden" name="uID" id="uID" value="">
				</form>
			</div>
		</center>
		
	<?php 
			mysqli_close($conn);
		}
		
	?>
    </body>
</html>


<script src="/js/jquery.timeago.js" type="text/javascript"></script>
<script>
		jQuery(document).ready(function($){
		 $("abbr.timeago").timeago()

		});

		
</script>
