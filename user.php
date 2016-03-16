<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>User</title>
</head>
<body>
	<?php
		require "api.php";
		$id = $_GET["id"];
		$userData = display($id);
		
		print '<img src="' . "./db/$id/pilt.jpg" . '" height="100" width="100">'. "<br>";
		print "Username : ". $userData["username"]. "<br>";
		print "First name : ". $userData["first_name"]. "<br>";
		print "Last name : ". $userData["last_name"]. "<br>";
		print "Gender : ". $userData["gender"]. "<br>";
		print "Description : ". $userData["description"]. "<br>";
		print "Creation time : ". $userData["time"];
	?>
</body>
</html>