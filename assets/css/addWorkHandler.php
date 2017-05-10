<?php 


include 'dbVars.php';
include 'dbHandler.php';
include 'tableVars.php';

// if (isset($_SESSION['username'])) {
	$title = $_POST['title'];
	$media = $_POST['media'];

	echo $title . ' ' . $media;
// } else
// 	echo "User is not logged in.";

?>