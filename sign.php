<!DOCTYPE html>

<?php


if(isset($_COOKIE['nameofuser'])) 
{
	echo "Cookie is set";    
	echo '<script>window.open("lists.php")</script>';
	
} 

?>

<html>

<head>
<title>Sign in</title>
</head>

<body>

<form name="myForm" method="post" action="signin.php">
Username<input type="text" name="username" id="username">
<br>
Password<input type="password" name="password" id="password">
<br>
<input type="checkbox" id="remember" name="remember" value="remember">Remember Me
<br>
<input type="submit" value="Sign in" name="signin" id="signin" onclick="validate()">
</form>

<script>
function validate()
{
var username=document.getElementById("username").value;
var regex =/[A-Za-z0-9]+$/;



if(username=="")
{
alert("Username must be filled");
}
else if(regex.test(username)==false)
{
alert("Invalid Username");
}
var pswd=document.getElementById("password").value;
if(pswd=="")
{
alert("Password must be filled");
}
}
</script>

</body>
</html>
