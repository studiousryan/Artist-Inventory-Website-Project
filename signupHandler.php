<?php 
session_start();
include 'dbHandler.php';
include 'tableVars.php';

$username = $_POST['formUsername'];
$email = $_POST['formEmail'];
$pwd = $_POST['formPassword'];
$insertion = "INSERT INTO " . USERTABLE . "(" . USERNAME . ", " . EMAIL . ", " . PASSWORD . ") VALUES ('" . $username . "', '" . $email . "', '" . $pwd . "');";

mysqli_query($DBC, $insertion) or die("Error in inserting into database!");
mysqli_close($DBC);

$_SESSION['username'] = $username;

header("Location: myInventory.php");
die();
?>