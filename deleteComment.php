<?php
	require("db.php");
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$comment_id = $_POST['comment_id'];
		$subtopic_id = $_POST['subtopic_id'];
		$sql = "DELETE FROM comments WHERE id = '$comment_id'";
		$results = $connection->query($sql);
		header("Location:/PHP_Forum/views/subtopic.php?subtopic=" . $subtopic_id );
	}
?>