<?php 
require_once 'dbVars.php';
require_once 'dbHandler.php';
require_once 'tableVars.php';

if (isset($_POST['username'])) {
	$username = $_POST['username'];
	$query = "SELECT * FROM " . USERTABLE . " WHERE " . USERTABLE . "." . USERNAME . "='$username';" ;

	$result = mysqli_query($DBC, $query) or die("Error in querying User!");
	mysqli_close($DBC);

	if (mysqli_num_rows($result) > 0) {
		echo "existent";
	} else
		echo "non_existent";
	}
?>