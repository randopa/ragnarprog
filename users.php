<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Users</title>
</head>
<body>
	<?php
	require "api.php";
	$users = userList();
	
	$total = '<table>';
	foreach ($users as $user) {
	  $total .= '
		<tr>
		  <td>' . $user["id"] . '</td>
		  <td>
			<img src="db/' . $user["id"] . '/picture.jpg" height="30" width="30">
		  </td>
		  <td>' . $user["username"] . '</td>
		  <td>
			<a href="user.php?id=' . 
			$user["id"] . '">View</a>
			<a href="edit.php?id=' . 
			$user["id"] . '">Edit</a>
			<a href="delete.php?id=' . 
			$user["id"] . '">Delete</a>
		  </td>
		</tr>';
	}
	$total .= '</table>';
	print $total;
	?>
	<form>
	<div>
        <a href="register.php" id="registration">Registration</a>  
    </div>
	</form>
</body>
</html>