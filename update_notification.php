<?php

	session_start();

	$account_id = $_SESSION['SESS_ACCOUNT_ID'];
	$type = $_SESSION['type_message'];  


	$connect = mysqli_connect("localhost","root","","blood_bank");
	$notif_id = $_GET['notif_id'];

	$update_notifics = "UPDATE notifications SET has_read = '1' WHERE notif_id = '".$notif_id."'";
	$run = mysqli_query($connect,$update_notifics); 

	header("Location: notification_type.php?value=$type");


?>