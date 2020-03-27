<!DOCTYPE html>


<html>

<head>
<title>Profile Page</title>
</head>

<body>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$emails = $_POST["emails"];
		echo $emails;
	}

echo '<form name="myForm" method="post" action="login.php">
<input type="email" id="emails" name="emails" value='.$emails.' readonly><br>
Username<input type="text" name="username" id="username"><br>
Phone Number<input type="text" id="phone" name="phone"><br>
Gender<br>
<input type="radio" id="male" name="gender" value="male">Male
<input type="radio" id="female" name="gender" value="female">Female
<input type="radio" id="other" name="gender" value="other">Other
<br>
First name<input type="text" name="firstname" id="firstname">
<br>
Last name<input type="text" name="lastname" id="lastname">
<br>
<input type="submit" value="Sign up" onclick = "validateform()">
</form>

<script>
function validateform(form)
{
var user = document.getElementById("username").value;
if(user=="")
{
	alert("Username must be filled out");
	return false;
}
var regex = /(\+91)*(\-)*[6-9]{1}[0-9]{9}$/;

var phone = document.getElementById("phone").value;
if(regex.test(phone)==false)
{
	alert("Invalid phone number");
	return false;
}

var regex1 = /[A-Za-z0-9]*$/;
if(regex1.test(user)==false)
{
	alert("Invalid username");
	return false;
}
var regex2 = /[A-Z][a-z]+/;
var first = document.getElementById("firstname");
var last = document.getElementById("lastname");

if(regex2.test(first)==false)
{
	alert("Invalid firstname");
	return false;
}
if(regex2.test(last)==false)
{
	alert("Invalid second name");
	return false;
}
return true;
}

</script>'

?>


</body>
</html>
