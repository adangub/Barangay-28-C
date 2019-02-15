<!DOCTYPE html>
<html>
    <head>
		<link rel="icon" type="image/png" href="/img/favicon.png" />
	
		<script src="js/everythingvalidation.js" type="text/javascript"></script>
	
        <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="description" content="Developed By M Abdur Rokib Promy">
        <meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />

		<style>
		
			/* latin-ext */
			@font-face {
			  font-family: "Tahoma", Geneva, sans-serif;
			}
			/* latin */
			@font-face {
			  font-family: "Tahoma", Geneva, sans-serif;
			}
		</style>
       
        <!-- Theme style -->
        <link href="css/style.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
		
    </head>
	<?php
		/* CHECK FOR SESSION NOT EXISTING
			if(session_id() == '' || !isset($_SESSION)): 
		   CHECK FOR EMPLOYEE LOGGED IN 
		    if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id() && $_SESSION['u_isemployee'] == 1):
		   CHECK IF LOGGED IN 
		    if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id()):
		*/
	
	
		include("/_sql/config.php");
		
		if(isset($_COOKIE['ux']))
		{
			session_id($_COOKIE['ux']);
			session_start();
			$fullname = $_SESSION['u_fullname'];
			$firstname = $_SESSION['u_firstname'];
		}
		date_default_timezone_set("Asia/Manila");

	?>	
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="home" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <?php echo preg_replace('/(?<!\ )[A-Z]/', ' $0', ucwords(str_replace('.php', '',basename($_SERVER['PHP_SELF'])))); ?>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
						<?php 
						if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id() && $_SESSION['u_isemployee'] == 1):
						{
						?>
							<li class="dropdown messages-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="fa fa-envelope" style="color: #FFFFFF;"></i>
									
									<?php 

										$result=mysqli_query($conn, "SELECT COUNT(id) ReqCOUNT FROM requests WHERE verified = 0 LIMIT 1;");
										$row=mysqli_fetch_array($result);
										
										$GLOBALS['ReqCOUNT'] = $row['ReqCOUNT'];
										
										if($GLOBALS['ReqCOUNT'] != 0)
										{
											?>
											<span class="badge badge-danger" style="position:relative; top: -20px; left: -10px;">
											<?php 
												echo $GLOBALS['ReqCOUNT'];
										}


									?>
									
									
									
									</span>
								</a>
								<ul class="dropdown-menu">
									<?php 
										$counter = $GLOBALS['ReqCOUNT'];
										if($counter != 0)
										{
											$req = "requests";
											if($counter == 1)
											{
												$req = "request"; 
											}
											?>
											<li class="header">Showing <?php echo $counter.' '.$req; ?></li>
											<?php 
										}
										else
										{
											?><li class="header">No New Requests</li><?php
										}
									?>
									
									<li>
										<!-- inner menu: contains the actual data -->
										<ul class="menu">
										
										
											<?php 
											
												$result=mysqli_query($conn, "SELECT requests.resident_id,  GET_FULLNAME(requests.resident_id, 0) fullname, request_type.request_name, requests.date, resident.image FROM requests INNER JOIN request_type ON request_type.id = requests.request_type_id INNER JOIN resident ON resident.id = requests.resident_id WHERE verified=0 ORDER BY date DESC;");
												
												if(mysqli_num_rows($result) != 0)
												{
													while($row=mysqli_fetch_array($result))
													{
														$image = $row['image'];
														?>
															<li>
																<a href="javascript:;"onClick="document.getElementById('user').value = <?php echo $row['resident_id']; ?>; document.getElementById('type').value = 'View Profile'; document.getElementById('requestDropDown').submit();">
																	<div class="pull-left">
																		<?php if($image == NULL || $image == ""): ?>
																			<img src="img/user/default.jpg" class="img-circle" alt="User Image"/>
																		<?php else: ?>
																			<img src="img/user/<?php echo $image; ?>" class="img-circle" alt="User Image"/>
																		<?php endif; ?>
																	</div>
																	<h4>
																		<?php echo $row['fullname']; ?>
																	</h4>
																	<p><?php echo $row['request_name']; ?></p>
																	<h4><small><i class="fa fa-clock-o"></i><?php echo " <abbr class='timeago' title='".$row['date']."'></abbr>"; ?></small></h4>
																</a>
																</form>
															</li>
														<?php
													}
												}
												else
												{
													?>
														<li style="text-align:center; margin-left: 1.5cm;">
															<h4><small>All caught up!</small><img src="img/check.png" class="img-circle" alt="User Image"/></h4>
														</li>
													<?php 
												}
											
											?>
											
										</ul>
									</li>
									<li class="footer"><a href="constituents">See All Requests</a></li>
								</ul>
							</li>
							<li class="dropdown messages-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="fa fa-tasks" style="color: #FFFFFF;"></i>
									
									<?php 

										$result=mysqli_query($conn, "SELECT (SELECT COUNT(id) FROM program WHERE date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY) LIMIT 1) ProgCount, (SELECT COUNT(id) FROM hearing_schedule WHERE schedule_date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY) LIMIT 1) HearCount FROM dual;");
										$row=mysqli_fetch_array($result);
										
										$GLOBALS['ProgCOUNT'] = $row['ProgCount']+$row['HearCount'];
										
										if($GLOBALS['ProgCOUNT'] != 0)
										{
											?>
											<span class="badge badge-danger" style="position:relative; top: -20px; left: -10px;">
											<?php 
												echo $GLOBALS['ProgCOUNT'];
										}


									?>
									
									
									
									</span>
								</a>
								<ul class="dropdown-menu">
									<?php 
										$counter = $GLOBALS['ProgCOUNT'];
										if($GLOBALS['ProgCOUNT'] != 0)
										{
											$req = "events of the week";
											if($counter == 1)
											{
												$req = "event of the week"; 
											}
											?>
											<li class="header">Showing <?php echo $counter.' '.$req; ?></li>
											<?php 
										}
										else
										{
											?><li class="header">No Upcoming Events</li><?php
										}
									?>
									
									<li>
										<!-- inner menu: contains the actual data -->
										<ul class="menu">
										
										
											<?php 
											
												$result=mysqli_query($conn, "SELECT id, date, title, place, timeFrom, status FROM program WHERE date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY) ORDER BY DATE ASC;");
												$resultcount = mysqli_num_rows($result);
												if(mysqli_num_rows($result) != 0)
												{
													
													while($row=mysqli_fetch_array($result))
													{
														?>
															<li>
																<a href="events">
																	<div class="pull-left">
																		<img src="img/seal.png" class="img-circle" alt="User Image"/>
																	</div>
																	
																	<h5> <?php echo $row['title']; ?> </h5>
																	<p>in <?php echo $row['place']; ?> </p>
																	
																	
																	<h4><small><i class="fa fa-clock-o"></i><?php echo " <abbr class='timeago' title='".$row['date'].' '.$row['timeFrom']."'></abbr>"; ?></small></h4>
																	
																</a>
																</form>
															</li>
														<?php
													}
												}
												$result = mysqli_query($conn,"SELECT hearing_schedule.id id, schedule_date, start_time, end_time, blotter_id, GET_COMPLAINANTNAME(blotter.complainant_id) cname FROM hearing_schedule INNER JOIN blotter ON blotter.id = hearing_schedule.blotter_id WHERE schedule_date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY) ORDER BY DATE ASC;;");
												$resultcount += mysqli_num_rows($result);
												if(mysqli_num_rows($result) != 0)
												{
													while($row=mysqli_fetch_array($result))
													{
														?>
															<li>
																<a href="events">
																	<div class="pull-left">
																		<img src="img/seal.png" class="img-circle" alt="User Image"/>
																	</div>
																	
																	<h5> <?php echo "Blotter #".$row['blotter_id']; ?> </h5>
																	<p>by <?php echo $row['cname']; ?> </p>
																	
																	
																	<h4><small><i class="fa fa-clock-o"></i><?php echo " <abbr class='timeago' title='".$row['schedule_date'].' '.$row['start_time']."'></abbr>"; ?></small></h4>
																	
																</a>
																</form>
															</li>
														<?php
													}
												}
												if($resultcount == 0)
												{
													?>
														<li style="text-align:center; margin-left: 1.5cm;">
															<h4><small>No Upcoming Event!</small><img src="img/check.png" class="img-circle" alt="User Image"/></h4>
														</li>
													<?php 
												}
											
											?>
											
										</ul>
									</li>
									<li class="footer"><a href="events">See All Events</a></li>
								</ul>
							</li>
						<?php
						} endif;
						?>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">

                            <?php if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id())
									  echo '<a href="#" style="color: #FFFFFF;" class="dropdown-toggle" data-toggle="dropdown">';
								  else 
									  echo '<a href="login" style="color: #FFFFFF;">';
							?>
							
                                <i class="fa fa-user" style="color: #FFFFFF;"></i>
									<span><?php if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id())
													echo $fullname; 
												else
													echo 'Login';?>
												<i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                <li class="dropdown-header text-center">Account</li>
								
								<?php 
								if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id() && $_SESSION['u_isemployee'] == 1):
								{
								?>
									<li>
										<a href="constituents">
										<i class="fa fa-envelope-o fa-fw pull-right"></i>
											<span class="badge badge-danger pull-right"><?php echo $GLOBALS['ReqCOUNT'] ?></span> Requests</a>
										<a href="events">
										<i class="fa fa-tasks fa-fw pull-right"></i>
											<span class="badge badge-success pull-right"><?php echo $GLOBALS['ProgCOUNT'] ?></span> Programs & Events</a>
										<!-- <a href="#"><i class="fa fa-magnet fa-fw pull-right"></i>
											<span class="badge badge-info pull-right">3</span> Subscriptions</a>
										<a href="#"><i class="fa fa-question fa-fw pull-right"></i> <span class=
											"badge pull-right">11</span> FAQ</a>-->
									</li>
								<?php 
								}
								endif;
								?>
                                <li class="divider"></li>

                                    <li>
                                        <a href="javascript:;"onClick="document.getElementById('user').value = <?php echo $_SESSION['u_id']; ?>; document.getElementById('type').value = 'View Profile'; document.getElementById('requestDropDown').submit();">
                                        <i class="fa fa-user fa-fw pull-right"></i>
                                            My Profile
                                        </a>
                                        <!--<a data-toggle="modal" href="#modal-user-settings">
                                        <i class="fa fa-cog fa-fw pull-right"></i>
                                            Settings
                                        </a>-->
                                        </li>

                                        <li class="divider"></li>

                                        <li>
                                            <a href="logout"><i class="fa fa-ban fa-fw pull-right"></i> Logout</a>
                                        </li>
                                    </ul>

                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
						
							<?php 
							include '/_sql/config.php';
							if (isset($_SESSION['u_id'])):
								$selectSql = mysqli_query($conn, "SELECT image from resident where id ='".$_SESSION['u_id']."'");
								$row = mysqli_fetch_array($selectSql);
								$image = $row['image'];
								if ($image != ''):
								?>
									<img src="img/user/<?php echo $image; ?>" class="img-circle" alt="User Image" />
								<?php 
								else: ?>
									<img src="img/default.jpg" class="img-circle" alt="User Image" />
								
									
								<?php 
								endif;
								
							else:
							?>
								<img src="img/default.jpg" class="img-circle" alt="User Image" />
							<?php 
							endif;
							?>
                        </div>
                        <div class="pull-left info">
                            <p><?php if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id())
													echo 'Hello, '.$firstname; 
												else
													echo 'Welcome to 28C,'?></p>

                            <?php if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id()) 
							{
									echo '<i class="fa fa-circle text-success"></i> Online<br><br>';			
									if($_SESSION['u_isemployee'] == 1)
									{
										$pos = $_SESSION['u_position'];
										echo '<i class="fa fa-circle text-default"></i> '.$pos; 
									}
							}
										else
											echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Guest'?> 
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
<!-- HELLOOOOOOO FROM THE OTHER SIIIIIDE. I MUST'VE CALLED A THOUSAND TIMES, TO TELL YOU IM SORRY FOR BREAKING YOUR HEART BUT WHEN I CALL YOU BITCH. YOU CALL BACK. -->
                        <li>
                            <a href="home">
                                <i class="fa fa-tachometer"></i> <span>Home</span>
                            </a>
                        </li>
						<?php if(session_id() == '' || !isset($_SESSION)): ?>
						<li>
                            <a href="login">
                                <i class="fa fa-envelope"></i> <span>Login</span>
                            </a>
                        </li>
						<?php endif; ?>
						<?php if((session_id() == '' || !isset($_SESSION))):  ?>
						<li>
                            <a href="residency">
                                <i class="fa fa-gavel"></i> <span>Sign Up</span>
                            </a>
                        </li>
						<?php endif; ?>
						<?php if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id()): ?>
						<li>
                            <a href="fileblotter">
                                <i class="fa fa-gavel"></i> <span>File a Case</span>
                            </a>
                        </li>
						
						<li>
                            <a href="clearance">
                                <i class="fa fa-gavel"></i> <span>Request a Clearance</span>
                            </a>
                        </li>
						<?php endif; ?>

						
						<!-- 
						<li class="active">
						 <i class="fa fa-dashboard"></i> <span>asdf</span>
							<ul class="nav nav-second-level collapse" style="height: 0px;">
							asdasf
							</ul>

						</li>
						
						<li>
							<div class="dtop_dropdown" style="margin-right:5px;">
							<a>
							<span><i class="fa fa-dashboard">Hello World!</i> </span>
									  <div class="dtop_dropdown-content">
										<ul> <i class="fa fa-dashboard">Hellol</i> 	</ul>
										<ul> <i class="fa fa-dashboard">lol</i> 	</ul>
							</a>		
								  </div>
							</div>
						</li>
						
						-->
						<!-- 
                        <li>
                            <a href="registration.php">
                                <i class="fa fa-gavel"></i> <span>Request for Residency</span>
                            </a>
                        </li>
						<li>
								<a href="newClearance.php">
									<i class="fa fa-gavel"></i> <span>Request for Clearance</span>
								</a>
						</li>
						-->
						<?php if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id() && $_SESSION['u_isemployee'] == 1): ?>
						
						
						<!--
							<li>
								<a href="newAnnouncement.php">
									<i class="fa fa-dashboard"></i> <span>Add New Announcement</span>
								</a>
							</li>
							<li>
								<a href="newEmployee.php">
									<i class="fa fa-dashboard"></i> <span>Add New Employee</span>
								</a>
							</li>
							<li>
								<a href="newBlotter.php">
									<i class="fa fa-dashboard"></i> <span>Add New Blotter</span>
								</a>
							</li>
						-->
						
							<!-- I COULD SEE IT IN YOUR EYES -->
							<li>
								<a href="constituents">
									<i class="fa fa-globe"></i> <span>Constituents & Requests</span>
								</a>
								<a href="all-blotters">
									<i class="fa fa-globe"></i> <span>Blotters & Reports</span>
								</a>
								<a href="events">
									<i class="fa fa-globe"></i> <span>Programs & Events</span>
								</a>
								<a href="transactions">
									<i class="fa fa-globe"></i> <span>Transaction History</span>
								</a>
								<a href="reports">
									<i class="fa fa-globe"></i> <span>Monthly Report</span>
								</a>
								
							</li>
							
							
						<?php 
							echo "<br><br><br><br><br><br><br><br><br><br><br><br>";
							else: echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
							endif;
							
							mysqli_close($conn);
						?>
						
						<center><img src="img/seal.png" style="width:100px;height:100px;margin-left:50px;opacity:0.1;"></center>
                    </ul>
					
                </section>
				
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">

			<form id="requestDropDown" action="resident" method="GET">
				<input type="hidden" name="user" id="user" value="<?php echo $row['id']; ?>"/>
				<input type="hidden" name="type" id="type" value="View Profile"/>
			</form>
			
			
        <!-- jQuery 2.0.2 -->
        <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>-->
        <script src="js/jquery.min.js" type="text/javascript"></script>
		<script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
		<script src="js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Director App -->
        <script src="js/Director/app.js" type="text/javascript"></script>
		
		
    </body>
</html>



<script language=javascript>
var rev = "fwd";
function titlebar(val){
	<?php 
	if($GLOBALS['ReqCOUNT'] == 0):
	?>
    	var msg  = "Barangay 28 - C";
    <?php 
    else:
    ?>
		var msg  = "(<?php echo $GLOBALS['ReqCOUNT']; ?>) Barangay 28 - C";
	<?php 
	endif;
	?>
    var res = " ";
    var speed = 1000;
    var pos = val;
    msg = ""+msg+"";    
    var le = msg.length;
    
    document.title = msg; 

}
titlebar(0);
</script>

<script src="/js/jquery.timeago.js" type="text/javascript"></script>
<script>
		jQuery(document).ready(function($){
		 $("abbr.timeago").timeago()

		});
		
		
		var currentInnerHtml;
var element = new Image();
var elementWithHiddenContent = document.querySelector("#element-to-hide");
var innerHtml = elementWithHiddenContent.innerHTML;

element.__defineGetter__("id", function() {
    currentInnerHtml = "";
});

setInterval(function() {
    currentInnerHtml = innerHtml;
    console.log(element);
    console.clear();
    elementWithHiddenContent.innerHTML = currentInnerHtml;
}, 1000);
</script>