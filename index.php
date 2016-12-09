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
	<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
	<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	  	<form action="addUser.php" method="POST">
		    <div class="modal-content" >
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		        <h4 class="modal-title" id="myModalLabel">Registration</h4>
		      </div>
		      <div class="modal-body">
		      	<div class="input-group input-group InputHolder">
				  <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
				  <input type="text" name="firstName" class="form-control" placeholder="First name" aria-describedby="sizing-addon1">
				</div>
				<div class="input-group input-group InputHolder">
				  <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
				  <input type="text" name="lastName" class="form-control" placeholder="Last name" aria-describedby="sizing-addon1">
				</div>
				<div class="input-group input-group InputHolder">
				  <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></span>
				  <input type="email" name="email" class="form-control" placeholder="Email" aria-describedby="sizing-addon1">
				</div>
				<div class="input-group input-group InputHolder">
				  <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
				  <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="sizing-addon1">
				</div>
		        
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Register user</button>
		      </div>
		    </div>
		</form>
	  </div>
	</div>
	<form action="index.php" method="POST">
		<div class="container" id="logInContainer">
			<h2>PHP forum</h2>
		<div class="input-group input-group-lg InputHolder">
		  <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
		  <input type="text" name="email" class="form-control" placeholder="Email" aria-describedby="sizing-addon1">
		</div>
		<div class="input-group input-group-lg InputHolder">
		  <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
		  <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="sizing-addon1">
		</div>
		<div class="input-group input-group-lg InputHolder">
		  <input type="submit"  class="btn btn-default" value="Login" aria-describedby="sizing-addon1">
		  <input type="button" id="registerBtn" class="btn btn-success" value="Register" data-target ="#registerModal" data-toggle="modal" aria-describedby="sizing-addon1">
		</div>

		</div>
	</form>
	<?php
		require("scripts/jsScripts.php");
	?>
</body>
</html>