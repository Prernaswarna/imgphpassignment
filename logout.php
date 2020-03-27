<!DOCTYPE html>

<?php

if(isset($_COOKIE[$cookie_name])) 
{
	setcookie("nameofuser", "", time() - 3600);
}

echo "Signed out";

echo '<script>window.open("sign.php")</script>';

?>

<html>

<head>
<title>Log out</title>
</head>

<body>
</body>

</html>



