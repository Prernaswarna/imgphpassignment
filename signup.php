<!DOCTYPE html>

<html>

<head>
<title>Sign up</title>
</head>

<body>

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	//check if fields are empty

	$email=$password=$confirm="";

	if (empty($_POST["email"]))
	{
		die( "Email is required");
	}
	else
	{
		$email = test_input($_POST["email"]);
	}



	if (empty($_POST["password"]))
	{
     		die( "Password is required");
    	}
   	else
    	{
    		$password = test_input($_POST["password"]);
   	}

	if($_POST["password"] != $_POST["confirm"])
	{
		die("Confirm password must match password");
	}

	//validate fields

	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		die("Email invalid");
	}

	//enter values to table

	$servername = "localhost";
	$user="guest";
	$pass="Guest123#";
	$dbname="first_year";
	

	$conn = new mysqli($servername, $user, $pass, $dbname);

	if ($conn->connect_error) 
	{
    		die("Connection failed: " . $conn->connect_error);
	}

	$sql1 = "SELECT email FROM prerna_user";

	$result = $conn->query($sql1);
	
	$em="";

	if($result->num_rows>0)
	{
		 while($row = $result->fetch_assoc())
		{
			$em = $row["email"];
			if($em==$email)
				die("Email is already registered");
		}
	} 


	//insert into table

	$sql = "INSERT INTO prerna_user (email , password)
	VALUES ('$email' , '$password')";

	if ($conn->query($sql) === TRUE) 
	{
    		echo("You have signed up sucessfully");
	}
	 else 
	{
	    echo "Error: " . $sql . "<br>" . $conn->error;
	} 
	
	//echo '<script>window.open("login.html")</script>';
	

	/*echo '<script>
	var form = document.createElement("FORM");
	form.method="POST";
	form.action = "log.php";	
	var input = document.createElement("INPUT");
	input.id="emails";
	input.name="emails";
	input.type="hidden";
	input.value= "abc@gmail.com";
	form.appendChild(input);
	document.body.appendChild(form);
	window.open("log.php");	
	form.submit();
	</script>'*/

	echo '<form method="post" action="log.php"><input type="email" id="emails" name="emails" value='.$email.'><input type="submit" value="Continue" name="continue" id="continue"></form>';

	$conn->close();



}



function test_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

</body>

</html>


