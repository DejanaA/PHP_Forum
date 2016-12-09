<?php

	session_start();
	$user = $_SESSION['logged_user'];
	if (!isset($user)) {
		header("location:../index.php");
	}

?>