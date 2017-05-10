<?php
session_start();
require_once 'dbVars.php';
require_once 'dbHandler.php';
require_once 'tableVars.php';

$_SESSION['username'] = 'a';

if (isset($_POST['addWork-submit-btn']) AND isset($_SESSION['username'])) {
	$imageFile = addslashes(file_get_contents($_FILES['imageUploader']['tmp_name']));
	$imageSize = getimagesize($_FILES['imageUploader']['tmp_name']);

	if (!$imageSize) {
		echo "The file you are uploading is not an image.";
	} else {
		$query = "SELECT " . USERTABLE . "." . USERID . " FROM " . USERTABLE . " WHERE " . USERNAME . " = '" . $_SESSION['username'] . "';";
		$result = mysqli_query($DBC, $query) or die("Error in querying User!");
		if (mysqli_num_rows($result) == 1) {
			echo $result;
		} elseif (mysqli_num_rows($result) > 1) {
			mysqli_close($DBC);
			die("Error in querying User!");
		}

		mysqli_close($DBC);
	}


}

// if (  isset($_SESSION['username']) and ) {
// 	$title = $_POST['title'];
// 	$media = $_POST['media'];

// 	echo $title . ' ' . $media;
// } else
// 	echo "User is not logged in.";

?>