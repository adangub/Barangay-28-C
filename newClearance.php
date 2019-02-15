<!DOCTYPE html>
<html>
    <head></head>
    <body>
	<?php
		include("dash-top.php");
		if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id()) 
		{
	?>	
	
			<?php 
			include("/_sql/config.php");
			$uID = $_SESSION['u_id'];
			$result = mysqli_query($conn, "SELECT GET_TOTALREQUESTSBYTYPE(id, 2) brgy, GET_TOTALREQUESTSBYTYPE(id, 3) police, GET_TOTALREQUESTSBYTYPE(id, 4) nbi, GET_TOTALVERIFIEDREQUESTS(id, 1, 1) residencyvalid, eligibility FROM resident WHERE id = '$uID';");
			$row = mysqli_fetch_array($result);
			$t_el = $row['eligibility'];
			if(!$t_el)
				$t_el = 0;
			$t_brgy = $row['brgy'];
			$t_police = $row['police'];
			$t_nbi = $row['nbi'];
			$t_validRes = $row['residencyvalid'];
			$t_total = $t_brgy + $t_police + $t_nbi;
			?>
	
			<div class="col-lg-offset-4 col-lg-5" ><br><br>
				<section class="panel">
					<header class="panel-heading">
						Select Clearance
					</header>
					<div class="panel-body">
						<form id='login_form' name="login_form" class="form-inline" role="form"><center>
							<div style="text-align:center"> 
								<div class="radio">
									<label>
										<input type="radio" name="clearance" id="brgy" value="brgy" <?php if ($t_brgy > 0 || $t_el == 0 || $t_validRes == 0) echo "disabled"; ?>>
										Barangay Clearance
									</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
									<label>
										<input type="radio" name="clearance" id="police" value="police" <?php if ($t_police > 0 || $t_el == 0 || $t_validRes == 0) echo "disabled"; ?>>
										Police Clearance
									</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
									<label>
										<input type="radio" name="clearance" id="nbi" value="nbi" <?php if ($t_nbi > 0 || $t_el == 0 || $t_validRes == 0) echo "disabled"; ?>>
										NBI Clearance
									</label>
								</div>
								
							</div>
						</form>
					</div>
					
					
					<div style="text-align:center">
						<button type="button" id="login" class="btn btn-info" onClick="newClearance()" <?php if($t_total == 3 || $t_el == 0 || $t_validRes == 0) echo "disabled"; ?>>Request</button><br>
						<?php if($t_validRes == 0 || $t_total > 0 && $t_el == 1): ?>
							<center style="color:red"><h6>You have a pending request.</h6>
								
									
							<form action = "/resident#requests" method = "GET" style="">
								<input type="hidden" value="<?php echo $_SESSION['u_id']; ?>" id="user" name="user">
								<input type="hidden" value="View Profile" id="type" name="type">
								<i><h6><p class="help-block"> <button type="submit" class="hyperbutton" formaction="resident#requests" formmethod="GET" class="form-control-static">(Why am I seeing this?) </button><h6></p></i>
							</form></center>
								
							</center>
						<?php elseif($t_el == 0): ?>
							<center style="color:red"><h6>You are not eligible for a clearance request</h6></center>
							<form action = "" method = "GET" style="">
								<input type="hidden" value="<?php echo $_SESSION['u_id']; ?>" id="allblot" name="allblot">
								<i><h6><p class="help-block"> <button type="submit" class="hyperbutton" formaction="all-blotters" formmethod="GET" class="form-control-static"><?php echo "(Why am I seeing this?)"; ?></button><h6></p></i>
							</form>
						<?php else: ?>
							<p class="help-block">After requesting, please proceed to the barangay and pay the small fee.</p>
						<?php endif; ?>
					</div>
					
					<br>
				</section>
			</div>
			
			
			<form name="clearanceRequest" method="POST" action="/success/newClearance.php"> <!-- Add Employee -->
						<input type="hidden" name="clearance_uID" id="clearance_uID" value="<?php echo $_SESSION['u_id']; ?>">
						<input type="hidden" value="" id="cType" name="cType">
			</form>
	<?php
		mysqli_close($conn);
		}
		else die("<script>location.href = 'index.php'</script>");
		include("dash-bot.php");
	?>

    </body>
</html>
