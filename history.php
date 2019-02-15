<!DOCTYPE html>
<html>
    <head></head>
    <body>
	<?php
		include("dash-top.php");
		if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id() && $_SESSION['u_isemployee'] == 1)
		{
			include("/_sql/config.php");
			
			$qry = "SELECT transactions.resident_id rID, request_type.request_name, GET_FULLNAME(transactions.resident_id, 0) residentname, requests.verified, requests.date, transactions.date dateDenyApp, transactions.amount, GET_EMPNAME(transactions.employee_id, 2) attendedby FROM transactions INNER JOIN requests ON requests.transactions_id = transactions.id INNER JOIN request_type ON transactions.request_type_id=request_type.id ORDER BY dateDenyApp DESC;";
			$result = mysqli_query($conn,$qry);
	?>	
			<div class="" style="margin-left: 52px;" ><br><br>
				
					
                                <!-- <div class="box-header"> -->
                                    <!-- <h3 class="box-title">Responsive Hover Table</h3> -->

                                <!-- </div> -->
                                
                                    <table id="alltransactions" class="" cellspacing="0" style="width:100%;">
                                        <thead>
											<th>Type</th>
											<th>Requested by</th>
                                            <th>Status</th>
											<th>Date Requested</th>
                                            <th>Date Approved/Denied</th>
											<th>Amount Paid</th>
                                            <th>Attended by</th>
                                        </thead>
										
										<?php 
											
											while($row = mysqli_fetch_array($result))
											{
												$amount = $row['amount'];
												if(is_null($amount) || $amount == 0)
													$amount = "-"; 
												else $amount = "PHP ".number_format($amount, 2);
												echo '<tr>';
												echo '<td>'.$row['request_name'].'</td>';
												
												echo '
												<form action = "" method = "GET" style="margin-left:25%">
													<input type="hidden" value="'.$row['rID'].'" id="user" name="user">
													<input type="hidden" value="Transaction History" id="type" name="type">
													<td><button type="submit" class="hyperbutton" formaction="resident" formmethod="GET" class="form-control-static">'.$row['residentname'].'</button></td>
												</form>
												';
														if($row['verified'] == 2)
															echo '<td><span class="label label-danger">'.'Denied'.'</span></td>';
														else if($row['verified'] == 1)
															echo '<td><span class="label label-success">'.'Approved'.'</span></td>';
														else if($row['verified'] == 0)	
															echo '<td><span class="label label-warning">'.'Pending'.'</span></td>';
												echo '<td><abbr class="timeago" title="'.$row['date'].'"></abbr></td>';
												echo '<td><abbr class="timeago" title="'.$row['dateDenyApp'].'"></abbr></td>';
												echo '<td>'.$amount.'</td>';
												echo '<td>'.$row['attendedby'].'</td>';
												echo '</tr>';
											}
										?>
                                    </table>
                                
				
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
	$('#alltransactions').DataTable({
		"iDisplayLength": 25,
		"bSort":false
	});

	jQuery(document).ready(function($){
	 $("abbr.timeago").timeago()

	});
</script>


