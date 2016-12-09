<?php
require("session.php");
require("db.php");


$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$password = md5($_POST['password']);
if (isset($firstName, $lastName, $email, $password)) {
	if ($firstName!="" and $lastName!="" and $email!="" and $password!="") {
		$sql= " INSERT INTO users (first_name, last_name, email, password) VALUES('$firstName', '$lastName', '$email', '$password')";
		if ($connection->query($sql)) {
				header("location:index.php");
			}	
	}
}

?>
