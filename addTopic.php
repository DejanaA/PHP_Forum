<?php
	require("db.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$topic_name = $_POST['topicName'];
$topic_desc = $_POST['topicDescription'];
$user_id = $_POST['userid'];
if ($topic_name !="" and $topic_desc!="") {
	$sql = "INSERT INTO topic (topic_name, description, user_id ) VALUES('$topic_name' , '$topic_desc', '$user_id')";
	$connection->query($sql);
	header("Location: /PHP_Forum/views/home.php");
	
}
}


?>