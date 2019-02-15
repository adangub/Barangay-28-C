<!DOCTYPE html>
<html>
    <head>
		
		<style>
			body {
			margin: 40px 10px;
			padding: 0;
			font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
			font-size: 14px;
			}
			#calendar {
			cursor: pointer; cursor: hand;
			max-width: auto;
			margin: 10px auto auto 170px;
			color: black;
			}
		</style>
		<?php
			include("dash-top.php");

			if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id() && $_SESSION['u_isemployee'] == 1):
			include '/_sql/config.php';
		?>	
		<link href='/css/fullcalendar.css' rel='stylesheet' />
		<link href='/css/fullcalendar.print.css' rel='stylesheet' media='print' />
		<script src='/js/moment.min.js'></script>
		<script src='/js/fullcalendar.min.js'></script>
		
		<script>
			$(document).ready(function() {
				$('#calendar').fullCalendar({

				<!--Header Section Including Previous,Next and Today-->
				header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
				},

				<!--Default Date-->
				defaultDate: '<?php echo date('Y-m-d'); ?>',
				editable: false,
				timeFormat: 'h:mmA',
				handleWindowResize: true,
				firstDay: 1,
				eventLimit: true,
				displayEventEnd: true,
				
				eventRender: function(event, element) 
				{ 
					element.find('.fc-title').append("<br/>" + event.description); 
				},
				
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
								title: '',
								description: "<?php echo $row['title']; ?>",
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
					
						// ALL BLOTTER SCHED
					
						$result = mysqli_query($conn,"SELECT hearing_schedule.id id, schedule_date, start_time, end_time, blotter_id, GET_COMPLAINANTNAME(blotter.complainant_id) cname FROM hearing_schedule INNER JOIN blotter ON blotter.id = hearing_schedule.blotter_id;");
						$number = mysqli_num_rows($result);
					
						
						while($row = mysqli_fetch_array($result))
						{	
							
							?>
							{	
								type: "blotter",
								id: '<?php echo $row['blotter_id']; ?>',
								title: '',
								description: '<?php echo "Blotter #".$row['blotter_id']." (".$row['cname'].")"; ?>',
								start: '<?php echo $row['schedule_date'].'T'.$row['start_time']; ?>',
								borderColor: '#e11e1e',
								backgroundColor: '#e11e1e',
								end: '<?php echo $row['schedule_date'].'T'.$row['end_time']; ?>'
							},
							<?php 
							
						}
						
					?>
				],
				
					
				eventClick: function (event) 
				{
				 //  alert("Event CLock");
				   //open ang modal dri para sa edit
				  
				  if(event.type == "program")
				  {
					var link = "newProgram_mini.php?request=hasEvent&eventID=";
					link = link.concat(event.id);
					
					newwindow=window.open(link,'Program','height=650,width=450');
					if (window.focus) {newwindow.focus()}
						return false;
				  }
				  else 
				  {
					  window.location.href = '/case?type=View+Blotter&user='+event.id;
				  }
				  
				},
				
				dayClick: function(date, jsEvent, view) 
				{
					//open modal na mag add ug event any even
					//var left = (screen.width/2)-(w/2);
					//var top = (screen.height/2)-(h/2);
					//return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
					
					var link = "newProgram_mini.php?request=newEvent&date=";
					link = link.concat(Date.parse(date));
					
					
					newwindow=window.open(link,'Program','height=575,width=450');
					if (window.focus) {newwindow.focus()}
						return false;
				},
				
				/*
				eventMouseover: function( event, jsEvent, view ) 
				{ 
					//open modal like the last time pero Hover sya.
					alert(event.title); // <-- Mu alert sya kung mu hover ang mouse nmu ang event // Test Ra Ni.
				}
				*/
				
				
				/*<!--Event Section-->
				eventLimit: true, // allow "more" link when too many events
				events: [
				{
					title: 'All Day Event',
					start: '2015-02-01'
				},
				{
					title: 'Long Event',
					start: '2015-02-07',
					end: '2015-02-10'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2015-02-09T16:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2015-02-16T16:00:00'
				},
				{
					title: 'Conference',
					start: '2015-02-11',
					end: '2015-02-13'
				},
				{
					title: 'Meeting',
					start: '2015-02-12T10:30:00',
					end: '2015-02-12T12:30:00'
				},
				{
					title: 'Lunch',
					start: '2015-02-12T12:00:00'
				},
				{
					title: 'Meeting',
					start: '2015-02-12T14:30:00'
				},
				{
					title: 'Happy Hour',
					start: '2015-02-12T17:30:00'
				},
				{
					title: 'Dinner',
					start: '2015-02-12T20:00:00'
				},
				{
					title: 'Birthday Party',
					start: '2015-02-13T07:00:00'
				},
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2015-02-28'
				}
				]*/
				});
			});
		</script>
	</head>
    <body>
	
		<div id='calendar'></div>
	<!-- fuck all ur code here -->
	
		<?php 
		mysqli_close($conn);
		else: die("<script>location.href = 'home'</script>");
		endif;
		include("dash-bot.php"); ?>
		
		
    </body>
	
	
	
</html>



