<!DOCTYPE html>

<html>
<?php include("dash-top.php"); ?>
<head>
	
	<link href='css/fullcalendar.css' rel='stylesheet' />
	<link href='css/fullcalendar.print.css' rel='stylesheet' media='print' />
	<script src='js/moment.min.js'></script>
	<script src='js/fullcalendar.min.js'></script>
    <meta charset="UTF-8">
    <title>Barangay 28-C | Home</title>
	<style>
	hr {
    border: 0;
    height: 1px;
    background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(199, 199, 199, 0.75), rgba(0, 0, 0, 0));
	color: red;
}
	</style>
<!-- ===================================================================== Content ===================================================================================-->
			<aside class="right-side">
                <!-- Main content -->
                <section class="content">
				<center>
				<div style="width: 90%">
				
				<div style="margin-top: -10px; margin-left: 107px; background-color: white; border-radius: 10px 10px 10px 10px">
				
				
				<div class="row" style=" margin-left: 0px; margin-right: 0px; height: 103px">
					<div class="col-md-3">
						<div class="sm-st clearfix">
							<span class="sm-st-icon st-red"><i class="fa fa-check-square-o"></i></span>
							<div class="sm-st-info">
								<span>
									<?php
										include '/_sql/config.php';
										$result=mysqli_query($conn,"SELECT COUNT(id) 'count' FROM requests WHERE verified = 0 LIMIT 1;");
										$rows = mysqli_fetch_array($result);
										echo $rows['count'];
									?>
								</span>
								Pending Requests
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="sm-st clearfix">
							<span class="sm-st-icon st-violet"><i class="fa fa-envelope-o"></i></span>
							<div class="sm-st-info">
								<span>
									<?php
										$result=mysqli_query($conn,"SELECT COUNT(id) 'count' FROM resident LIMIT 1;");
										$rows = mysqli_fetch_array($result);
										echo $rows['count'];
									?>
								</span>
								Total Population
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="sm-st clearfix">
							<span class="sm-st-icon st-blue"><i class="fa fa-dollar"></i></span>
							<div class="sm-st-info">
								<span>
									<?php
										$result=mysqli_query($conn,"SELECT SUM(amount) 'count' FROM transactions LIMIT 1;");
										$rows = mysqli_fetch_array($result);
										echo number_format($rows['count'], 2);
									?>
								</span>
								Earnings
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="sm-st clearfix">
							<span class="sm-st-icon st-green"><i class="fa fa-paperclip"></i></span>
							<div class="sm-st-info">
								<span>
									<?php
										$result=mysqli_query($conn,"SELECT COUNT(id) 'count' FROM transactions LIMIT 1;");
										$rows = mysqli_fetch_array($result);
										echo $rows['count'];
										
									?>
								</span>
								Total Transactions
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="clickme" id="clickme">
				<center>
				<table>
				<tr align=center>
				
				<td style="width: 25%; border-right: solid 1px #dbdbdb"><div id="clickannouncement" style="cursor: pointer; cursor: hand;">Announcements</div></td>
				<td style="width: 25%; border-right: solid 1px #dbdbdb"><div id="clickevents" style="cursor: pointer; cursor: hand;">Events</div></td>
				<td style="width: 25%; border-right: solid 1px #dbdbdb"><div id="clickcalendar" style="cursor: pointer; cursor: hand;">Calendar</div></td>
				<td style="width: 25%;"><div id="clickaboutus" style="cursor: pointer; cursor: hand;">About Us</div></td>
				
				</tr>
				</table>
				
				</center>
				</div>
				
				<div id="announcementtab">
				<center>
				<?php
				$result=mysqli_query($conn,"SELECT date, content, priority, GET_EMPNAME(employee_id, 3) name FROM announcements ORDER BY date DESC LIMIT 5;");
				$priority = "";
				while($rows = mysqli_fetch_array($result)){
					if($rows['priority'] == 0)
						$priority = "alert alert-success";
					else if($rows['priority'] == 1)
						$priority = "alert alert-block alert-danger";
					$date = $rows['date'];
					$content = $rows['content'];
					$date = date_create($date);
					$date = date_format($date, 'F j Y');
					?>
					<div style="width: 70%; padding: 1%; border: solid 0px #dbdbdb" class="">
						<p align="justify"><?php echo $content ?></p>
						<div style="width: 285px; margin-right: -720px"><h6>
						<p class="help-block" style="text-align:right; margin:0"><?php echo $rows['name']; ?></p>
						<p class="help-block" style="text-align:right; margin:0"><abbr class="timeago" style="text-align:right" title="<?php echo $rows['date']; ?>"></abbr></p>
						</h6>
					</div>
					<br>
					<hr>
					</div>
					
					<?php
				}
				
				?>
				
				</center>
				</div>
				
				<div id="calendartab" style="display:none">
				
				</div>
				
				<div id="eventstab" style="display:none">
					<div class="panel-body" style="height:1000px; width: 30%">
						<?php
							if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id()):
								$uID = $_SESSION['u_id'];
								$result=mysqli_query($conn,"SELECT program.id id, date, title, place, timeFrom, timeTo, status, (SELECT resident_id FROM participants WHERE program_id = id AND resident_id = '$uID') participating, GET_EMPNAME(employee_program_assignment.employee_id,0) ename FROM program INNER JOIN employee_program_assignment ON employee_program_assignment.programs_id = program.id WHERE date BETWEEN (NOW() - INTERVAL 1 DAY) AND DATE_ADD(NOW(), INTERVAL 7 DAY) ORDER BY DATE ASC LIMIT 10;");
							else:
								$result=mysqli_query($conn,"SELECT program.id id, date, title, place, timeFrom, timeTo, status, GET_EMPNAME(employee_program_assignment.employee_id,0) ename FROM program INNER JOIN employee_program_assignment ON employee_program_assignment.programs_id = program.id WHERE date BETWEEN (NOW() - INTERVAL 1 DAY) AND DATE_ADD(NOW(), INTERVAL 7 DAY) ORDER BY DATE ASC LIMIT 10;");
							endif;
							while($row = mysqli_fetch_array($result))
							{
								if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id()):
									$participating = 0;
									$id = $row['id'];
									$participatingId = $row['participating'];
									if(!$participatingId)
									{
										$participating = 0;
										$participatingId = $_SESSION['u_id'];
									}
									else $participating = 1;
								endif;
								?>
								<div class="alert alert-warning">
									<?php echo "<h4>".$row['title']."</h4>"; ?>
									<?php echo '<h6> Time: '.date("h:iA", strtotime($row['timeFrom'])).' to '.date("h:iA", strtotime($row['timeTo'])); ?>
									<?php echo '<br>Venue: '.$row['place']."</h6>"; ?>
									<?php if(date("Y-m-d") == $row['date'] && (date("H:i:s") >= $row['timeFrom'] && date("H:i:s") <= $row['timeTo'])):?>
										<span class="label label-warning">In Progress</span>
									<?php elseif(date("Y-m-d") == $row['date'] && (date("H:i:s") >= $row['timeFrom'])): ?>
										<span class="label label-success">Done</span>
									<?php else: ?>
										<span class="label label-danger">Upcoming</span>
									<?php endif; ?>
									<p class="help-block" style="text-align:right; margin:0"><?php echo $row['ename']; ?></p>
									<p class="help-block" style="text-align:right; margin:0"><abbr class="timeago" style="text-align:right" title="<?php echo $row['date']." ".$row['timeFrom']; ?>"></abbr></p>
									
									<?php if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id() && $_SESSION['u_verified'] > 0 ): ?>
										<?php if($participating == 0): ?>
											<button type="button" id="login" class="btn btn-primary" style="" onClick="AddParticipantFromHome(<?php echo $participatingId; ?>, <?php echo $id; ?>)">Join Event</button>
										<?php else: ?>
											<button type="button" id="login" class="btn btn-primary" style="" onClick="DeleteParticipantFromHome(<?php echo $participatingId; ?>, <?php echo $id; ?>)">Leave Event</button> 
										<?php endif; ?>
									<?php endif; ?>
								</div><?php
							}?>
					</div>
				</div>
				
				<div id="aboutustab" style="display:none; width: 80%">
				<center>
					<div style="height: 270px">
						<img src="img/seal.png" width=240 style="margin-right: 0px">
					</div>
					<p>
					Barangay 28-C has a total land area of 15.87 hectares with a total number of households of 508  
					and a population of approximately 2,538 subdivided and grouped into seven puroks. Upon approval 
					and implementation of SP Resolution No. 1742 under PD No. 431. Barangay 28-C celebrates its Barangay 
					day every 25th day of April.
					</p>
				</center>
				<br>
				</div>
		<center>
		<div class=" col-lg-11" style="width:100%">
<center>
							
    <!-- Jssor Slider Begin -->
   
        <!-- Jssor Slider Begin -->
        <!-- To move inline styles to css file/block, please specify a class name for each element. --> 
        <!-- ================================================== -->
        
        <!-- Jssor Slider End -->
    
    <!-- Jssor Slider End -->

						
					
					<br>
					<h4><center>"
						<?php 
							$location = 'Davao City';
							$document = file_get_contents(str_replace(" ", "+", "http://api.wunderground.com/auto/wui/geo/WXCurrentObXML/index.xml?query=" . $location));
							$xml = new SimpleXMLElement($document);
							$currentLocation = $xml->temp_c."&deg; C in $location"; 
							$temp = $xml->temp_c."&deg; C";
							$condition = "";
							
							if ($temp <= 23)
								$condition = "cold";
							else if ($temp > 23 && $temp <= 25)
								$condition = "a little cold";
							else if ($temp > 25 && $temp <= 30)
								$condition = "warm";
							else if ($temp > 30 && $temp <= 33)
								$condition = "a little hot";
							else if ($temp > 33 && $temp <= 35)
								$condition = "hot";
							else if ($temp > 35 && $temp <= 40)
								$condition = "very hot";
							else if ($temp > 40)
								$condition = "severely hot";
							
							$hrs = date("H");
							$returns = "";
						
							if ($hrs < 12)
								$returns = 'morning';
							else if ($hrs >= 12 && $hrs <= 17)
								$returns = 'afternoon';
							else if ($hrs >= 17 && $hrs <= 24)
								$returns = 'evening';
							
							
							
							echo "It's ".date('h:i')." on a ".$condition." ".strtolower(date('l'))." ".$returns;
						?>
					"
					<?php echo "<br><h6>".$currentLocation."</h6>"; ?>
					</center></h4>
					
					<br><br>	
						
					</div>
					
					
					
					
                    
					</div>
					   <form name="newParticipants" method="post" action="success/newParticipants.php">
							<input type="hidden" name="programID" id="programID" value="">
							<input type="hidden" name="uID" id="uID" value="">
						</form>

						<form name="deleteParticipant" method="post" action="success/deleteParticipants.php">
							<input type="hidden" name="programID" id="programID" value="">
							<input type="hidden" name="uID" id="uID" value="">
						</form>
					</section>
					
               <!-- <div class="footer-main">
                    ORE WA &copy Director, 2014
                </div> -->
			</aside>
        </div>
	</body>
</html>









<!-- datepicker
        <script src="js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>-->
        <!-- Bootstrap WYSIHTML5
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>-->
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- calendartab -->
        <script src="js/plugins/fullcalendar/fullcalendar.js" type="text/javascript"></script>

       
		

        <!-- Director dashboard demo (This is only for demo purposes) TIME AGO NOT WORKING BECAUSE OF THIS-->
			<!-- <script src="js/Director/dashboard.js" type="text/javascript"></script> -- >

        <!-- Director for demo purposes -->
        <script type="text/javascript">
            $('input').on('ifChecked', function(event) {
                // var element = $(this).parent().find('input:checkbox:first');
                // element.parent().parent().parent().addClass('highlight');
                $(this).parents('li').addClass("task-done");
                console.log('ok');
            });
            $('input').on('ifUnchecked', function(event) {
                // var element = $(this).parent().find('input:checkbox:first');
                // element.parent().parent().parent().removeClass('highlight');
                $(this).parents('li').removeClass("task-done");
                console.log('not');
            });

        </script>
        <script>
			
			$("#clickAnnouncement").click(function()
			{
				$("#Announcements").slideToggle();
			});
			
			$("#clickEvents").click(function()
			{
				$("#Events").slideToggle();
			});
			$("#calendartab").slideToggle();
			$("#clickCalendar").click(function()
			{
				$("#calendartab").slideToggle();
			});
			
			$("#clickAbout").click(function()
			{
				$("#About").slideToggle();
			});
			
            $('#noti-box, #noti-box2').slimScroll({
                height: '290px',
                size: '5px',
                BorderRadius: '5px'
            });

            $('input[type="checkbox"].flat-grey, input[type="radio"].flat-grey').iCheck({
                checkboxClass: 'icheckbox_flat-grey',
                radioClass: 'iradio_flat-grey'
            });
</script>

<script src="js/jquery.timeago.js" type="text/javascript"></script>
<script>
	jQuery(document).ready(function($){
	 $("abbr.timeago").timeago()

	});
	
	 $('#calendartab').fullCalendar({
		 
		 titleFormat: '[]',
		 
		<?php if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id() && $_SESSION['u_isemployee'] == 1): ?>
		eventClick: function (event) 
		{
			window.location.href = '/events';
		},
		dayClick: function(date, jsEvent, view) 
		{
			window.location.href = '/events';
		},
		<?php endif; ?>
		
		events: [
		<?php 
		
			// ALL EVENTS
			//http://fullcalendar.io/docs/event_data/Event_Object/#color-options
		
			$result = mysqli_query($conn,"SELECT id, title, date, timeFrom, timeTo FROM program;");
			$number = mysqli_num_rows($result);
		
			
			while($row = mysqli_fetch_array($result))
			{	
				
				?>
				{
					type: "program",
					id: '<?php echo $row['id']; ?>',
					title: '<?php echo $row['title']; ?>',
					start: '<?php echo $row['date'].'T'.$row['timeFrom']; ?>',
					<?php if(date('Y-m-d') == $row['date']): ?>
						backgroundColor: '#eab126',
						borderColor: '#eab126',
					<?php else: ?>
						backgroundColor: '#075697',
						borderColor: '#075697',
					<?php endif; ?>
					end: '<?php echo $row['date'].'T'.$row['timeTo']; ?>'
				},
				<?php 
				
				
			}
		
			/* ALL BLOTTER SCHED
		
			$result = mysqli_query($conn,"SELECT hearing_schedule.id id, schedule_date, start_time, end_time, blotter_id, GET_COMPLAINANTNAME(blotter.complainant_id) cname FROM hearing_schedule INNER JOIN blotter ON blotter.id = hearing_schedule.blotter_id;");
			$number = mysqli_num_rows($result);
		
			
			while($row = mysqli_fetch_array($result))
			{	
				
				?>
				{	
					type: "blotter",
					id: '<?php echo $row['blotter_id']; ?>',
					title: '<?php echo "Blotter #".$row['blotter_id']." (".$row['cname'].")"; ?>',
					
					//description: '',
					start: '<?php echo $row['schedule_date'].'T'.$row['start_time']; ?>',
					borderColor: '#e11e1e',
					backgroundColor: '#e11e1e',
					end: '<?php echo $row['schedule_date'].'T'.$row['end_time']; ?>'
				},
				<?php 
				
			}*/
			mysqli_close($conn);
		?>
		],
    });
</script>
<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   
    <script src="docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="ie10-viewport-bug-workaround.js"></script>

    <!-- jssor slider scripts-->
    <!-- use jssor.slider.debug.js for debug -->
    <script type="text/javascript" src="js/jssor.slider.mini.js"></script>
    <script>
		$("#newAnnouncement").click(function() 
		{
			location.href = 'announcement';
			
		});
        jQuery(document).ready(function ($) {
            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                $Idle: 2000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                                   //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideEasing: $JssorEasing$.$EaseOutQuint,          //[Optional] Specifies easing for right to left animation, default value is $JssorEasing$.$EaseOutQuad
                $SlideDuration: 800,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0
                $Cols: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                $DragOrientation: 1,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $Cols is greater than 1, or parking position is not 0)

                $ArrowNavigatorOptions: {                           //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,                  //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                    $Scale: false                                   //Scales bullets navigator or not while slider scale
                },

                $BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
                    $Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                    $Rows: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                    $SpacingX: 12,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
                    $SpacingY: 4,                                   //[Optional] Vertical space between each item in pixel, default value is 0
                    $Orientation: 1,                                //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                    $Scale: false                                   //Scales bullets navigator or not while slider scale
                }
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizing
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth) {
                    jssor_slider1.$ScaleWidth(parentWidth - 30);
                }
                else
                    window.setTimeout(ScaleSlider, 30);
            }
            ScaleSlider();

            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
        });
		
		$( "#calendartab" ).hide(0);
		$( "#clickannouncement" ).click(function() {
		  $( "#eventstab" ).hide(0);
		  $( "#calendartab" ).hide(0);
		  $( "#aboutustab" ).hide(0);
		  $( "#announcementtab" ).show(0);
		});
		
		$( "#clickevents" ).click(function() {
		  $( "#announcementtab" ).hide(0);
		  $( "#calendartab" ).hide(0);
		  $( "#aboutustab" ).hide(0);
		  $( "#eventstab" ).show(0);
		});
		
		$( "#clickcalendar" ).click(function() {
		  $( "#announcementtab" ).hide(0);
		  $( "#aboutustab" ).hide(0);
		  $( "#eventstab" ).hide(0);
		  $( "#calendartab" ).show(0);
		});
		
		$( "#clickaboutus" ).click(function() {
		  $( "#announcementtab" ).hide(0);
		  $( "#calendartab" ).hide(0);
		  $( "#eventstab" ).hide(0);
		  $( "#aboutustab" ).show(0);
		});
		
		$("#clickannouncement").on('mouseover', function () {
			$(this).fadeTo(150, 0.7);
		});
		
		$("#clickevents").on('mouseover', function () {
			$(this).fadeTo(150, 0.7);
		});
		
		$("#clickcalendar").on('mouseover', function () {
			$(this).fadeTo(150, 0.7);
		});
		
		$("#clickaboutus").on('mouseover', function () {
			$(this).fadeTo(150, 0.7);
		});
		
		$("#clickannouncement").on('mouseleave', function () {
			$(this).fadeTo(150, 1);
		});
		
		$("#clickevents").on('mouseleave', function () {
			$(this).fadeTo(150, 1);
		});
		
		$("#clickcalendar").on('mouseleave', function () {
			$(this).fadeTo(150, 1);
		});
		
		$("#clickaboutus").on('mouseleave', function () {
			$(this).fadeTo(150, 1);
		});
		
    </script>