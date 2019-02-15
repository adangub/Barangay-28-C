<?php

include('config/config1.php');

if(isset($_SESSION['username'])) {
	//header("location: Home.php");
	$message = "Login First!";
echo "<script type='text/javascript'>alert('$message');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.js"></script>
		<script src="js/smoothscroll.js"></script>
		
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Baptism Records</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/table.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body>
<div class="navbar-wrapper">
  <div class="container">
    <div class="navbar navbar-inverse navbar-static-top">
      
			
          <ul class="nav navbar-nav">
			<li><a href="Home.php">Home</a></li>
            <li><a href="About.php">About Us</a></li>
			<li><a href="Reservations.php">Reservations</a></li>
			
			<?php 
			//echo "<script type='text/javascript'>alert('".$_POST['userout']."');</script>";
			if(isset($_COOKIE['username']))
				if($_COOKIE['username'] == 'admin'){
				
					  echo "  <li class='dropdown'>
						  <a href='Sacraments.php' class='dropdown-toggle' data-toggle='dropdown'>Sacraments <b class='caret'></b></a>
						  <ul class='dropdown-menu'>
							<li><a href='Baptism.php'>Baptism</a></li>
							<li><a href='Confirmation.php'>Confirmation</a></li>
							<li><a href='checkMarriage.php'>Marriage</a></li>
						  </ul>
						</li>
						<li class='dropdown'>
						  <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Records <b class='caret'></b></a>
						  <ul class='dropdown-menu'>
							<li><a href='Baptism Records.php'>Baptism Records</a></li>
							<li><a href='Confirmation Records.php'>Confirmation Records</a></li>
							<li><a href='Marriage Records.php'>Marriage Records</a></li>
							<li><a href='Priest Records.php'>Priest Records</a></li>
						  </ul>
						</li>
						<li><a href='transaction.php'>Transactions</a></li>
						<li><a href='Reports.php'>Reports</a></li>";
				 }
					elseif($_COOKIE['username'] == 'secretary') {
						
						echo "  <li class='dropdown'>
						  <a href='Sacraments.php' class='dropdown-toggle' data-toggle='dropdown'>Sacraments <b class='caret'></b></a>
						  <ul class='dropdown-menu'>
							<li><a href='Baptism.php'>Baptism</a></li>
							<li><a href='Confirmation.php'>Confirmation</a></li>
							<li><a href='checkMarriage.php'>Marriage</a></li>
						  </ul>
						</li>
						<li class='dropdown'>
						  <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Records <b class='caret'></b></a>
						  <ul class='dropdown-menu'>
							<li><a href='Baptism Records.php'>Baptism Records</a></li>
							<li><a href='Confirmation Records.php'>Confirmation Records</a></li>
							<li><a href='Marriage Records.php'>Marriage Records</a></li>
							<li><a href='Priest Records.php'>Priest Records</a></li>
						  </ul>
						</li>
						<li><a href='transaction.php'>Transactions</a></li>
						<li><a href='Reports.php'>Reports</a></li>";
								
					}
					elseif ($_COOKIE['username'] == 'treasurer') {
						
						echo " <li><a href='transaction.php'>Transactions</a></li> ";
						
					}
					elseif ($_COOKIE['username'] == 'priest') {
						
						echo " <li><a href='Reports.php'>Reports</a></li>";
						
					}
					
			
			
			?>
			
			<!-- Login Stuff-->
			<?php
			//If no values, Username + Password + Login button are present; otherwise, no.
			if(!isset($_COOKIE['username'])&& !isset($_POST['userout'])&& !isset($_POST['passout'])){ ?>
				<li>
						<!-- your login link -->				
					<form id='login_form' name="login_form" class ='navbar-form navbar-right' method='POST' action="<?php echo $_SERVER["PHP_SELF"];?>">
						<div class='form-group'>
							<input type='text' class='form-control' name='userin' placeholder='Username' />
						</div>
					
						<div class='form-group'>
							<input type='password' class='form-control' name='passin' placeholder='Password' />
						</div>
					<input type='button' value='Log In' onClick="validateLogin()"/>
					</form>
					<form name="login_click" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
						<input type="hidden" name="userout" id="userout" value="">
						<input type="hidden" name="passout" id="passout" value="">
					</form>
				</li>
				
				<?php 
				} ?>
			
			
			<?php
			if(isset($_COOKIE['username'])){ ?>
				<li>
					<form name="log_out" method="post" class= 'navbar-form navbar-right' action="<?php $_SERVER['PHP_SELF']; ?>">
					<input type="submit" name="logout" id="logout" value="Log Out">
					</form>
				</li>
				<?php
			}
			
			if(isset($_POST['userout'])&&isset($_POST['passout'])){

				$username = $_POST['userout'];
				
				$password = $_POST['passout'];
					
				$selectSql=mysqli_query($conn,"SELECT * FROM user where username = '$username'and password = '$password'");
				if(mysqli_fetch_array($selectSql)<1){	
					header("Refresh: 2; url=Home.php");
					echo "Error Username or Password";
				}
				else{
					setcookie("username", $username, time() + 9000, '/');
					header("Refresh: 0; url=Home.php");
				}
			}
			if(isset($_POST['logout'])) {
				setcookie("username",'', time() + 0, '/');
				header("Refresh: 0; url=Home.php");
			}
			?>
			
          </ul>
        </div>

    </div>
  </div><!-- /container -->
</div><!-- /navbar wrapper -->


<!-- Carousel
================================================== -->
<div id="myCarousel" class="carousel slide" name="top" >
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="item active">
      <img src="pic/love.jpg" style="width:100%" class="img-responsive">
      <div class="container">
        <div class="carousel-caption">
          <h1>Baptism Records</h1>
          <p></p>
          <p><a class="btn btn-lg btn-primary" href="http://getbootstrap.com">Learn More</a>
        </p>
        </div>
      </div>
    </div>
    <div class="item">
      <img src="pic/whore.png" class="img-responsive">
      <div class="container">
        <div class="carousel-caption">
          <h1>Bootstrap 3 Website</h1>
          <p>This website has Bootstrap 3 still features a 12-column grid, but many of the CSS class names have completely changed.</p>
          <p><a class="btn btn-large btn-primary" href="#">Learn more</a></p>
        </div>
      </div>
    </div>
    <div class="item">
      <img src="http://placehold.it/1500X500" class="img-responsive">
      <div class="container">
        <div class="carousel-caption">
          <h1>Percentage-based sizing</h1>
          <p>With "mobile-first" there is now only one percentage-based grid.</p>
          <p><a class="btn btn-large btn-primary" href="#">Browse gallery</a></p>
        </div>
      </div>
    </div>
  </div>
  <!-- Controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="icon-prev"></span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="icon-next"></span>
  </a>  
</div>
<!-- /.carousel -->
	<center>
		<div class="right_col TableStyle" style="overflow-x:auto; width=100%" role="main">
			<table>
				<thead>
				  <tr>
					<th>ID</th>
					<th>Firstname</th>
					<th>Middlename</th>
					<th>Lastname</th>
					<!--
					<th>Household Head</th>
					<th>Household</th>
					<th>Civil Status</th>-->
					<th>Date</th>
					<!--
					<th>Birthplace</th>
					<th>CitizenShip</th>
					<th>Occupation</th>
					<th>Sponsor Female</th>
					<th>Sponsor Male</th>
					<th>Email</th>
					<th>Date of Seminar</th>-->
					<th>Time</th>
					<th>Status</th>
					<th></th>
					<th/>
				  </tr>
				</thead>
				
				
				<!--
				select * from parishioner INNER JOIN sacrament_received ON sacrament_received.Parishioner_idParishioner=parishioner.idParishioner INNER JOIN priest on priest.idPriest=sacrament_received.Priest_idPriest WHERE Sacrament_idSacrament = 1
				-->
				<div class = "title_center">
                                    <h2><small>All Records</small></h2>
									</div>
	
									
											
				<?php
								
					include('config/config1.php');
					$idReservation='';
					
					$res = mysqli_query($conn, "SELECT reservation.idReservation, parishioner.firstname, parishioner.middlename, parishioner.lastname, reservation.reservation_date, reservation.reservation_time, reservation.status FROM parishioner_has_reservation INNER JOIN reservation ON reservation.idReservation = parishioner_has_reservation.Reservation_idReservation INNER JOIN parishioner ON parishioner_has_reservation.Parishioner_idParishioner = parishioner.idParishioner WHERE reservation.status = 'Pending';;");
						echo mysqli_error($conn);
						
							  /****************************************/
							  /*SACRAMENT_RECEIVED SHOULD BE SPECIFIED*/
							  /*Para DILI MUGAWAS ANG RESULT SA LAIN  */
							  /*sacrament na naasign sa parishioner   */
							  /****************************************/
						
					?>	
					
					<tbody>
					<?php
					
					
					//UPDATE table_name SET column1=value, column2=value2,... WHERE some_column=some_value 
					//$declineBut = mysqli_query($conn, "UPDATE reservation set status ='Declined where 	")
					
						while($row = mysqli_fetch_array($res))
						{
					?>		
							<tr>
								<td><?php echo $row['idReservation']?></td>
								<td><?php echo $row['firstname'];?></td>
								<td><?php echo $row['middlename'];?></td>
								<td><?php echo $row['lastname'];?></td>
								<td><?php echo $row['reservation_date'];?></td>
								<td><?php echo $row['reservation_time'];?></td>
								<td><?php echo $row['status'];?></td>
								
								<?php  ?>
								<?php
				if(isset($_POST['updAddRes']))
				{		
						
						$id = $_POST['updAddRes'];
						 $stat1 = $_POST['status'];
					if(!mysqli_query($conn, "UPDATE reservation set status = '$stat1' where idReservation='34'"));
					{ 
						
						//header("Location: Home.php");
					}	
					
				}
					?>	
									<div class="item form-group">
									<td>
										<div>
											<label class="radio"><input type="radio" id="Approved" name="status" value="Approved">Approved</label>
											<label class="radio"><input type="radio" id="Decline" name="status" value="Decline">Decline</label>
										</div>
									</div>
									</td>
									
							
							<!-- for button -->
							<td>
							<div class="col-md-3 col-sm-3 col-xs-12 ">
						<form action='' method='POST'> 
								<input type="submit" name="updAddRes" class="btn btn-primary submits" value="Update" onClick="Home.php"></input>
						</form>
							</div>
									
					</td>
								
								
							</tr>
								
					
						<?php } ?>
				
								
												
				
					<?php	
		
				//}
					mysqli_close($conn);
					?>									
				
					</tbody>
		
			</table>
		
		</div>
	</center>

  <!-- /END THE FEATURETTES -->
  
<footer>
    <p class="pull-right"><a href="#top" class="smoothScroll">Back to top</a></p>
</footer>

	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="validation.js"></script>
	</body>
</html>