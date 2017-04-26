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
	<header>
		<nav>
			<ul>
				<li><a id='btnToLoginPage' href="login.php"><span class="glyphicon glyphicon-log-in"></span> Log in</a></li>
				<li><a id='logoutBtn' href="logoutHandler.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
				<!-- <p id='greeting'>Welcome back, <span>$_SESSION['username']</span>.</p> -->
			</ul>
		</nav>
	</header>

	<div id='mainBody'>
		<div class='credential-window' id='signup-window'>
			<form action='signupHandler.php' method='POST'>
				<p><input type='text' name='username' placeholder=' username'></p>
				<p><input type='passsword' name='password' placeholder=' password'></p>
				<p><input type='passsword' name='confirmedPasssword' placeholder=' confirm password'></p>
				<p><button type='submit' id='signupBtn'>Sign up</button></p>
			</form>
		</div>
	</div>

	


<?php
// if (isset($_SESSION['username'])) {
// 	echo "Welcome " . $_SESSION['username'] . "!";
// } else {
// 	if (isset($_SESSION['loginError'])) {
// 		echo "Your username or password does NOT exist. <br>";
// 		unset($_SESSION['loginError']);
// 	}
// 	echo "
// 		<div class='credential-window' id='login-window'>
// 			<form action='loginHandler.php' method='POST'>
// 				<input type='text' name='username' placeholder='username'>
// 				<input type='passsword' name='password' placeholder='password'>
// 				<button type='submit'><span class='glyphicon glyphicon-log-in'></span> Log in</button>
// 			</form>
// 		</div>
// 	";
// }
?>

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="app.js"></script>
</body>
</html>