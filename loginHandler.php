<?php 
session_start();
require_once 'dbHandler.php';

if (isset($_POST['username']) and isset($_POST['password'])) {
	$username = $_POST['username'];
	$pwd = $_POST['password'];

	$queryUser = "SELECT UserInfo.username FROM UserInfo WHERE UserInfor.username = '$username' AND UserInfo.password = '$pwd'";
	$result = mysqli_query($DBC, $queryUser) or die("Error in querying User!");
	mysqli_close($DBC);

	//echo mysqli_num_rows($result);

	if (mysqli_num_rows($result) === 0) {
		$_SESSION['loginError'] = "Your username or password does NOT exist.";
	} elseif (mysqli_num_rows($result) > 1) {
		die("There are more than one this username exist!");
	} else {
		$_SESSION['username'] = $username;
	}

	header("Location: index.php");
	die();
}
?>