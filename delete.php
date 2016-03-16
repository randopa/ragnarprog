<?php
	require "api.php";
	
	delete($_GET["id"]);
	header("Location:http://robert.vkhk.ee/~mark.markson/users.php");
	die();
?>