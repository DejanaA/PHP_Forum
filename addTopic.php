<?php
	require("db.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$topic_name = $_POST['topicName'];
$topic_desc = $_POST['topicDescription'];
if ($topic_name !="" and $topic_desc!="") {
	$sql = "INSERT INTO topic (topic_name, description ) VALUES('$topic_name' , '$topic_desc')";
	$connection->query($sql);
	header("Location: /PHP_Forum/views/home.php");
	
}
}

?>