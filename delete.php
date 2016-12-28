<?php
require("db.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$topic_id = $_POST['topic_id'];
	$sql = "DELETE from topic WHERE id = '$topic_id' ";
	$results = $connection->query($sql);
	header("Location: /PHP_Forum/views/home.php");
}
?>