<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<title>Registration</title>
</head>
<body>
	<form action="form.php" method="post" enctype="multipart/form-data">
		Username: <input class="username" type="text" name="username"><br>
		First name: <input class="first_name" type="text" name="first_name"/><br>
		Last name: <input class="last_name" type="text" name="last_name"/><br>
		<input class="radio" type="radio" name="gender" value="Male">Male
		<input class="radio" type="radio" name="gender" value="Female">Female<br>
		<input type="file" name="img" accept="image/*" /><br>
		Description:<br>
		<textarea rows="5" cols="50" name="description"></textarea><br>
		<input type="submit" value="Save">
	</form>
</body>
</html>