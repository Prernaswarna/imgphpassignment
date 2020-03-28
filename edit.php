<!DOCTYPE html>

<head>
<title>Edit profile Information</title>
</head>


<body>

<?php


$firstname = $gender = $lastname = $phone = $password = $confirm= "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$email = $_POST["email"];

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

   

	//validate the fields


    if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {
      die("Invalid firstname");
    }

     if (!preg_match("/^[a-zA-Z ]*$/",$lastname)) {
      die("Invalid lastname");
    }

	$servername = "localhost";
	$user="guest";
	$pass="Guest123#";
	$dbname="first_year";
	

	$conn = new mysqli($servername, $user, $pass, $dbname);

	if ($conn->connect_error) 
	{
    		die("Connection failed: " . $conn->connect_error);
	}


	$name = $_FILES["fileToUpload"]["name"];
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$extensions_arr = array("jpg","jpeg","png","gif");

	if( !(in_array($imageFileType,$extensions_arr) )){
		die("Not an image");
		
	}


	//insert into table

	$sql = "UPDATE prerna_user SET password='$password' , firstname = '$firstname' , lastname = '$lastname' , phone = '$phone' , gender = '$gender',name='$name' WHERE email = '$email'";

	move_uploaded_file($_FILES["fileToUpload"]["name"],$target_dir.$name);


	if ($conn->query($sql) === TRUE) 
	{
    		echo("You edited your profile");
	}
	 else 
	{
	    echo "Error: " . $sql . "<br>" . $conn->error;
	} 

	echo '<form method="post" action="lists.php"><input type="hidden" id="emails" name="emails" value='.$email.' readonly><input type="submit" value="List" name="List" id="List"></form>';
	
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
