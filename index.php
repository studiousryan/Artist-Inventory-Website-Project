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
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
		  		<a class="navbar-brand" href="index.php">Artist Inventory</a>
			</div>
			<ul class="nav navbar-nav navbar-right">
			 	<li class="active"><a href="index.php">Home</a></li>
			 	<li><a href="myInventory.php">My Inventory</a></li>
			 	<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Sample Page<span class="caret"></span></a>
				    <ul class="dropdown-menu">
				     	<li><a href="#">Page 1-1</a></li>
				     	<li><a href="#">Page 1-2</a></li>
				    	<li><a href="#">Page 1-3</a></li>
				    </ul>
				</li>
				<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
		 		<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
			</ul>
		</div>
	</nav>

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