<?php

	session_start();
	$user = $_SESSION['logged_user'];
	if (!isset($user)) {
		header("location:../index.php");
	}
	$sql2 = "SELECT * FROM users WHERE email = '$user'";
		$results = $connection->query($sql2);
		$loged_user = $results->fetch_assoc();
		$loged_user_id = $loged_user['id'];

?>