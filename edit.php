<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<title>Registration</title>
</head>
<body>
	<?php		
		require "api.php";
		$id = $_GET["id"];
		$userData = display($id);
	?>
	<form action="form.php?id=<?php print $userData["id"]; ?>" method="post" enctype="multipart/form-data">
		Username: <input class="username" type="text" name="username" value="<?php print $userData["username"]; ?>"><br>
		First name: <input class="first_name" type="text" name="first_name" value="<?php print $userData["first_name"]; ?>"><br>
		Last name: <input class="last_name" type="text" name="last_name"value="<?php print $userData["last_name"]; ?>" ><br>
		<input class="radio" type="radio" name="gender" value="Male" value="<?php print $userData["gender"]; ?>">Male
		<input class="radio" type="radio" name="gender" value="Female" value="<?php print $userData["gender"]; ?>">Female<br>
		<input type="file" name="img" accept="image/*" /><br>
		Description:<br>
		<textarea rows="5" cols="50" name="description"><?php print $userData["description"]; ?>"</textarea><br>
		<input type="hidden" name="time" value="<?php print $userData["time"]; ?>">
		<input type="submit" value="Save">
	</form>
</body>
</html>