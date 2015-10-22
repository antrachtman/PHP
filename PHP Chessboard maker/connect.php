<?php
	require_once 'login.php';
	$link = new mysqli($db_hostname, $db_username, $db_password, $db_database);
							   
	if($link -> connect_error) die ("Unable to connect to MySQL: ".mysqli_connect_error());
?>