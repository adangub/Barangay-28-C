function validate()
{	
	var username = document.register_form.userin.value;
	var password = document.register_form.passin.value;
	var firstname = document.register_form.firstin.value;
	var lastname = document.register_form.lastin.value;
	var cellnumber = document.register_form.cnin.value;
	
	if(username==""||password==""||firstname==""||lastname==""||cellnumber=="")
	{
		alert("All fields must be filled!");
	}
	else
	{
		document.getElementById("userout").value=username;
		document.getElementById("passout").value=password;
		document.getElementById("firstout").value=firstname;
		document.getElementById("lastout").value=lastname;
		document.getElementById("cnout").value=cellnumber;
		document.add_click.submit();
	}
}	
function validateEmail()
{
	var email = document.register_form.userin.value;
	at = email.indexOf("@");
	dot = email.lastIndexOf(".");
	web = email.lastIndexOf(".") - 1;
	com = email.lastIndexOf(".") + 1;
	if(at<1||(dot<2)||(web==at)||(com==email.length)||at>dot){
		alert("Email is incorrect.");
	}
	else
		validate();
}
function validateLogin()
{
	var a = document.login_form.userin.value;
	var b = document.login_form.passin.value;
	if(a==""||b=="")
	{
		alert("Fields must be filled!");
	}
	else
	{
		document.getElementById("userout").value=a;
		document.getElementById("passout").value=b;
		document.login_click.submit();
	}

}
function validateItem()
{
	var a = document.add_item_form.brandin.value;
	var b = document.add_item_form.modelin.value;
	var c = document.add_item_form.pricein.value;
	var d = document.add_item_form.descriptionin.value;
	var e = document.add_item_form.quantityin.value;
	if(a==""||b==""||c==""||d==""||e=="")
	{
		alert("Fields must be filled!");
	}
	else
	{
		document.getElementById("brandout").value=a;
		document.getElementById("modelout").value=b;
		document.getElementById("priceout").value=c;
		document.getElementById("descriptionout").value=d;
		document.getElementById("quantityout").value=e;
		document.adding_item.submit();
	}

}
function editItem()
{
	var a = document.edit_item_form.brandin.value;
	var b = document.edit_item_form.modelin.value;
	var c = document.edit_item_form.pricein.value;
	var d = document.edit_item_form.descriptionin.value;
	var e = document.edit_item_form.idin.value;
	if(a==""||b==""||c==""||d==""||e=="")
	{
		alert("Fields must be filled!");
	}
	else
	{
		document.getElementById("brandout").value=a;
		document.getElementById("modelout").value=b;
		document.getElementById("priceout").value=c;
		document.getElementById("descriptionout").value=d;
		document.getElementById("idout").value=e;
		document.editing_item.submit();
	}

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