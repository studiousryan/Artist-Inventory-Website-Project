<?php 
session_start();

include 'dbHandler.php';

$username = $_POST['username'];
$pwd = $_POST['password'];

$queryUser = "SELECT User_Information.username FROM User_Information WHERE User_Information.username = '$username' AND User_Information.user_password = '$pwd'";
$result = mysqli_query($dbc, $queryUser) or die("Error in querying User!");
mysqli_close($dbc);

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
?>