<?php
	require("db.php");
	require("session.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		$user_id = $_POST['user_id'];
		$sql = "DELETE FROM users WHERE id = '$user_id'";
		$results = $connection->query($sql);
		


		header("Location: /PHP_Forum/views/adminPanel.php ");
	}

?>