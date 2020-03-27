<!DOCTYPE html>

<html>

<head>
<title>Chat</title>
</head>


<body>

<?php

	$sender = $_POST["sender"];
	$receiver = $_POST["receiver"];

	echo '<form method="post" action="message.php"><input type="text" id="message" name="message"><input type="hidden" id="sender" name="sender" value='.$sender.' readonly><input type="hidden" id="receiver" name="receiver" value='.$receiver.' readonly><input type="submit" value="Send" name="send" id="send"></form>';

	echo '<form method="post" action="sent.php"><input type="hidden" id="sender" name="sender" value='.$sender.' readonly><input type="hidden" id="receiver" name="receiver" value='.$receiver.' readonly><input type="submit" value="See chat history" name="sent" id="sent"></form>';

	

?>

</body>
</html>
