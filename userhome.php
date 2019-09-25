<?php
	session_start();
	if(!isset($_SESSION["myusername"])) {
		header("location:index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> Copnet Tech Home </title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="bg-image"></div>
		<div class="logo"> COPNET TECH </div>
		<section class="container">
			<div class="logo">Client Registration</div>
			<form action="" method="POST">
				<input type="text" class="ip" name="clientname" placeholder="Client Name" required/> <br/>
				<input type="email" class="ip" name="clientemail" placeholder="Client Email" required/> <br/>
				<input type="tel" class="ip" name="clientphno" placeholder="Client Phone" required/> <br/>
				<textarea class="ip" rows="4" cols="40" name="clientaddr" placeholder="Client Address" required></textarea> <br/>
				<textarea class="ip" rows="5" cols="40" name="clientreq" placeholder="Client Requirements" required></textarea> <br/>
				<input type="submit" class="button" value="Add"/>
				<?php
					$host="localhost";
					$username="root";
					$password="";
					$db_name="copnet";
					$tbl_name="clients";
					$conn = mysqli_connect("$host", "$username", "$password") or die("cannot connect");
					mysqli_select_db($conn, "$db_name") or die("cannot select DB");
					if (isset($_POST['clientname'])) {
						$myuserid=mysqli_real_escape_string($conn, stripslashes($_SESSION["id"]));
						$myclientname=mysqli_real_escape_string($conn, stripslashes($_POST['clientname']));
						$myclientemail=mysqli_real_escape_string($conn, stripslashes($_POST['clientemail']));
						$myclientphno=mysqli_real_escape_string($conn, stripslashes($_POST['clientphno']));
						$myclientaddr=mysqli_real_escape_string($conn, stripslashes($_POST['clientaddr']));
						$myclientreq=mysqli_real_escape_string($conn, stripslashes($_POST['clientreq']));
						mysqli_query($conn,"INSERT INTO clients(uid,cname,cemail,cphno,caddr,creq) VALUES($myuserid,'$myclientname','$myclientemail','$myclientphno','$myclientaddr','$myclientreq')");
						echo "<div class='valid'>Client added successfully</div>";
					}
					mysqli_close($conn);
				?>
			</form>
			<h4><a href="logout.php">LOGOUT</a></h4>
		</section>
	</body>
</html>