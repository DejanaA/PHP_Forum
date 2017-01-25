<?php
	require("db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$topic_id = $_POST['topicId'];
	$subTopic_id = $_POST['subTopicId'];
	$subTopicName = $_POST['subTopicName'];
	
if ($subTopicName !="") {
	$sql = "UPDATE sub_topic SET name = '$subTopicName' WHERE id = '$subTopic_id' ";
	$connection->query($sql);
	header("Location: /PHP_Forum/views/topic.php?topic=" . $topic_id);
	
}

}

?>