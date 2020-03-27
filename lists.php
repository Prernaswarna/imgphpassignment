<!DOCTYPE html>

<html>

<head>
<title>List of users</title>
</head>


<body>
<?php
	error_reporting(E_ALL);
ini_set('display_errors', 1);

	$sender = $_POST["emails"];

	$servername = "localhost";
	$username="guest";
	$password="Guest123#";
	$dbname="first_year";
	
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) 
	{
    		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT username, firstname, lastname , email , phone , gender FROM prerna_user";

	$email="";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) 
	{
		while($row = $result->fetch_assoc()) 
		{
			echo "Username: " . $row["username"]. "   Name: " . $row["firstname"]. " " . $row["lastname"]."   Phone: ".$row["phone"]."   Gender: ".$row["gender"].'<br>';

			$email = $row["email"];			

			echo '<form method="post" action="chat.php"><input type="email" id="receiver" name="receiver" value='.$email.'><input type="email" id="sender" name="sender" value='.$sender.'><input type="submit" value="Chat" name="Chat" id="Chat"></form>';
  
		} 
		
	}
	else 
	{
		echo "0 results";
	}
	$conn->close();

	echo '<form method="post" action="profile.php"><input type="hidden" id="email" name="email" value='.$sender.'><input type="submit" value="Edit profile" name="edit" id="edit"></form>';

	
	echo '<form method="post" action="logout.php"><input type="submit" value="logout" name="logout" id="logout"></form>';
?>

</body>
</html>
