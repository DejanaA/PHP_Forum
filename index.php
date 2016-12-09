<?php
	require("db.php");
	session_start();
	if (isset($_SESSION['logged_user'])) {
		header("Location:views/home.php");
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$email = $_POST['email'];
		$password = $_POST['password'];
		if (isset($email) and isset($password)) {
			if ($email !="" and $password !="") {
				$md5Password = md5($password);
				echo $email . " " . $md5Password;
				$sql = "SELECT * FROM users WHERE email = '$email' and password = '$md5Password'";
				$results = $connection->query($sql);
				if ($results->num_rows == 1) {
					
					$_SESSION['logged_user'] = $email;
					header("location:views/home.php");
				}else{
					echo "error";
				}
			}
		}
	}
?>
<html>
<head>
	<title>PHP forum</title>
	<?php
		require("scripts/cssScripts.css");
	?>
</head>
<body>
	<form action="index.php" method="POST">
		<div class="container" id="logInContainer">
			<h2>PHP forum</h2>
		<div class="input-group input-group-lg InputHolder">
		  <span class="input-group-addon" id="sizing-addon1">@</span>
		  <input type="text" name="email" class="form-control" placeholder="Username" aria-describedby="sizing-addon1">
		</div>
		<div class="input-group input-group-lg InputHolder">
		  <span class="input-group-addon" id="sizing-addon1">@</span>
		  <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="sizing-addon1">
		</div>
		<div class="input-group input-group-lg InputHolder">
		  <input type="submit"  class="btn btn-default" value="Login" aria-describedby="sizing-addon1">
		</div>

		</div>
	</form>
	<?php
		require("scripts/jsScripts.php");
	?>
</body>
</html>