<!DOCTYPE html>
<html>
    <head></head>
    <body>
	<?php
		include("dash-top.php");
		if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id() && $_SESSION['u_isemployee'] == 1)
		{
			include("/_sql/config.php");
	?>	
			<div class="col-lg-offset-4 col-lg-5" ><br><br>
				<section class="panel">
					<header class="panel-heading">
						Add News/Announcement
					</header>
					<div class="panel-body">
						<form id='login_form' name="login_form" class="form-inline" role="form"><center>
							<div class="form-group">
								<textarea name="announcement" id="announcement" rows=5 cols=60></textarea>
								
								<select class="form-control m-b-10" id="priority">
									<option>Low Priority</option>
									<option>High Priority</option>
								</select>
								&nbsp&nbsp&nbsp&nbsp&nbsp <button type="button" id="post_an" class="btn btn-info" onClick="newAnnouncement()">Post</button>
							</div>
							
							
								
						
							
						</form>
						
						<form name="postAnnouncement" method="post" action="/success/newAnnouncement.php">
							<input type="hidden" name="ann_content" id="ann_content" value="">
							<input type="hidden" name="ann_priority" id="ann_priority" value="">
							<input type="hidden" name="ann_empid" id="ann_empid" value="<?php echo $_SESSION['u_employeeid']; ?>">
						</form>

					</div>
				</section>
			</div>
			
	<?php
			
		}
		else die("<script>location.href = 'home'</script>");
		
		include("dash-bot.php");
	?>

    </body>
</html>



