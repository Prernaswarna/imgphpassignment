
<!DOCTYPE html>

<html>

<head>
<title>Log in</title>
</head>

<body>

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);



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
	$name = $_FILES["fileToUpload"]["name"];
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if($check !== false) 
	{
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    	} 
	else {
        echo "File is not an image.";
        $uploadOk = 0;
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
	$sql = "UPDATE prerna_user SET username = '$username' , firstname = '$firstname' , lastname = '$lastname' , phone = '$phone' , gender = '$gender', name='$name' WHERE email = '$emails'";

	if(copy($_FILES['fileToUpload']['tmp_name'] , $target_dir.$name))
	{
		echo "file moved";
	}
	else
	{
		echo "file not moved";
	}

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
