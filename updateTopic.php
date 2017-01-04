<?php
	require("db.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$topic_id = $_POST['topicId'];
	$topicName = $_POST['topicName'];
	$topic_desc = $_POST['topicDescription'];

//die($topic_id . " " . $topicName);
if ($topicName !="" and $topic_desc!="") {
	$sql = "UPDATE topic SET topic_name = '$topicName', description = '$topic_desc' WHERE id = '$topic_id'";
	$connection->query($sql);
	header("Location: /PHP_Forum/views/home.php");
	
}


}
?>