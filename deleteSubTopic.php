<?php
require("db.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$subtopic_id = $_POST['subtopic_id'];
	$topic_id = $_POST['topic_id'];


	$sql = "DELETE from sub_topic WHERE id = '$subtopic_id' ";
	$results = $connection->query($sql);
	header("Location: /PHP_Forum/views/topic.php?topic=" . $topic_id);
}
?>