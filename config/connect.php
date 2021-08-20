<?php
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'php_web');

	$link = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
	// Check connection
	if($link->connect_errno){
	    die("ERROR: Could not connect. " . $link->connect_error);
	}
?>