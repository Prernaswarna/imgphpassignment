<!DOCTYPE html>

<head>
</head>


<body>

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$sender=$receiver=$message="";

	$sender = $_POST["sender"];
	$receiver = $_POST["receiver"];
	$message = $_POST["message"];

	$servername = "localhost";
	$user="guest";
	$pass="Guest123#";
	$dbname="first_year";
	

	$conn = new mysqli($servername, $user, $pass, $dbname);

	if ($conn->connect_error) 
	{
    		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "INSERT INTO prerna_message (sender , reciever , message)
	VALUES ('$sender' , '$receiver' , '$message')";

	if ($conn->query($sql) === TRUE) 
	{
    		echo "Your message has been sent";
		echo '<form method="post" action="chat.php"><input type="hidden" id="sender" name="sender" value='.$sender.' readonly><input type="hidden" id="receiver" name="receiver" value='.$receiver.' readonly><input type="submit" value="Continue" name="continue" id="continue"></form>';
	}
	 else 
	{
	    echo "Error: " . $sql . "<br>" . $conn->error;
	} 
}
?>

</body>

</html>
