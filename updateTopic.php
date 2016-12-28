<?php
	require("db.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$topic_id = $_POST['topicId'];
	$topicName = $_POST['topicName'];

//die($topic_id . " " . $topicName);
if ($topicName !="") {
	$sql = "UPDATE topic SET topic_name = '$topicName' WHERE id = '$topic_id'";
	$connection->query($sql);
	header("Location: /PHP_Forum/views/home.php");
	
}


}
?>