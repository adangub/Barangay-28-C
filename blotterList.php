<!DOCTYPE html>
<html>
    <head></head>
    <body>
	<?php
		include("dash-top.php");
		if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id()) 
		{
			include("/_sql/config.php");
			
			if(isset($_GET['complainant']))
			{
				$cmp = mysqli_real_escape_string($conn, $_GET['complainant']);
				$qry = "SELECT blotter.id, date, status, complaint_type.complaint_name type, GET_COMPLAINANTNAME(blotter.complainant_id) 'cname' FROM blotter INNER JOIN complaint_type ON complaint_type.id = blotter.complaint_type_id INNER JOIN complainant ON blotter.complainant_id =  complainant.id WHERE blotter.valid = 1 AND complainant.resident_id = '$cmp' ORDER BY status DESC;";
			}
			else if(isset($_GET['respondent']))
			{
				$res = mysqli_real_escape_string($conn, $_GET['respondent']);
				$qry = "SELECT blotter.id, date, status, complaint_type.complaint_name type, GET_COMPLAINANTNAME(blotter.complainant_id) 'cname' FROM blotter INNER JOIN complaint_type ON complaint_type.id = blotter.complaint_type_id INNER JOIN complainant ON blotter.complainant_id = complainant.id WHERE blotter.id IN (SELECT blotter_id FROM respondents WHERE resident_id = '$res') ORDER BY status DESC;";
			}
			else if(isset($_GET['allblot']))
			{
				$res = mysqli_real_escape_string($conn, $_GET['allblot']);
				$qry = "SELECT blotter.id, date, status, complaint_type.complaint_name type, GET_COMPLAINANTNAME(blotter.complainant_id) 'cname' FROM blotter INNER JOIN complaint_type ON complaint_type.id = blotter.complaint_type_id INNER JOIN complainant ON blotter.complainant_id = complainant.id WHERE blotter.id IN (SELECT blotter_id FROM respondents WHERE resident_id = '$res') OR complainant.resident_id = '$res' ORDER BY status DESC;";
			}
			else $qry = "SELECT blotter.id, date, status, complaint_type.complaint_name type, GET_COMPLAINANTNAME(blotter.complainant_id) 'cname' FROM blotter INNER JOIN complaint_type ON complaint_type.id = blotter.complaint_type_id INNER JOIN complainant ON blotter.complainant_id = complainant.id WHERE blotter.valid = 1 ORDER BY status DESC;";
			$result = mysqli_query($conn,$qry);
	?>	
			<div class="col-lg-offset-2 col-lg-9" ><br><br>
				
					
                                <!-- <div class="box-header"> -->
                                    <!-- <h3 class="box-title">Responsive Hover Table</h3> -->

                                <!-- </div> -->
                                
                                    <table id="allblotters" class="" cellspacing="0" style="width:100%;">
                                        <thead>
											<th></th>
                                            <th>Case</th>
											<th>Status</th>
                                            <th>Filed</th>
                                            <th>Type</th>
                                            <th>Complainant</th>
                                        </thead>
										
										<?php 
											while($row = mysqli_fetch_array($result))
											{
												$status = $row['status'];
												$stat = "";
												if($status === "Hearing #3" || $status == "Cancelled") $stat = '<td><span class="label label-danger">'.$row['status'].'</span></td>';
												else if($status == "No Meeting Set" || $status == "Forwarded" || $status == "Delayed") $stat = '<td><span class="label label-warning">'.$row['status'].'</span></td>';
												else $stat = '<td><span class="label label-success">'.$row['status'].'</span></td>';
												echo '<tr>';
													?>
													<td><button id="<?php echo $row['id']; ?>" class="btn btn-default" onClick="ViewBlotter(this.id)">Details</button></td>
													<?php 
													echo '<td>#'.$row['id'].'</td>';
													echo $stat;
													echo '<td><abbr class="timeago" title="'.$row['date'].'"></abbr></td>';
													echo '<td>'.$row['type'].'</td>';
													echo '<td>'.$row['cname'].'</td>';
												echo '</tr>';
											}
										?>
                                    </table>
                               
					<form name="submitRequest" method="GET" action="case"> <!-- VIEW PROFILE REQUEST -->
						<input type="hidden" value="" id="type" name="type">
						<input type="hidden" value="" id="user" name="user">
					</form>
			</div>
			
	<?php
				mysqli_close($conn);
		}
		else die("<script>location.href = 'home'</script>");
		
		include("dash-bot.php");
	?>

    </body>
</html>
<script src="js/jquery.timeago.js" type="text/javascript"></script>
<script>
	$('#allblotters').DataTable({
		"iDisplayLength": 25
	});
	jQuery(document).ready(function($){
	 $("abbr.timeago").timeago()

	});
</script>


