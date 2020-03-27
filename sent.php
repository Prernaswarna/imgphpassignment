<!DOCTYPE html>

<head>
<title>Sent messages</title>
</head>


<body>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$sender=$receiver="";

	$sender = $_POST["sender"];
	$receiver = $_POST["receiver"];

	$servername = "localhost";
	$user="guest";
	$pass="Guest123#";
	$dbname="first_year";
	

	$conn = new mysqli($servername, $user, $pass, $dbname);

	if ($conn->connect_error) 
	{
    		die("Connection failed: " . $conn->connect_error);
	}

	$sql1 = "SELECT sender , reciever , message FROM prerna_message ORDER BY messageid DESC";

	$result = $conn->query($sql1);

	$send="";
	$message="";
	$rec ="";
	if($result->num_rows>0)
	{
		 while($row = $result->fetch_assoc())
		{
			$send = $row["sender"];
			$rec = $row["reciever"];
			if($send==$sender && $rec == $receiver)
			{
				$message = $row["message"];
				echo "Sender : ".$send." ";
				echo " Receiver : ".$rec." ";
				echo " Message : ".$message;
				echo '<br>';
			}
		}
	} 
	else
	{
		echo "You haven't sent any messages";
	}
	$conn->close();
}

?>

</body>

</html>
