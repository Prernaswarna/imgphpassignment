<!DOCTYPE html>

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_COOKIE['nameofuser'])) 
{
	echo "Cookie is set";    
	$servername = "localhost";
	$user="guest";
	$pass="Guest123#";
	$dbname="first_year";
	

	$conn = new mysqli($servername, $user, $pass, $dbname);

	if ($conn->connect_error) 
	{
    		die("Connection failed: " . $conn->connect_error);
	}
	
	$use = $_COOKIE['nameofuser'];
	$usern="";
	
	$sql1 = "SELECT username ,email FROM prerna_user";

	$result = $conn->query($sql1);
	
	$em="";

	if($result->num_rows>0)
	{
		 while($row = $result->fetch_assoc())
		{
			$usern = $row["username"];
			if($use==$usern)
				$em=$row["email"];
		}
	} 
	
	echo '<form method="post" action="log.php"><input type="email" id="emails" name="emails" value='.$em.'><input type="submit" value="Continue" name="continue" id="continue"></form>';

	$conn->close();
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
