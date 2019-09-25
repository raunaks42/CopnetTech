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
		<title> Copnet Tech Login </title>
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="script.js"></script>
	</head>
	<body>
		<div class="bg-image"></div>
		<div class="logo"> COPNET TECH </div>
		<section class="container">
			<form method="POST">
				<input type="text" class="ip" name="username" placeholder="Username" required/> <br/>
				<input type="password" class="ip" name="password" id="password" placeholder="Password" required/>
				<input type="checkbox" onclick="show('password')"/> Show <br/>
				<input type="submit" class="button" value="Login" onclick="return encrypt()"/> <br/>
				<?php
					$host="localhost";
					$username="root";
					$password="";
					$db_name="copnet";
					$tbl_name="users";
					$conn = mysqli_connect("$host", "$username", "$password") or die("cannot connect");
					mysqli_select_db($conn, "$db_name") or die("cannot select DB");
					if (isset($_POST['username'])) {
						$myusername=mysqli_real_escape_string($conn, stripslashes($_POST['username']));
						$mypassword=mysqli_real_escape_string($conn, stripslashes($_POST['password']));
						$sql="SELECT * FROM $tbl_name WHERE uname='$myusername' and upwd='$mypassword'";
						$q=mysqli_query($conn, $sql);
						if ($row=mysqli_fetch_assoc($q)) {
							$_SESSION["myusername"]=$myusername;
							$_SESSION["id"]=$row['uid'];
							header("location:userhome.php");
						}
						else {
							echo "<div class='invalid'>Wrong Username or Password</div>";
						}
					}
					mysqli_close($conn);
				?>
				<div class="invalid" id="err"></div>
			</form>
			<h4><a href="forgot-pw.php">Forgot Password?</a></h4>
			<h4><a href="signup.php">New here?</a></h4>
		</section>
	</body>
</html>