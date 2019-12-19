<?php
	// Connect to MySQL
	$conn = mysqli_connect("localhost","root",null,"bookstore");
	
	// Test connection
	if(mysqli_connect_errno())
	{
		echo 'Failed to connect to MySQL: '.mysqli_connect_error();
	}
	
?>