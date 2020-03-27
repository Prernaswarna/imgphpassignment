
<!DOCTYPE html>

<html>

<head>
<title>Log in</title>
</head>

<body>

<?php

$firstname = $gender = $lastname = $username = $phone = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  
	//check if fields are empty

    if (empty($_POST["username"]))
    {
      die("Username is required");
    }
    else
    {
    $username = test_input($_POST["username"]);
    }


   if (empty($_POST["firstname"]))
    {
     die( "Firstname is required");
    }
    else
    {
    $firstname = test_input($_POST["firstname"]);
    }
 
   if (empty($_POST["lastname"]))
    {
     die( "Lastname is required");
    }
    else
    {
    $lastname = test_input($_POST["lastname"]);
    }

  if (empty($_POST["gender"]))
   {
    die("Gender is required");
   }
  else
   {
    $gender = test_input($_POST["gender"]);
   }
   if (empty($_POST["phone"]))
    {
     die( "Phone is required");
    }
   else
    {
     $phone = test_input($_POST["phone"]);
    }

   

	//validate the fields


    if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {
      die("Invalid firstname");
    }

     if (!preg_match("/^[a-zA-Z ]*$/",$lastname)) {
      die("Invalid lastname");
    }

     if (!preg_match("/^[a-zA-Z0-9 ]*$/",$username)) {
       die("Invalid username");
    }

     if (!preg_match("/(\+91)*(\-)*[6-9]{1}[0-9]{9}$/",$phone)){
      die("Invalid phone");
    }

	$emails = $_POST["emails"];

	
	$servername = "localhost";
	$user="guest";
	$pass="Guest123#";
	$dbname="first_year";
	
	$conn = new mysqli($servername, $user, $pass, $dbname);

	if ($conn->connect_error) 
	{
    		die("Connection failed: " . $conn->connect_error);
	}

	//check for repeat username 

	$sql1 = "SELECT username FROM prerna_user";	
	
	$result = $conn->query($sql1);
	
	$use="";
	

	if($result->num_rows>0)
	{
		 while($row = $result->fetch_assoc())
		{
			$use= $row["username"];
			if($use==$username)
				die("Username already exists");
		}
	} 
	

	
	//insert into table
	$sql = "UPDATE prerna_user SET username = '$username' , firstname = '$firstname' , lastname = '$lastname' , phone = '$phone' , gender = '$gender' WHERE email = '$emails'";

	if ($conn->query($sql) === TRUE) 
	{
    		echo("You have signed up sucessfully");
	}
	 else 
	{
	    echo "Error: " . $sql . "<br>" . $conn->error;
	} 
	
	echo '<form method="post" action="lists.php"><input type="hidden" id="emails" name="emails" value='.$emails.' readonly><input type="submit" value="List" name="List" id="List"></form>';
	$conn->close();
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

</body>
</html>
