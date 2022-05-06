<?php 
	$server = "localhost";
	$user = "root";
	$password = "";
	$database = "db_spk";

	$db = mysqli_connect($server, $user, $password, $database);

	// Check connection
	if ($db -> connect_errno) {
	echo "Failed to connect to database: " . $db -> connect_error;
	exit();
	}
 ?>