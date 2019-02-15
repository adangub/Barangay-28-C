

function Registration()
{
		
	//GETTING VALUES FROM INPUT TYPE TEXT
	var fname = document.RegistrationInformation.firstname.value;
	var lname = document.RegistrationInformation.lastname.value;
	var midname = document.RegistrationInformation.midname.value;
	var birthplace = document.RegistrationInformation.birthplace.value;
	var address = document.RegistrationInformation.address.value;
	var personalincome = document.RegistrationInformation.personalincome.value;
	var phone = document.RegistrationInformation.phone.value;
	var email = document.RegistrationInformation.email.value;
	var username = document.RegistrationInformation.username.value;
	var securepass = document.RegistrationInformation.securepass.value;
	var securepassconf = document.RegistrationInformation.securepassconf.value;
	var errorInUser = document.RegistrationInformation.errorInUsername.value;
	
	
	//GETTING VALUES FROM DROP DOWN MENU
	var x = document.getElementById("gender");
	var gender = String(x.options[x.selectedIndex].value);
	
	var x = document.getElementById("precinct");
	var precinct = String(x.options[x.selectedIndex].value);

	
	var x = document.getElementById("height");
	var height = String(x.options[x.selectedIndex].value);
	
	var x = document.getElementById("month");
	var birth_month_conv = String(x.options[x.selectedIndex].value);
	var birth_month = 0;
	
		switch(birth_month_conv)
		{
			case 'Jan': birth_month = 1; break;
			case 'Feb': birth_month = 2; break;
			case 'Mar': birth_month = 3; break;
			case 'Apr': birth_month = 4; break;
			case 'May': birth_month = 5; break;
			case 'Jun': birth_month = 6; break;
			case 'Jul': birth_month = 7; break;
			case 'Aug': birth_month = 8; break;
			case 'Sep': birth_month = 9; break;
			case 'Oct': birth_month = 10; break;
			case 'Nov': birth_month = 11; break;
			case 'Dec': birth_month = 12; break;
			default: birth_month=-1; break;
		}
	
	var x = document.getElementById("day");
	var birth_day = String(x.options[x.selectedIndex].value);
	
	var x = document.getElementById("year");
	var birth_year = String(x.options[x.selectedIndex].value);
		
	var birthdate = birth_year.concat("-").concat(birth_month).concat("-").concat(birth_day);
	var x = document.getElementById("weight");
	var weight = String(x.options[x.selectedIndex].value);
	
	//GETTING VALUES FROM RADIO BUTTONS
	var relationship = "";
	if(document.getElementById('single').checked)
		relationship = String("Single");
	else if(document.getElementById('married').checked)
		relationship = String("Married");
	else if(document.getElementById('divorced').checked)
		relationship = String("Divorced");
		
	
		
		
		
		
		
		
		
		
	//POPULATING A TABLE WITH MYSQL DATA http://stackoverflow.com/questions/3050558/create-table-with-php-and-populate-from-mysql
	//NOTICE CHANGE MWB's HEIGHT TO VARCHAR8 && PRECINCTNO TO VARCHAR20 && Gender to VARCHAR10 && CONTACT TO VARCHAR128
	
	var emptyError = "The following values cannot be empty: ";
	if(fname.length == "")
		emptyError = emptyError.concat("First Name, ");
	if(lname == "")
		emptyError = emptyError.concat("Last Name, ");
	if(midname == "")
		emptyError = emptyError.concat("Middle Name, ");
	if(birth_month == -1 && birth_day == "Day" && birth_year == "Year")
		emptyError = emptyError.concat("Birth Date, ");
	if(birthplace == "")
		emptyError = emptyError.concat("Birth Place, ");
	if(address == "")
		emptyError = emptyError.concat("Address, ");
	if(weight == "")
		emptyError = emptyError.concat("Weight, ");
	if(height == "Height")
		emptyError = emptyError.concat("Height, ");
	if(personalincome == "")
		emptyError = emptyError.concat("Personal Income, ");
	if(phone == "")
		emptyError = emptyError.concat("Cell Number, ");
	if(email == "")
		emptyError = emptyError.concat("Email, ");
	if(username == "")
		emptyError = emptyError.concat("Username, ");
	if(securepass == "")
		emptyError = emptyError.concat("Password, ");
	if(securepassconf == "")
		emptyError = emptyError.concat("Confirm Password, ");
	
	var dependent = 1;
	if(personalincome != "0")
		dependent = 0;
	
	if (emptyError.length > 38)
		alert(emptyError);
	
	else if(emptyError.length == 38)
	{
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))
		{	
			if(username.length > 3)
			{
				if(errorInUser == "0")
				{
					if(securepass == securepassconf)
					{
						if(securepass.length >= 8)
						{
							document.validatedform.validatedfname.value = fname;
							document.validatedform.validatedlname.value = lname;
							document.validatedform.validatedmname.value = midname;
							document.validatedform.validatedBirthdate.value = birthdate;
							document.validatedform.validatedBirthplace.value = birthplace;
							document.validatedform.validatedAddress.value = address;
							document.validatedform.validatedWeight.value = weight;
							document.validatedform.validatedPersonalincome.value = personalincome;
							document.validatedform.validatedPhone.value = phone;
							document.validatedform.validatedEmail.value = email;
							document.validatedform.validatedUsername.value = username;
							document.validatedform.validatedSecurepass.value = securepass;
							document.validatedform.validatedGender.value = gender;
							document.validatedform.validatedPrecinct.value = precinct;
							document.validatedform.validatedHeight.value = height;
							document.validatedform.validatedRelationship.value = relationship;
							document.validatedform.validatedDependency.value = dependent;
							
							document.validatedform.noredflags.value = "SET";
							document.validatedform.submit();
						}
						else alert("Please enter a valid password")
					}
					else alert("Please enter the same password twice");
				}
				else alert("Username error");
			}
			else alert("Please enter a valid username");
				
		}
		else alert("Please enter a valid email address");
	}
}

function Edit()
{
		
	//GETTING VALUES FROM INPUT TYPE TEXT
	var addressNAME = document.EditInformation.address.value;
	var addressID = document.EditInformation.addID.value;
	var personalincome = document.EditInformation.personalincome.value;
	var phone = document.EditInformation.phone.value;
	var email = document.EditInformation.email.value;
	var pass = document.EditInformation.password.value;
	var passwordConfirm = document.EditInformation.passwordConfirm.value;
	var clickedPass = document.EditInformation.newPass.value;
	var passMatch = 1;
	
	//GETTING VALUES FROM DROP DOWN MENU
	var x = document.getElementById("precinct");
	var precinct = String(x.options[x.selectedIndex].value);
	
	var x = document.getElementById("height");
	var height = String(x.options[x.selectedIndex].value);
	
	var x = document.getElementById("weight");
	var weight = String(x.options[x.selectedIndex].value);
	
	var x = document.getElementById("employee");
	var employee = String(x.options[x.selectedIndex].value);
	
	var x = document.getElementById("mothers");
	var mother = String(x.options[x.selectedIndex].id);
	
	var x = document.getElementById("fathers");
	var father = String(x.options[x.selectedIndex].id);
	
	var x = document.getElementById("guardians");
	var guardian = String(x.options[x.selectedIndex].id);
	
	
	
	//GETTING VALUES FROM RADIO BUTTONS
	var relationship = "";
	if(document.getElementById('single').checked)
		relationship = String("Single");
	else if(document.getElementById('married').checked)
		relationship = String("Married");
	else if(document.getElementById('divorced').checked)
		relationship = String("Divorced");

		
	//POPULATING A TABLE WITH MYSQL DATA http://stackoverflow.com/questions/3050558/create-table-with-php-and-populate-from-mysql
	//NOTICE CHANGE MWB's HEIGHT TO VARCHAR8 && PRECINCTNO TO VARCHAR20 && Gender to VARCHAR10 && CONTACT TO VARCHAR128
	
	var emptyError = "The following values cannot be empty: ";
	if(addressNAME == "")
		emptyError = emptyError.concat("Address, ");
	if(personalincome == "")
		emptyError = emptyError.concat("Personal Income, ");
	if(phone == "")
		emptyError = emptyError.concat("Cell Number, ");
	if(email == "")
		emptyError = emptyError.concat("Email, ");
	
	
	var dependent = 0;


	if(clickedPass != "")
	{
		if(passwordConfirm != pass)
		{
			alert("Passwords doesn't match!");
			passMatch = 0;
		}

	}

	if(personalincome == 0)
		dependent = 1;
		
	if (emptyError.length > 38)
		alert(emptyError);
	else if(emptyError.length == 38)
	{
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))
		{	
			if(addressID != "")
			{
				if((clickedPass == "1" && passMatch == 1) || clickedPass == "")
				{
					document.editform.validatedAddress.value = addressID;
					document.editform.validatedWeight.value = weight;
					document.editform.validatedPersonalincome.value = personalincome;
					document.editform.validatedPhone.value = phone;
					document.editform.validatedEmail.value = email;
					document.editform.validatedPrecinct.value = precinct;
					document.editform.validatedHeight.value = height;
					document.editform.validatedRelationship.value = relationship;
					document.editform.validatedDependency.value = dependent;
					document.editform.validatedPass.value = pass;
					document.editform.position.value = employee;
					document.editform.validatedMother.value = mother;
					document.editform.validatedFather.value = father;
					document.editform.validatedGuardian.value = guardian;
					
					document.editform.noredflags.value = "SET";
					document.editform.submit();			
				}
			}
			else alert("Address should exist!");
		}
		else alert("Please enter a valid email address");
	}
	
}


function ViewProfile(buttonRequestID) //BUTTON FROM membersList
{
	document.submitRequest.user.value = buttonRequestID;
	document.submitRequest.type.value = "View Profile";
	document.submitRequest.submit();
}


function ViewBlotter(buttonRequestID) //BUTTON FROM membersList
{
	document.submitRequest.user.value = buttonRequestID;
	document.submitRequest.type.value = "View Blotter";
	document.submitRequest.submit();
}


function SortMembersList()
{
	var x = document.getElementById("sortmemberslist");
	var sortby = String(x.options[x.selectedIndex].value);
	var sortbySYNTAX = "NULL";
	var error = 0;
	
	if(sortby == "-- Sort By --") { alert("Please choose sorting type"); error=1; };
	
	switch(sortby)
	{
		case "New Requests (Ascending)": sortbySYNTAX = "ORDER BY pending ASC"; break;
		case "New Requests (Descending)": sortbySYNTAX = "ORDER BY pending DESC"; break;
		case "Name (Ascending)": sortbySYNTAX = "ORDER BY family_name ASC, first_name ASC, middle_name ASC"; break;
		case "Name (Descending)": sortbySYNTAX = "ORDER BY family_name DESC, first_name DESC, middle_name DESC"; break;
		case "Gender (Ascending)": sortbySYNTAX = "ORDER BY gender ASC"; break;
		case "Gender (Descending)": sortbySYNTAX = "ORDER BY gender DESC"; break;
		case "Age (Ascending)": sortbySYNTAX = "ORDER BY birth_date ASC"; break;
		case "Age (Descending)": sortbySYNTAX = "ORDER BY birth_date DESC"; break;
		case "Hometown (Ascending)": sortbySYNTAX = "ORDER BY birth_place ASC"; break;
		case "Hometown (Descending)": sortbySYNTAX = "ORDER BY birth_place DESC"; break;
		case "Current Address (Ascending)": sortbySYNTAX = "ORDER BY address ASC"; break;
		case "Current Address (Descending)": sortbySYNTAX = "ORDER BY address DESC"; break;
		default: sortbySYNTAX = "ORDER BY family_name ASC, first_name ASC, middle_name ASC"; break;
	}
	
	if(error == 0)
	{
		document.membersListSORT.sortType.value = sortbySYNTAX;
		document.membersListSORT.sortTypeSTOCK.value = sortby;
		document.membersListSORT.submit();
	}
}


function SearchUser() //SEARCHING FOR memberlist.php and requestPending.php
{
	var x = document.getElementById("searchedname").value;
	
	if(x != "")
	{	
		document.membersListSEARCH.nameSearched.value = x;
		document.membersListSEARCH.submit();
	}
	else alert("Search box cannot be empty");
}

function printTransaction(userID, reqType)
{	
	document.printTrans.requestID.value = userID;
	document.printTrans.transactionType.value = reqType;
	document.printTrans.submit();
}

function print(type)
{
	if(type=='Barangay Clearance Request' || type=='Police Clearance Request' || type=='NBI Clearance Request'){ 
	var ctcno = document.ctc.ctcno.value;
	var ctcday = document.ctc.ctcday.value;
	var ctcmonth = document.ctc.ctcmonth.value;
	var ctcyear = document.ctc.ctcyear.value;
	
	
	if(ctcno =='')
		ctcno = '__________';
	
	if(ctcday =='Day' || ctcyear =='Year' || ctcmonth =='Month')
		alert('Invalid CTC date');
	else{
		
		switch(ctcmonth)
		{
			case 'Jan': ctcmonth = '01'; break;
			case 'Feb': ctcmonth = '02'; break;
			case 'Mar': ctcmonth = '03'; break;
			case 'Apr': ctcmonth = '04'; break;
			case 'May': ctcmonth = '05'; break;
			case 'Jun': ctcmonth = '06'; break;
			case 'Jul': ctcmonth = '07'; break;
			case 'Aug': ctcmonth = '08'; break;
			case 'Sep': ctcmonth = '09'; break;
			case 'Oct': ctcmonth = '10'; break;
			case 'Nov': ctcmonth = '11'; break;
			case 'Dec': ctcmonth = '12'; break;
			default: ctcmonth=-1; break;
		}
		
		
		var ctcdate = ctcyear+'-'+ctcmonth+'-'+ctcday;
		document.printing.ctcno.value = ctcno;
		document.printing.ctcdate.value = ctcdate;
		document.printing.submit();
	}
	}
	else{
		var ctcno = document.ctc.ctcno.value;
		var ctcdate = document.ctc.ctcdate.value;
		
		if(ctcno =='')
			ctcno = '__________';
		
		if(ctcdate =='')
			ctcdate = '_______';
		
		document.printing.ctcno.value = ctcno;
		document.printing.ctcdate.value = ctcdate;
		document.printing.submit();
	}
}


function editProfile(userID)
{
	document.editForm.submit();
}





function TransactionSuccess(apprden)
{
	var amount = document.getElementById("amountPaid").value;
	var requestID = document.getElementById("requestID").value;
	var transactionType = document.getElementById("transactionType").value;
	var transResidentID = document.getElementById("transResidentID").value;
	var comment = document.getElementById("optionalComment").value;
	
	
	switch(transactionType)
	{
		case "Residency Request": { transactionType = 1; break; } 
		case "Barangay Clearance Request": { transactionType = 2; break; }
		case "Police Clearance Request": { transactionType = 3; break; }
		case "NBI Clearance Request": { transactionType = 4; break; }
		case "Blotter Complaint": { transactionType = 5; break; }
		case "Profile Edit Request": { transactionType = 7; break; }
		case "Blotter Request": { transactionType = 8; break; }
		default: transactionType = 6;
	}
	
	
	if(amount < 0 || amount > 100000 || amount == "")
		alert("Invalid Amount (0-100000)");
	
	else
	{
		if(!/[~`!#$%\^&*+=\-\[\]\\';,.@*()/{}|\\":<>\?a-zA-Z]/g.test(amount))
		{
			if(comment.length <= 60)
			{
				if(apprden == 1)
				{
					document.transactionRequestSuccess.rID.value = requestID;
					document.transactionRequestSuccess.amount.value = amount;
					document.transactionRequestSuccess.tType.value = transactionType;
					document.transactionRequestSuccess.tRID.value = transResidentID;
					document.transactionRequestSuccess.optionalComment.value = comment;
					document.transactionRequestSuccess.submit();
				}
				else
				{
					document.denySuccess.requestID.value = requestID;
					document.denySuccess.transactionType.value = transactionType;
					document.denySuccess.transResidentID.value = transResidentID;
					document.denySuccess.optionalReason.value = comment;
					document.denySuccess.submit();
				}
			}
			else alert("Comment length exceeded");
		}
		else alert("Invalid Amount");
	}
	
	
}


function DenySuccess()
{
	var RID = document.getElementById("requestID").value;
	var TRID = document.getElementById("transResidentID").value;
	var COMMENT = document.getElementById("optionalReason").value;
	var TRTYPE = document.getElementById("transactionType").value;
	
	document.denySuccess.requestID.value = RID;
	document.denySuccess.transactionType.value = TRTYPE;
	document.denySuccess.transResidentID.value = TRID;
	document.denySuccess.optionalReason.value = COMMENT;
	document.denySuccess.submit();
	
}




function newAnnouncement()
{
	var content = document.getElementById("announcement").value;
	var x = document.getElementById("priority");
	var priority = String(x.options[x.selectedIndex].value);
	
	var priorityInNum = 0;
	if(priority == "High Priority")
		priorityInNum = 1;
	
	if(!/[~`%\^&*+=\-\[\]\\';*/{}|\\":<>]/g.test(content))
	{
		if(content.length >= 10)
		{
			document.postAnnouncement.ann_content.value = content;
			document.postAnnouncement.ann_priority.value = priorityInNum;
			document.postAnnouncement.submit();
		}
		else alert("Announcement length cannot be less than 10 characters.");
	}
	else alert("Announcement cannot contain weird symbols.");
}

function newEmployee()
{
	var empid = document.getElementById("userID").value;
	var x = document.getElementById("position");
	var position = String(x.options[x.selectedIndex].value);
	
	if(empid != "")
	{
		document.employeeRequest.toBeEMPid.value = empid;
		document.employeeRequest.empPos.value = position;
		document.employeeRequest.submit();
	}
	else alert("Name cannot be blank");
}

function newClearance()
{
	var clearanceType = 0;
	if(document.getElementById('brgy').checked)
		clearanceType = 2;
	else if(document.getElementById('police').checked)
		clearanceType = 3;
	else if(document.getElementById('nbi').checked)
		clearanceType = 4;
	
	if(clearanceType == 0)
		alert("Please select a clearance type.");
	else
	{
		document.clearanceRequest.cType.value = clearanceType;
		document.clearanceRequest.submit();
	}

}


function newBlotter()
{
	var complainantID = document.getElementById("complainantID").value;
	var complainantName = document.getElementById("complainant1").value;
	var respondent1ID = document.getElementById("respondent1ID").value;
	var numberOfRespondents = parseInt(document.getElementById("numberOfRespondents").value);
	var addName = document.getElementById("disabledAdd").value;
	var addID = document.getElementById("AddID").value;
	var blotterDetails = document.getElementById("textarea").value;
	
	var x = document.getElementById("blotterType");
	var blotterType = String(x.options[x.selectedIndex].value);
	var Respondents = new Array(numberOfRespondents);
	Respondents[1] = respondent1ID;
	var isSame = "";
	var isEmpty = "";
	
	
	for(var i = 2; i <= numberOfRespondents; i++)
	{
		isSame = "";
		var cursor = document.getElementById("res"+i+"").value;
		if(cursor != "")
		{
			if(jQuery.inArray(cursor, Respondents, 1) == -1)
				Respondents[i] = cursor;
			else isSame = "COLLISION";
		}
		else isEmpty = "EMPTY";
	}
	
	if(jQuery.inArray(complainantID, Respondents, 1) != -1)
		isSame = "COLLISION";
	
	
	if(addName != "")
	{
		if(respondent1ID)
		{
			if(isEmpty == "")
			{
				if(isSame == "")
				{
					if(blotterType != "-")
					{
						if(blotterDetails.length >= 1)
						{
							document.blotRequest.cons1.value = complainantID;
							document.blotRequest.res1.value = respondent1ID;
							document.blotRequest.addID.value = addID;
							document.blotRequest.addName.value = addName;
							document.blotRequest.blotDetails.value = blotterDetails;
							document.blotRequest.blotType.value = blotterType;
							document.blotRequest.NumberOfRespondents.value = numberOfRespondents;
							document.blotRequest.complainantName.value = complainantName;
							document.blotRequest.submit();
						}
						else alert("The details of the blotter is required");
					}
					else alert("Please choose a blotter type");
				}
				else alert("No two complainants/respondents should be the same");
			}
			else alert("Extra respondent field should be removed if not in use");
		}
		else alert("At least one respondent field should be filled up");
	}
	else alert("Address cannot be empty");
		
}

function NewHearing()
{
	var hearings = document.getElementById("hearings").value;
	var conflict = document.getElementById("conflictError").value;
	var lp1;
	var lp2;
	var timeError = 0;
	
	
	var x = document.getElementById("month");
	var month = String(x.options[x.selectedIndex].value);
	
	var x = document.getElementById("day");
	var day = String(x.options[x.selectedIndex].value);
	
	var x = document.getElementById("year");
	var year = String(x.options[x.selectedIndex].value);
	
	var x = document.getElementById("start");
	var start = String(x.options[x.selectedIndex].value);
	
	var x = document.getElementById("end");
	var end = String(x.options[x.selectedIndex].value);
	
	if(hearings >= 3)
	{

		var x = document.getElementById("lupong1");
		lp1 = x.options[x.selectedIndex].getAttribute('name');
		var x = document.getElementById("lupong2");
		lp2 = x.options[x.selectedIndex].getAttribute('name');
		
		
		
	}
	
	switch(month)
	{
		case 'Jan': month = 1; break;
		case 'Feb': month = 2; break;
		case 'Mar': month = 3; break;
		case 'Apr': month = 4; break;
		case 'May': month = 5; break;
		case 'Jun': month = 6; break;
		case 'Jul': month = 7; break;
		case 'Aug': month = 8; break;
		case 'Sep': month = 9; break;
		case 'Oct': month = 10; break;
		case 'Nov': month = 11; break;
		case 'Dec': month = 12; break;
		default: month=-1; break;
	}
	
	month = month.toString();
	var date = year.concat("-");
	date = date.concat(month);
	date = date.concat("-");
	date = date.concat(day);
	
	if(start != "-")
		start = convert12to24(start);
	else timeError = 1;
	if(end != "-")
		end = convert12to24(end);
	else timeError = 1;
	
	if(month != -1)
	{
		if(timeError == 0)
		{
			if(start != end)
			{
				if(conflict == "0")
				{
					if(hearings < 3)
					{
						document.newSchedule.startT.value = start;
						document.newSchedule.endT.value = end;
						document.newSchedule.scheduleD.value = date;
						document.newSchedule.submit();
					}
					else
					{
						if(lp1 != lp2)
						{
							document.newSchedule.lupong1.value = lp1;
							document.newSchedule.lupong2.value = lp2;
							document.newSchedule.startT.value = start;
							document.newSchedule.endT.value = end;
							document.newSchedule.scheduleD.value = date;
							document.newSchedule.submit();
						}
						else alert("No two lupongs should be the same");
					}
				}
				else alert("Conflict error");
			}
			else alert("Start and End time cannot be the same");
		}
		else alert("Please select a valid time");
	}
	else alert("Date cannot be empty");
	
}

function convert12to24(time)
{
	var elems = time.split(' ');
	var ampm = elems[1];
	var hrmm = elems[0].split(':');
	var hr = parseInt(hrmm[0]);
	var mm = hrmm[1];
	
	
	
	if(ampm == "PM" && hr != 12)
		hr = hr+12;
	if(ampm == "AM" && hr == 12)
		hr = "00";
	
	
	var output = hr+":"+mm;
	return output;
}


//Angub pls change

function AddExpense()
{
	var expenseName = document.getElementById("name").value;
	var amount = document.getElementById("amount").value;
	
	var x = document.getElementById("month");
	var month = String(x.options[x.selectedIndex].value);
	var x = document.getElementById("day");
	var day = String(x.options[x.selectedIndex].value);
	var x = document.getElementById("year");
	var year = String(x.options[x.selectedIndex].value);
	
	switch(month)
	{
		case 'Jan': month = 1; break;
		case 'Feb': month = 2; break;
		case 'Mar': month = 3; break;
		case 'Apr': month = 4; break;
		case 'May': month = 5; break;
		case 'Jun': month = 6; break;
		case 'Jul': month = 7; break;
		case 'Aug': month = 8; break;
		case 'Sep': month = 9; break;
		case 'Oct': month = 10; break;
		case 'Nov': month = 11; break;
		case 'Dec': month = 12; break;
		default: month=-1; break;
	}
	
	var date = year+"-"+month+"-"+day;
	
	if(expenseName != "" || amount != "")
	{
		if(amount >= 0 && amount <= 1000000)
		{
			document.newExpense.eName.value = expenseName;
			document.newExpense.eAmount.value = amount;
			document.newExpense.eDate.value = date;
			document.newExpense.submit();
		}
		else alert("Invalid amount");
	}
	else alert("All fields are required");
}

function NewProgram()
{
	var name = document.getElementById("nametitle").value;
	var date = document.getElementById("programdate").value;
	var venue = document.getElementById("venue").value;
	var budget = document.getElementById("budgetEMPTY").value;
	var x = document.getElementById("committee");
	var employee = x.options[x.selectedIndex].getAttribute('name');
	var conflict = document.getElementById("conflictError").value;
	var timeError = 0;
	
	
	var x = document.getElementById("start");
	var start = String(x.options[x.selectedIndex].value);
	if(start != "-")
		start = convert12to24(start);
	else timeError = 1;
	
	var x = document.getElementById("end");
	var end = String(x.options[x.selectedIndex].value);
	if(end != "-")
		end = convert12to24(end);
	else timeError = 1;
	
	
	if(name != "" || venue != "" || budget != "")
	{
		if(budget > 0)
		{
			if(timeError == 0)
			{
				if(start != end)
				{
					if(conflict == "0")
					{
						if(employee)
						{
							document.postProgram.titleProg.value = name;
							document.postProgram.dateProg.value = date;
							document.postProgram.venueProg.value = venue;
							document.postProgram.startProg.value = start;
							document.postProgram.endProg.value = end;
							document.postProgram.budgetProg.value = budget;
							document.postProgram.employee.value = employee;
							document.postProgram.submit();
						}
						else alert("Please select a committee");
					}
					else alert("There should be no time conflict");
				}
				else alert("Start time and end time cannot be the same");
			}
			else alert("Please select a valid time");
		}
		else alert("Please enter a valid budget");
	}
	else alert("Every field is required");
	
}

function EditProgram()
{
	var name = document.getElementById("nametitleEV").value;
	var venue = document.getElementById("venueEV").value;
	var budget = document.getElementById("budgetEV").value;
	var conflict = document.getElementById("conflictError").value;
	
	var x = document.getElementById("month");
	var month = String(x.options[x.selectedIndex].value);
	var x = document.getElementById("day");
	var day = String(x.options[x.selectedIndex].value);
	var x = document.getElementById("year");
	var year = String(x.options[x.selectedIndex].value);
	var x = document.getElementById("committee");
	var employee = x.options[x.selectedIndex].getAttribute('name');
	var timeError = 0;
	
	switch(month)
	{
		case 'Jan': month = 1; break;
		case 'Feb': month = 2; break;
		case 'Mar': month = 3; break;
		case 'Apr': month = 4; break;
		case 'May': month = 5; break;
		case 'Jun': month = 6; break;
		case 'Jul': month = 7; break;
		case 'Aug': month = 8; break;
		case 'Sep': month = 9; break;
		case 'Oct': month = 10; break;
		case 'Nov': month = 11; break;
		case 'Dec': month = 12; break;
		default: month=-1; break;
	}
	
	var date = year+"-"+month+"-"+day;
	
	
	var x = document.getElementById("start");
	var start = String(x.options[x.selectedIndex].value);
	if(start != "-")
		start = convert12to24(start);
	else timeError = 1;
	var x = document.getElementById("end");
	var end = String(x.options[x.selectedIndex].value);
	if(end != "-")
		end = convert12to24(end);
	else timeError = 1;
	
	if(name != "" || venue != "" || budget != "")
	{
		if(budget > 0)
		{
			if(timeError == 0)
			{
				if(start != end)
				{
					if(conflict == "0")
					{
						if(employee)
						{
							document.editProgram.titleProg.value = name;
							document.editProgram.dateProg.value = date;
							document.editProgram.venueProg.value = venue;
							document.editProgram.startProg.value = start;
							document.editProgram.endProg.value = end;
							document.editProgram.budgetProg.value = budget;
							document.editProgram.employee.value = employee;
							document.editProgram.submit();
						}
						else alert("Please select a committee");
					}
					else alert("There should be no time conflict");
				}
				else alert("Start time and end time cannot be the same");
			}
			else alert("Please select a valid time");
		}
		else alert("Please enter a valid budget");
	}
	else alert("Every field is required");
}

function DeleteProgram()
{
	document.deleteProgram.submit();
}

function AddParticipant()
{
	var uID = document.getElementById("userID").value;
	if(uID)
	{
		document.newParticipants.uID.value = uID;
		document.newParticipants.submit();
	}
	else alert("Field cannot be blank");
}

function DeleteParticipant(uID) //BUTTON FROM membersList
{
	document.deleteParticipant.uID.value = uID;
	document.deleteParticipant.submit();
}

function AddParticipantFromHome(uID, pID)
{
	document.newParticipants.uID.value = uID;
	document.newParticipants.programID.value = pID;
	document.newParticipants.submit();
}
function DeleteParticipantFromHome(uID, pID)
{

	document.deleteParticipant.uID.value = uID;
	document.deleteParticipant.programID.value = pID;
	document.deleteParticipant.submit();
}

function blotterprint(id, hid){
	document.blotterform.blotterid.value = id;
	document.blotterform.hearingid.value = hid;
	document.blotterform.submit();
	
}



function deleteItem()
{
	var a = document.delete_item_form.idin.value;
	if(a=="")
	{
		alert("Product # must be filled.");
	}
	else
	{
		alert(a);
		document.getElementById("idout").value=a;
		document.deleting_item.submit();
	}

}

function HandleBrowseClick() {
    var fileinput = document.getElementById("browse");
    fileinput.click();
}

function Handlechange() {
	var fileinput = document.getElementById("browse");
	var textinput = document.getElementById("filename");
	textinput.value = fileinput.value;
}



function validateItem(){
    
	var image = document.getElementById("image");
	if(image.value != '')
	document.imaging.submit();
	
	
}


function Report(){
	//var image = document.getElementById("image");
	var x = document.getElementById("types");
	
	var type = x.options[x.selectedIndex].value;
	var month = document.fromto.frommonth.value;
	if(month == "January")
		month = '01';
	if(month == "February")
		month = '02';
	if(month == "March")
		month = '03';
	if(month == "April")
		month = '04';
	if(month == "May")
		month = '05';
	if(month == "June")
		month = '06';
	if(month == "July")
		month = '07';
	if(month == "August")
		month = '08';
	if(month == "September")
		month = '09';
	if(month == "October")
		month = '10';
	if(month == "November")
		month = '11';
	if(month == "December")
		month = '12';
	
	var q = document.fromto.q.value;
	if(q == "January")
		q = '01';
	if(q == "February")
		q = '02';
	if(q == "March")
		q = '03';
	if(q == "April")
		q = '04';
	if(q == "May")
		q = '05';
	if(q == "June")
		q = '06';
	if(q == "July")
		q = '07';
	if(q == "August")
		q = '08';
	if(q == "September")
		q = '09';
	if(q == "October")
		q = '10';
	if(q == "November")
		q = '11';
	if(q == "December")
		q = '12';
	
	var year = document.fromto.fromyear.value;
	var e = document.fromto.e.value;
	
	var day = document.fromto.day.value;
	var w = document.fromto.w.value;
	
	document.fromto.rMonth.value = month;
	document.fromto.rDay.value = day;
	document.fromto.rYear.value = year;
	
	document.fromto.pMonth.value = q;
	document.fromto.pDay.value = w;
	document.fromto.pYear.value = e;
	
	document.fromto.rType.value = type;
	document.fromto.submit();
	//if(image.value != '')
	//document.imaging.submit();
}