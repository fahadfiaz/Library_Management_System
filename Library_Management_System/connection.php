<?php
	//1. create a database connection_aborted
	$dbhost = "localhost";
	$dbuser = "lms";
	$dbpass = "lms";
	$dbname = "lms";
	$connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	
	//test if connection occurred.
	if(mysqli_connect_errno())
	{
		die ("Database connection failed: " . 
					mysqli_connect_error() . 
					 " (" . mysqli_connect_errno(). ")"
					 );
	}
	
	
?>