<?php 
	include 'dbVars.php';

	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);

	if (!$dbc) {
		die("Database connection failed!");
	}
?>