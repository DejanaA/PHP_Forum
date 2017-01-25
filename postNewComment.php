<?php
	require("db.php");
	require("session.php");


	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$subtopic_id = $_POST['subtopic_id'];
		$comment = $_POST['comment'];
		
		if ($comment !="") {
			$sql = "INSERT INTO comments (comment_text, user_id, subtopic_id) VALUES ('$comment' , '$loged_user_id', '$subtopic_id')";
			$connection->query($sql);
			 
			header("Location:/PHP_Forum/views/subtopic.php?subtopic=" . $subtopic_id );
		}

	}
?>