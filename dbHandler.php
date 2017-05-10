<?php 
require_once 'dbVars.php';
$DBC = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die("Database connection failed!");
?>