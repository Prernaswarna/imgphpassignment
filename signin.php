<!DOCTYPE html>

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);




if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	//check for empty and validate username and password	

	$username = $password = "";

	if (empty($_POST["username"]))
    	{
     		die("Name is required");
    	}
	else
	{
		$username = test_input($_POST["username"]);
	}

	if (empty($_POST["password"]))
	{
		die( "Password is required");
	}
	else
	{
		$password = test_input($_POST["password"]);
	}
	
	if (!preg_match("/^[a-zA-Z0-9 ]*$/",$username))
	{
		die("Invalid username");
	}

	

	//check if username exists

	$servername = "localhost";
	$user="guest";
	$pass="Guest123#";
	$dbname="first_year";
	
	$conn = new mysqli($servername, $user, $pass, $dbname);

	if ($conn->connect_error) 
	{
    		die("Connection failed: " . $conn->connect_error);
	}

	
	$sql1 = "SELECT username ,email , password FROM prerna_user";	
	
	$result = $conn->query($sql1);

	$use="";
	$pas="";
	$check=0;
	
	

	
	if($result->num_rows>0)
	{
		 while($row = $result->fetch_assoc())
		{
			$check=0;
			$use= $row["username"];
			if($use==$username)
			{
				$check=$check+1;
			}
			$pas=$row["password"];
			if($pas==$password)
			{
				$check=$check+1;
			}
			if($check==2)
			{

				echo("Signed in sucessfully");
				//if remember me is checked set cookie
				if($_POST["remember"])
				{
					$cookie_name = 'nameofuser';
					$cookie_value= $username;

					setcookie($cookie_name , $cookie_value , 86400*365 , '/');
				echo "Set cookie";
			

					
				}

				//go to user list page
				
				$email = $row["email"];
				

				
				echo '<form method="post" action="lists.php"><input type="hidden" id="emails" name="emails" value='.$email.' readonly><input type="submit" value="List" name="List" id="List"></form>';
			}
			
		}
	} 
	$conn->close();
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<html>
<head>
<title>Sign in</html>
</head>

<body>


</body>

</html>
