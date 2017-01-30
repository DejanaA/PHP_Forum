<?php
	require("db.php");
	require("session.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$comment = $_POST['comment'];
	$subtopic_id = $_POST['subtopic_id'];
	$comment_id = $_POST['comment_id'];
	$user_id = $_POST['user_id'];
	
	
if ($comment !="") {
	$sql = "UPDATE comments SET comment_text = '$comment' WHERE id = '$comment_id' ";
	$connection->query($sql);
	header("Location: /PHP_Forum/views/subtopic.php?subtopic=" . $subtopic_id);
	
}

}

?>