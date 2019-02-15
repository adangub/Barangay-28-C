<!DOCTYPE html>
<html>
    <head></head>
    <body>
	<?php
		include("dash-top.php");
		if(!isset($_COOKIE['ux'])&& !isset($_POST['userout'])&& !isset($_POST['passout'])){
	?>	
	
        <div class="col-lg-offset-4 col-lg-5" ><br><br>
			<section class="panel">
				<header class="panel-heading">
					Log In
				</header>
				<div class="panel-body">
					<form id='login_form' name="login_form" class="form-inline"  method="post" action='logging.php'><center>
						<div class="form-group">
							<label class="sr-only" for="exampleInputEmail2">Username</label>
							<input type="text" class="form-control"  id="userout" placeholder="Username" size=45 name='userout'>
						</div>
						<br><br>
						<div class="form-group">
							<label class="sr-only" for="exampleInputPassword2">Password</label>
							<input type="password" class="form-control" id="passout" placeholder="Password" size=45 name='passout'>
						</div>
						<br>
							<p class="help-block" style="color: red" id="InvalidCredentials" name="InvalidCredentials"></p>
						<br>
						<!--<div class="checkbox">
							<label>
								<input type="checkbox"> Remember me
							</label>
						</div>-->
						<button type="submit" id="login" class="btn btn-info">Log In</button>
						<br><br>
						<u style="text-decoration: underline; text-decoration-color: blue;"><a href="residency">Not a member yet? Sign Up</a></u>
					</form>
					
					<form name="login_click" method="post" action='logging.php'>
						<input type="hidden" name="userout" id="userout" value="">
						<input type="hidden" name="passout" id="passout" value="">
					</form>

				</div>
			</section>
		</div>
	<?php
		}		
		if(isset($_COOKIE['login'])){
			?><script> location.replace("home");</script><?php
		}
		include("dash-bot.php");
	?>

    </body>
</html>

<script>
	$("#InvalidCredentials").hide();
	$("#password").keyup(function(event){
		if(event.keyCode == 13){
			$("#login").click();
		}
	});	
	$("#username, #password").keyup(function(event){
			$("#InvalidCredentials").slideUp();
	});	
	
	
</script>


<script>
	$(function()
	{
		$("#login").click(function() 
		{
			$.ajax(
			{
				type: "POST",
				data: {
					username: $('#username').val(),
					password: $('#password').val(),
				},
				url: "/ajax/login.php",
				success: function(data)
				{
					var username = $('#username').val();
					var password = $('#password').val();
					var textOUT = "Username '";
					if(username != "")
					{
							if(data === "NO")
							{
								//$('#username').removeClass().addClass("has-error");
								textOUT = "Couldn't find your account. Try again.";
								document.getElementById("InvalidCredentials").innerHTML = textOUT;
								$("#InvalidCredentials").slideDown();
							}
							else if(data === "YES")
							{
								document.getElementById("userout").value=username;
								document.getElementById("passout").value=password;
								document.login_click.submit();
							}
							
					}
					else 
					{
							//$('#username').removeClass().addClass("has-error");
							document.getElementById("InvalidCredentials").innerHTML = "Invalid Credentials";
					}
					
				}
			})
		});
	});
</script>















<!--
function generateUniqueId($maxLength = null) {
    $entropy = '';

    // try ssl first
    if (function_exists('openssl_random_pseudo_bytes')) {
        $entropy = openssl_random_pseudo_bytes(64, $strong);
        // skip ssl since it wasn't using the strong algo
        if($strong !== true) {
            $entropy = '';
        }
    }

    // add some basic mt_rand/uniqid combo
    $entropy .= uniqid(mt_rand(), true);

    // try to read from the windows RNG
    if (class_exists('COM')) {
        try {
            $com = new COM('CAPICOM.Utilities.1');
            $entropy .= base64_decode($com->GetRandom(64, 0));
        } catch (Exception $ex) {
        }
    }

    // try to read from the unix RNG
    if (is_readable('/dev/urandom')) {
        $h = fopen('/dev/urandom', 'rb');
        $entropy .= fread($h, 64);
        fclose($h);
    }

    $hash = hash('whirlpool', $entropy);
    if ($maxLength) {
        return substr($hash, 0, $maxLength);
    }
    return $hash;
}
echo generateUniqueId(10);




http://blog.php-security.org/2010/05/09/mops-submission-04-generating-unpredictable-session-ids-and-hashes/index.html
-->