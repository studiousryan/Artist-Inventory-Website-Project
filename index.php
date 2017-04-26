<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Artist Inventory</title>
</head>
<body>
	<a href="signup.php">Sign up</a><br>
	<a href="logoutHandler.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a>


<?php
if (isset($_SESSION['username'])) {
	echo "Welcome " . $_SESSION['username'] . "!";
} else {
	if (isset($_SESSION['loginError'])) {
		echo "Your username or password does NOT exist. <br>";
	}
	echo "
		<div class='credential-window' id='login-window'>
			<form action='loginHandler.php' method='POST'>
				<input type='text' name='username' placeholder='username'>
				<input type='passsword' name='password' placeholder='password'>
				<button type='submit'><span class='glyphicon glyphicon-log-in'></span> Log in</button>
			</form>
		</div>
	";
}
?>

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="app.js"></script>
</body>
</html>