<?php
	require("db.php");

	session_start();
	$user = $_SESSION['logged_user'];
	if (!isset($user)) {
		header("location:../index.php");
	}
	$sql2 = "SELECT * FROM users WHERE email = '$user'";
		$results = $connection->query($sql2);
			$loged_user = $results->fetch_assoc();
			$loged_user_id = $loged_user['id'];
			$loged_user_r = $loged_user['role_id'];
			$loged_user_name = $loged_user['first_name'];
			$loged_user_lastname = $loged_user['last_name'];
	$sql3 = "SELECT roles.id AS role_id , users.id , roles.role_name AS role_name FROM roles INNER JOIN users ON roles.id = users.role_id WHERE roles.id = '$loged_user_r'";
				
				$results3 = $connection->query($sql3);	
				$loged_user_role_result = $results3->fetch_assoc();
				$loged_user_role = $loged_user_role_result['role_name'];

	
?>