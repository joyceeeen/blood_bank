<?php

	$name = ''; 
	$connect = mysqli_connect("localhost","root","","blood_bank");
	$call_num = $_POST['c_num'];
	if(isset($_POST['list_recipient'])){
		$name = $_POST['recipient'];
	}
	else{
		$name = $_POST['fname'] . ' ' . $_POST['lname'];
	}
	$update_blood = "UPDATE blood SET remarks = '1', recipient = '".$name."' WHERE call_number = '".$call_num."'";
	$run = mysqli_query($connect,$update_blood);
	$select_type = "SELECT blood_type FROM blood WHERE call_number = '".$call_num."'";
	$result = mysqli_query($connect,$select_type);
	$row = mysqli_fetch_array($result);
	$bloodType = '';
	if($row['blood_type'] == 1){
		$bloodType = 'A+';
	}
	else if($row['blood_type'] == 2){
		$bloodType = 'A-';
	}
	else if($row['blood_type'] == 3){
		$bloodType = 'B+';
	}
	else if($row['blood_type'] == 4){
		$bloodType = 'B-';
	}
	else if($row['blood_type'] == 5){
		$bloodType = 'AB+';
	}
	else if($row['blood_type'] == 6){
		$bloodType = 'AB-';
	}
	else if($row['blood_type'] == 7){
		$bloodType = 'O+';
	}
	else{
		$bloodType = 'O-';
	}
	$notif_message_blood = '<b>Someone Claimed a blood</b>' . '<br>' .'Blood Type : ' .$bloodType .'<br>'.'Recipient : ' .$name;
	$qry4 = "INSERT INTO notifications(type,has_read,notif_message,notif_type_message) VALUES('admin','0','".$notif_message_blood."','success')";
	mysqli_query($connect,$qry4);
	$qry5 = "INSERT INTO notifications(type,has_read,notif_message,notif_type_message) VALUES('sub','0','".$notif_message_blood."','success')";
	mysqli_query($connect,$qry5);
	header("Location: blood_search.php");

?>