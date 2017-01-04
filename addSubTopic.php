<?php
	require("db.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$topic_id = $_POST['topic_id'];
$sub_topic_name = $_POST['subTopicName'];
if ($sub_topic_name !="" and $topic_id!="") {
	$sql = "INSERT INTO sub_topic (name,topic_id) VALUES('$sub_topic_name' , '$topic_id')";
	$connection->query($sql);
	header("Location: /PHP_Forum/views/topic.php?topic=" . $topic_id);
	
}
}

?>