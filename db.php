<?php
$serverName = "localhost";
$username = "root";
$password = "";
$dataBaseName = "PHP_Forum";
$connection = new mysqli($serverName, $username, $password, $dataBaseName);
if ($connection->connect_error) {
	echo "<div class='alert alert-danger'> Something went wrong with database connection <div/>";
	die();
}

?>