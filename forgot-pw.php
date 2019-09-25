<?php
	session_start();
	if(isset($_SESSION["myusername"])) {
		header("location:userhome.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> Forgot Password </title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="bg-image"></div>
		残念でしたね
	</body>
</html>