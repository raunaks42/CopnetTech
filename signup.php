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
		<title> Copnet Tech Signup </title>
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="script.js"></script>
		<script>
			function validcheck() {
				var pass=document.getElementById('password').value;
				var letter=document.getElementById("letter");
				var capital=document.getElementById("capital");
				var number=document.getElementById("number");
				var length=document.getElementById("length");
				if (pass.search(/[a-z]/)>=0) {
					letter.classList.remove("invalid");
					letter.classList.add("valid");
				} else {
					letter.classList.remove("valid");
					letter.classList.add("invalid");
				}
				if (pass.search(/[A-Z]/)>=0) {
					capital.classList.remove("invalid");
					capital.classList.add("valid");
				} else {
					capital.classList.remove("valid");
					capital.classList.add("invalid");
				}
				if (pass.search(/[0-9]/)>=0) {
					number.classList.remove("invalid");
					number.classList.add("valid");
				} else {
					number.classList.remove("valid");
					number.classList.add("invalid");
				}
				if (pass.length>=8) {
					length.classList.remove("invalid");
					length.classList.add("valid");
				} else {
					length.classList.remove("valid");
					length.classList.add("invalid");
				}
				if(letter.classList.contains("valid")==1 && capital.classList.contains("valid")==1 && number.classList.contains("valid")==1 && length.classList.contains("valid")==1) {
					document.getElementById("valid").value="yes";
				} else {
					document.getElementById("valid").value="no";
				}
			}
			function match() {
			if (document.getElementById('password').value==document.getElementById('cpassword').value) {
				document.getElementById('match').classList.remove("invalid");
				document.getElementById('match').classList.add("valid");
				document.getElementById("matching").value="yes";
				document.getElementById('match').innerHTML='Matching';
			} else {
				document.getElementById('match').classList.remove("valid");
				document.getElementById('match').classList.add("invalid");
				document.getElementById("matching").value="no";
				document.getElementById('match').innerHTML='Not Matching';
			}
		}
		</script>
	</head>
	<body>
		<div class="bg-image"></div>
		<div class="logo"> COPNET TECH </div>
		<section class="container">
			<form action="" method="POST">
				<input type="text" class="ip" name="username" placeholder="Username" required/> <br/>
				<input type="email" class="ip" name="useremail" placeholder="User Email" required/> <br/>
				<input type="password" class="ip" name="password" id="password" onkeyup="validcheck()" placeholder="Password" required/>
				<input type="checkbox" onclick="show('password')"/> Show <br/>
				<input type="hidden" name="valid" id="valid" />
				Password is valid if it contains: <br/>
				<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
				<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
				<p id="number" class="invalid">A <b>number</b></p>
				<p id="length" class="invalid">Minimum <b>8 characters</b></p>
				<input type="password" class="ip" id="cpassword" onkeyup="match()" placeholder="Confirm Password" required/>
				<input type="checkbox" onclick="show('cpassword')"/> Show <br/>
				<input type="hidden" name="matching" id="matching" />
				<div id='match' class="invalid"></div> <br/>
				<input type="submit" class="button" value="Signup" onclick="encrypt()"/>
				<?php
					$host="localhost";
					$username="root";
					$password="";
					$db_name="copnet";
					$tbl_name="users";
					$conn=mysqli_connect("$host", "$username", "$password") or die("cannot connect");
					mysqli_select_db($conn, "$db_name") or die("cannot select DB");
					if (isset($_POST['username'])) {
						$myusername=mysqli_real_escape_string($conn, stripslashes($_POST['username']));
						$mypassword=mysqli_real_escape_string($conn, stripslashes($_POST['password']));
						$myuseremail=mysqli_real_escape_string($conn, stripslashes($_POST['useremail']));
						$valid=mysqli_real_escape_string($conn, stripslashes($_POST['valid']));
						$matching=mysqli_real_escape_string($conn, stripslashes($_POST['matching']));
						$sql="SELECT * FROM $tbl_name WHERE uname = '$myusername'";
						if(mysqli_num_rows(mysqli_query($conn,$sql))!=0){
							echo "<div class='invalid'>User already exists</div>";
						}
						else if ($valid=="no") {
							echo "<div class='invalid'>Password is invalid</div>";
						}
						else if ($matching=="no") {
							echo "<div class='invalid'>Password and Confirm Password do not match</div>";
						}
						else {
							mysqli_query($conn,"INSERT INTO users(uname,uemail,upwd) VALUES('$myusername','$myuseremail','$mypassword')");
							echo "<div class='valid'>User added successfully</div>";
						}
					}
					mysqli_close($conn);
				?>
				<div class="invalid" id="err"></div>
			</form>
			<h4><a href="index.php">Home</a></h4>
		</section>
	</body>
</html>