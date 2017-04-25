<?php 
	
	include 'dbHandler.php';

	$username = $_POST['username'];
	$pwd = $_POST['password'];

	echo $username . "<br>";
	echo $pwd;
?>