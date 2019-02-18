<!DOCTYPE html>

<html>
<?php
	include("dash-top.php"); 
	if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id()) 
	{
		include("/_sql/config.php");
		
		
		
?>
	<head>
		<meta charset="UTF-8">
	</head>
		
	<body>
<!-- ===================================================================== Content ===================================================================================-->
			<aside class="right-side">
                <!-- Main content -->
                <section class="content">
				
					<form name="blotRequest" id="blotRequest" method="POST" action="/success/newBlotter.php"> 
									<input type="hidden" id="empID" name="empID" value="<?php echo $_SESSION['u_employeeid']; ?>">
									<input type="hidden" id="userID" name="userID" value="<?php echo $_SESSION['u_id']; ?>">
									<input type="hidden" value="" id="cons1" name="cons1" value=""/>
									<input type="hidden" value="" id="res1" name="res1" value=""/>
									<input type="hidden" value="" id="NumberOfRespondents" name="NumberOfRespondents" value=""/>
									<input type="hidden" value="" id="addID" name="addID" value=""/>
									<input type="hidden" value="" id="addName" name="addName" value=""/>
									<input type="hidden" value="" id="blotDetails" name="blotDetails" value=""/>
									<input type="hidden" value="" id="blotType" name="blotType" value=""/>
									<input type="hidden" value="" id="complainantName" name="complainantName" value=""/>


					</form>
					
					<?php 
					$uID = $_SESSION['u_id'];
					$result = mysqli_query($conn, "SELECT GET_TOTALREQUESTSBYTYPE(id, 8) total, GET_TOTALVERIFIEDREQUESTS(id, 1, 1) residencyvalid, eligibility FROM resident WHERE id = '$uID';");
					$row = mysqli_fetch_array($result);
					$t_blotter = $row['total'];
					$t_el = $row['eligibility'];
					$t_validRes = $row['residencyvalid'];
					if(!$t_el)
						$t_el = 0;


					/**
					if($t_el == 0)
					{
						?>
						<div class="row">
							<center>
							You have a pending blotter request. 
							
							<form action = "" method = "GET" style="">
								<input type="hidden" value="<?php echo $_SESSION['u_id']; ?>" id="allblot" name="allblot">
								<i><h6><p class="help-block"> <button type="submit" class="hyperbutton" formaction="all-blotters" formmethod="GET" class="form-control-static"><?php echo "(Why am I seeing this?)"; ?></button><h6></p></i>
							</form>
							</center>
						</div>
						<?php 
					}
					elseif($t_validRes == 0 || $t_blotter > 0)
					{
						?>
						<div class="row">
							<center>
							You have a pending request. 
							
							<form action = "/resident#requests" method = "GET" style="">
								<input type="hidden" value="<?php echo $_SESSION['u_id']; ?>" id="user" name="user">
								<input type="hidden" value="View Profile" id="type" name="type">
								<i><h6><p class="help-block"> <button type="submit" class="hyperbutton" formaction="resident#requests" formmethod="GET" class="form-control-static">(Why am I seeing this?) </button><h6></p></i>
							</form>
							</center>
						</div>
						<?php 
					}
					
					else
					{**/
					?>
								
						<div class="row">
								
						
						
						
						
								<div class="col-lg-offset-3 col-lg-4" style="margin-left: 17%">
								<!--chat start-->
								<section class="panel">
										<header class="panel-heading">
											Complainant (Resident or Non-Resident)
										</header>
									<div>
										<form method="post" style="padding: 3% 3% 3% 3%; align: right;">
											<form id='login_form' name="login_form" class="form-inline" role="form">

											<div class="form-group" style="margin-bottom: 13px;">
											
											<form method="post" style="padding: 3% 3% 3% 3.2%; align: right;">
												<form id='login_form' name="login_form" class="form-inline" role="form">
												<br>
													<form id='login_form' name="login_form" class="form-inline" role="form">
														<div class="form-group">
															<label for="complainant1">Complainant (Required)</label>
															<?php 
															$isEmployee = isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id() && $_SESSION['u_isemployee'] == 1;
															?>
															<input type="text" class="form-control complainant1" id="complainant1" name='complainant1' placeholder="Search Name" value="<?php if(!$isEmployee) echo $_SESSION['u_fullname']; ?>" size=45 <?php if(!$isEmployee) echo "disabled"; ?>>
															
															<input type="hidden" id="complainantID" name='complainantID' value="<?php if(!$isEmployee) echo $_SESSION['u_id']; ?>">
															<div id="complainantResult"></div>
															<p class="help-block">Type the name if constituent is non-resident.</p>
														</div>
														
														<div class="form-group">
															<!-- TURN OFF AUTOFILL; CHROME -->
															<label for="disabledAdd">Complainant's Address</label>
															
															<input type="text" class="form-control search" id="disabledAdd" name="disabledAdd" placeholder="Address" value="<?php if(!$isEmployee) echo $_SESSION['u_address']; ?>" autocomplete="false" <?php if(!$isEmployee) echo "disabled"; ?>>
															
															<input type="hidden" value="<?php if(!$isEmployee) echo $_SESSION['u_addressid']; ?>" id="AddID" name='AddID'>
															<div id="result"></div>	
														</div>
														<?php if(isset($_COOKIE['ux']) && $_COOKIE['ux'] === session_id() && $_SESSION['u_isemployee'] != 1): ?>
														<button type="button" id="NotComplainant" value="" class="hyperbutton">I am not the complainant</button>
														<?php endif; ?>
														<br><br><br><br><br><br><br>
													</form>
												</form>
												
												
												
												
											</div>
											
											</form>
										</form>
									</div>
									</section>
								</div>
								
								<div class="col-lg-4">
								<!--chat start-->
										<section class="panel">
										<header class="panel-heading">
											Respondents (Must be Resident)
										</header>
									<div>
										<form method="post" style="padding: 2.7% 2.7% 2.7% 2.7%; align: right;">
											<form id='login_form' name="login_form" class="form-inline" role="form">
											<button class="remove_field_button btn btn-default" style="float:right;">-</button>
											<button class="add_field_button btn btn-default" style="float:right;">+</button>
											<br>
											<form id='login_form' name="login_form" class="form-inline" role="form">
												<label for="respondent1">Respondent 1 (Required)</label>
												<div class="input_fields_wrap">
													
													<input type="text" class="form-control respondent1" id="respondent1" name='mytext[]' placeholder="Search Name" size=45 autocomplete=off >
													<input type="hidden" value="" id="respondent1ID" name="respondent1ID">
													<p id="warning1" style="color:red; display:none;">Please fill up before adding another.</p>
													<div id="respondent1Result"></div>
													
												</div> 
											
											
											<form id='login_form' name="login_form" class="form-inline">
											
										</form>
										</form>
										
										
										
										
										<!-- <label for="respondent1">Respondent 1 (Required)</label>
											<div class="input_fields_wrap">
												
												<input type="text" class="form-control respondent1" id="respondent1" name='mytext[]' placeholder="Search Name" size=45 >
												<input type="hidden" value="" id="respondent1ID" name="respondent1ID">
												<div id="respondent1Result">
												
											</div> -->
										
										
										
										
										
										
										
									</div>
									</section>
									

								</div>
						</div>
						<div class="root">
							<div class="col-lg-offset-2 col-lg-7" style="margin-left: 22%; width: 63.3%;">
								
								<section class="panel">
									<header class="panel-heading">
										Blotter Information
									</header>
									
									<div class="panel-body">
										<div class="col-lg-11">
											
											
										</div>
									</div>
									
									
									
									
									<div class="panel-body">
										<div class="form-group">
											<div class="col-lg-3">	
											<label for="birthdate">Type of Blotter</label>
												<select class="form-control m-b-10" id="blotterType">
													<option>-</option>
													<?php 
														$result = mysqli_query($conn, "SELECT complaint_name FROM complaint_type ORDER BY complaint_name ASC;");
														while($row=mysqli_fetch_array($result))
														{
															?>
															
															<option><?php echo $row['complaint_name']; ?></option>
															
															<?php 
														}
													
														
													?>
													
												</select>
											</div>
										</div>
									</div>
						
									<div class="panel-body">
										<div class="col-lg-3">
										<label for="birthdate">Blotter Details</label>
										<form id='login_form' name="login_form" class="form-inline" role="form"><center>
											<div class="form-group">
												<textarea name="textarea" id="textarea" rows=5 cols=80 maxlength="2000"></textarea> 
												<div style="text-align:right;" id="textarea_feedback"></div>
												
											</div>
										</div>
									</div>
									
									
									
									
									<input type="hidden" name="numberOfRespondents" id="numberOfRespondents" value="1"/>
									<center><button  type="button" id="newBlot" name="newBlot" class="btn btn-danger" onClick="newBlotter()">Publish Blotter</button><br></center>
									<br>
									<br>	
								</section>
							</div>
							
							
						</div>
					
					<?php 
					//}
					mysqli_close($conn);
					?>
					
				</section>
			</aside>
		
		<?php include("dash-bot.php"); ?>
	</body>
	
</html>












<script type="text/javascript">


var text_max = 2000;
$('#textarea_feedback').html(text_max + ' characters remaining');

$('#textarea').keyup(function() {
	var text_length = $('#textarea').val().length;
	var text_remaining = text_max - text_length;

	$('#textarea_feedback').html(text_remaining + ' characters remaining');
});


var max_fields = 10;
var wrapper = $(".input_fields_wrap"); 
var add_button = $(".add_field_button");
var remove_button = $(".remove_field_button");

var x = 1; //initlal text box count

$(remove_button).click(function(e)
{
	e.preventDefault();
	if(x > 1)
	{
		$('.respondentsClass').slice(-1).remove(); //Remove from div
		$('.allformres').slice(-1).remove(); //Remove from form
		x--;
		$('#numberOfRespondents').val(x); 
	}
});
$(add_button).click(function(e)
{ //on add input button click
	e.preventDefault();
	if(($('#respondent1ID').val()))
	{
		if(($('#res'+x+'').val()) || x == 1)
		{
			if(x < max_fields)
			{ //max input box allowed
				x++; //text box increment
				$(wrapper).append('<div id="divres'+x+'" class="respondentsClass"><br><label for="respondent1">Respondent '+x+'</label><input type="text" class="form-control respondent'+x+'" id="respondent'+x+'" name="respondent'+x+'" placeholder="Search Name" size=45 ><p id="warning'+x+'" style="color:red; display:none;">Please fill up before adding another.</p><div id="respondent'+x+'Result"></div></div>').hide().show('slow'); //add input box
				$('#blotRequest').append('<input type="hidden" value="" id="res'+x+'" name="res'+x+'" class="allformres" value=""/>');
				$('#numberOfRespondents').val(x); //Update to JS
			}
			
			
			$(".respondent"+x+"").keyup(function() 
			{ 
			$('#warning'+x+'').slideUp();
			var searchid = $(this).val();
			var dataString = 'person='+ searchid;
			if(searchid!='')
			{
				
				$.ajax
				({
					type: "POST",
					url: "ajax/ac_blotter.php",
					data: dataString,
					cache: false,
					success: function(html)
					{
						$("#respondent"+x+"Result").html(html).slideDown();
					}
				});
			}return false;    
			});
			
			jQuery("#respondent"+x+"Result").on("click", function(e)
			{
				$name = $('span.returnName',this).html(); 
				$name = $("<div/>").html($name).text().toString();
				$id = $('span.returnID',this).html(); 
				$id = $("<div/>").html($id).text().toString();
				$('#res'+x+'').val($id);
				$('#respondent'+x+'').val($name); //Cool 
			});
			
			jQuery(document).on("click", function(e) 
			{ 
				var $clicked = $(e.target);
				if (! $clicked.hasClass("respondent"+x+"")){
				jQuery("#respondent"+x+"Result").slideUp(); 
				}
			});
			$('#respondent'+x+'').click(function()
			{
				jQuery("#respondent"+x+"Result").slideUp();
			});
		}
		else $('#warning'+x+'').slideDown();
	}
	else $('#warning'+x+'').slideDown();
});

/*$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    e.preventDefault(); $(this).parent('div').remove(); x--;
	$('#numberOfRespondents').val(x); //Update to JS
})*/


$(function()
{
	$('#complainantResult').hide();
	$('#respondent1Result').hide();
	
	
	
	$("#disabledAdd").keyup(function()
	{
		$('#AddID').val("");
		$('#complainantID').val("");
	});
	//COMPLAINANT1
	$(".complainant1").keyup(function() 
	{ 
	$('#complainantID').val("");
	$('#AddID').val("");
	$('#disabledAdd').removeAttr('disabled'); //delete attributed disabled while typing
	$('#disabledAdd').val(""); //Reset Address field
	var searchid = $(this).val();
	var dataString = 'person='+ searchid;
	if(searchid!='')
	{
		
		$.ajax
		({
			type: "POST",
			url: "ajax/ac_blotter.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#complainantResult").html(html).slideDown();
			}
		});
	}return false;    
	});
	
	jQuery("#complainantResult").on("click", function(e)
	{
		$name = $('span.returnName',this).html(); 
		$name = $("<div/>").html($name).text().toString();
		$id = $('span.returnID',this).html(); 
		$id = $("<div/>").html($id).text().toString();
		$add = $('span.returnADD',this).html(); 
		$add = $("<div/>").html($add).text().toString();
		$addID = $('span.returnADDID',this).html(); 
		$addID = $("<div/>").html($addID).text().toString();
		$('#complainantID').val($id);
		$('#complainant1').val($name); //Cool 
		$('#AddID').val($addID);
		$('#disabledAdd').val($add);
		$('#disabledAdd').attr('disabled', 'disabled'); //add attribute disabled="disabled" to address field
		
	});
	
	jQuery(document).on("click", function(e) 
	{ 
		var $clicked = $(e.target);
		if (! $clicked.hasClass("complainant1")){
		jQuery("#complainantResult").slideUp(); 
		}
	});
	$('#complainant1').click(function()
	{
		jQuery("#complainantResult").slideUp();
	});
	
	
	
	
	
	
	//RESPONDENT1
	$(".respondent1").keyup(function() 
	{ 
	$('#warning'+x+'').slideUp();
	var searchid = $(this).val();
	var dataString = 'person='+ searchid;
	if(searchid!='')
	{
		
		$.ajax
		({
			type: "POST",
			url: "ajax/ac_blotter.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#respondent1Result").html(html).slideDown();
			}
		});
	}return false;    
	});
	
	jQuery("#respondent1Result").on("click", function(e)
	{
		$name = $('span.returnName',this).html(); 
		$name = $("<div/>").html($name).text().toString();
		$id = $('span.returnID',this).html(); 
		$id = $("<div/>").html($id).text().toString();
		$('#respondent1ID').val($id);
		$('#respondent1').val($name); //Cool 
	});
	
	jQuery(document).on("click", function(e) 
	{ 
		var $clicked = $(e.target);
		if (! $clicked.hasClass("respondent1")){
		jQuery("#respondent1Result").slideUp(); 
		}
	});
	$('#respondent1').click(function()
	{
		jQuery("#respondent1Result").slideUp();
	});
	
	$('#NotComplainant').click(function()
	{
		$('#complainant1').removeAttr( "disabled" );
		$('#disabledAdd').removeAttr( "disabled" );
		$('#complainant1').val("");
		$('#disabledAdd').val("");
		$('#NotComplainant').fadeOut();
	});
	
	
	
	
	

});


		
</script>
<?php 
	}
?>