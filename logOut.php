<?php
	//Start session
	session_start();
	
	session_destroy();

	header("location:blood_login.php");
	
?>