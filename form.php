<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	
	require "api.php";
	$form = array(
		"username" => $_POST['username'],
		"first_name" => $_POST['first_name'],
		"last_name" => $_POST['last_name'],
		"gender" => $_POST['gender'],
		"description" => $_POST['description'],
		"picture" => $_FILES['img']['tmp_name']);
	if (isset($_GET["id"])) {
		$form["id"] = $_GET["id"];
		$form["time"] = $_POST['time'];
		edit($form);
	}
	else {
		create($form);
	}
	
	header("Location:http://robert.vkhk.ee/~mark.markson/users.php");
	die();	
?>