<?php 
session_start();


include 'dbHandler.php';

$username = $_POST['username'];
$pwd = $_POST['password'];

$insertion = "INSERT INTO User_Information (username, user_password) VALUES ('$username', '$pwd')";
mysqli_query($dbc, $insertion) or die("Error in inserting into database!");
mysqli_close($dbc);

$_SESSION['username'] = $username;

header("Location: index.php");
die();
?>