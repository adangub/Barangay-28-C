<!DOCTYPE html>
<html>
    <head></head>
    <body>
	<?php
		include("dash-top.php");
		if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id()) 
		{
			include("/_sql/config.php");
	?>		
		
			

	<div class="col-lg-offset-3 col-lg-7" ><br>
	<div class="panel-body">
		<div class="col-lg-11">
				<section class="panel">
				<header class="panel-heading" style="margin-bottom: 15px;">Report</header>
				<form name = "fromto"  method='post' enctype='multipart/form-data' action="docs/report.php">
				<center>
					<div class="form-group">
					From
							<select id="frommonth">
						<option <?php if(date("F") === "January") echo "selected='selected'"; ?>>January</option>
							<option <?php if(date("F") === "February") echo "selected='selected'"; ?>>February</option>
							<option <?php if(date("F") === "March") echo "selected='selected'"; ?>>March</option>
							<option <?php if(date("F") === "April") echo "selected='selected'"; ?>>April</option>
							<option <?php if(date("F") === "May") echo "selected='selected'"; ?>>May</option>
							<option <?php if(date("F") === "June") echo "selected='selected'"; ?>>June</option>
							<option <?php if(date("F") === "July") echo "selected='selected'"; ?>>July</option>
							<option <?php if(date("F") === "August") echo "selected='selected'"; ?>>August</option>
							<option <?php if(date("F") === "September") echo "selected='selected'"; ?>>September</option>
							<option <?php if(date("F") === "October") echo "selected='selected'"; ?>>October</option>
							<option <?php if(date("F") === "November") echo "selected='selected'"; ?>>November</option>
							<option <?php if(date("F") === "December") echo "selected='selected'"; ?>>December</option>
					</select>
							<select id="day">
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
							<select id="fromyear">
								
								<?php
									$year = date("Y");
									$minuseighty = $year-3;
									while($year >= $minuseighty)
									{
										?><option>
										<?php echo $year; ?></option> <?php
										$year = $year - 1;
									}
								?>
							</select>
						
						<!-- AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
						-->
						To
							<select id="q">
						<option <?php if(date("F") === "January") echo "selected='selected'"; ?>>January</option>
							<option <?php if(date("F") === "February") echo "selected='selected'"; ?>>February</option>
							<option <?php if(date("F") === "March") echo "selected='selected'"; ?>>March</option>
							<option <?php if(date("F") === "April") echo "selected='selected'"; ?>>April</option>
							<option <?php if(date("F") === "May") echo "selected='selected'"; ?>>May</option>
							<option <?php if(date("F") === "June") echo "selected='selected'"; ?>>June</option>
							<option <?php if(date("F") === "July") echo "selected='selected'"; ?>>July</option>
							<option <?php if(date("F") === "August") echo "selected='selected'"; ?>>August</option>
							<option <?php if(date("F") === "September") echo "selected='selected'"; ?>>September</option>
							<option <?php if(date("F") === "October") echo "selected='selected'"; ?>>October</option>
							<option <?php if(date("F") === "November") echo "selected='selected'"; ?>>November</option>
							<option <?php if(date("F") === "December") echo "selected='selected'"; ?>>December</option>
					</select>
								<select id="w">
									
									<?php
										$days = 1;
										while($days <= 31)
										{
											if($days!=31){
											?><option>
											<?php echo $days; ?></option> <?php
											$days = $days + 1;
											}
											else {
												echo "<option selected='selected'>31</option>";
												$days = $days + 1;
											}
										}
									?>
								</select>
							<select id="e">
								
								<?php
									$year = date("Y");
									$minuseighty = $year-3;
									while($year >= $minuseighty)
									{
										?><option>
										<?php echo $year; ?></option> <?php
										$year = $year - 1;
									}
								?>
							</select> 
							<br>
							Type of Report:
							<select id="types" style="margin-top: 3%">
								<option>Residency</option>
								<option>Barangay Clearance</option>
								<option>Police Clearance</option>
								<option>NBI Clearance</option>
								<option>Blotter</option>
							</select>
					</div>
				
				<!-- AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
						-->
				
					<br>
					<center>
					<input type="hidden" id="rYear" name="rYear">
					<input type="hidden" id="rMonth" name="rMonth">
					<input type="hidden" id="rDay" name="rDay">
					
					<input type="hidden" id="pYear" name="pYear">
					<input type="hidden" id="pMonth" name="pMonth">
					<input type="hidden" id="pDay" name="pDay">
					
					<input type="hidden" id="rType" name="rType">
					<input type="button" class="btn btn-primary" value="Generate!" onClick="Report()"></center>
					<br>
				</form>
  
			</section>
		</div>	 
	</div>
	</div>
		
				
	<?php
			
		}
		else die("<script>location.href = 'index.php'</script>");
		
		include("dash-bot.php");
	?>

    </body>
</html>



