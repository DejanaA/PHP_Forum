<?php
	require("db.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$topic_name = $_POST['topicName'];
if ($topic_name !="") {
	$sql = "INSERT INTO topic (topic_name) VALUES('$topic_name')";
	$connection->query($sql);
	header("Location: /PHP_Forum/views/home.php");
	
}
}

?>