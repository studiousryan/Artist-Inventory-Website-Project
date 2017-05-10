<?php
session_start();
require_once 'dbVars.php';
require_once 'dbHandler.php';
require_once 'tableVars.php';

echo '3';

// if (isset($_POST['loginFormUsername']) and isset($_POST['loginFormPassword'])) {
// 	$username = $_POST['loginFormUsername'];
// 	$password = $_POST['loginFormPassword'];

// 	$query = "SELECT * FROM " . USERTABLE . " WHERE " . USERTABLE . "." . USERNAME . " = '$username' AND " . USERTABLE . "." . PASSWORD . " = '$password';";
// 	$result = mysqli_query($DBC, $query) or die('Error in querying database.');
// 	mysqli_close($DBC);

// 	if (mysqli_num_rows($result) === 0) {
// 		echo '0';
// 	} elseif (mysqli_num_rows($result) === 1) {
// 		$_SESSION['username'] = $username;
// 		echo $_SESSION['username'];
// 	} else {
// 		echo '2';
// 	}
// }
?>