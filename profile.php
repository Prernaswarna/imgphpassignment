<!DOCTYPE html>

<head>
<title>Edit profile</title>
</head>


<body>

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$email = $_POST["email"];
	
	echo '<form method="post" action="edit.php" enctype="multipart/form-data">Firstname<input type="text" id="firstname" name="firstname"><br>Lastname<input type="text" id="lastname" name="lastname"><br>Phone<input type="text" id="phone" name="phone"><br>Gender<br>
<input type="radio" id="male" name="gender" value="male">Male
<input type="radio" id="female" name="gender" value="female">Female
<input type="radio" id="other" name="gender" value="other">Other
<br>Password<input type="password" name="password" id="password"><br>
Confirm Password<input type="password" name="confirm" id="confirm"><br><input type="hidden" id="email" name="email" value='.$email.'><br>
Profile picture<input type="file" name="fileToUpload" id="fileToUpload"><br><input type="submit" value="Edit" name="Edit" id="send"></form>';

}

?>

</body>
</html>
