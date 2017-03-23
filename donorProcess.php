<?php 
session_start();

	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	$age = '';
	$bday = $_POST['bday'];
	$birthday = explode('-', $bday);
	if($bday > date('Y-m-d')){
		$age = date('Y')-$birthday[0];
	}
	else{
		$age = (date('Y')-$birthday[0])-1;	
	}
	$callNumber = clean($_POST['call_number']);
	$dOnor = clean($_POST['donor']);
	$bloodType = clean($_POST['blood_type']);
	$place_of_acq = clean($_POST['place']);
	$nUrse = clean($_POST['nurse_staff']);
	$remarks = '0';
	$Date = date('Y-m-d');
	$expiration_date = date('Y-m-d' , strtotime($Date. ' + 89 days'));
	$before_expire = date('Y-m-d' , strtotime($Date. ' + 82 days'));

	if($bloodType == 'A+'){
		$bloodType = 1;
	}
	else if($bloodType == 'A-'){
		$bloodType = 2;
	}
	else if($bloodType == 'B+'){
		$bloodType = 3;
	}
	else if($bloodType == 'B-'){
		$bloodType = 4;
	}
	else if($bloodType == 'AB+'){
		$bloodType = 5;
	}
	else if($bloodType == 'AB-'){
		$bloodType = 6;
	}
	else if($bloodType == 'O+'){
		$bloodType = 7;
	}
	else if($bloodType == 'O-'){
		$bloodType = 8;
	}
		$connect = mysqli_connect("localhost","root","","blood_bank");

		$insert_blood = "INSERT INTO blood(call_number,blood_type,place_of_acquisition,donor,incharge,expiration_date,remarks,one_week_before_expire,date_entered,age) VALUES('".$callNumber."','".$bloodType."','".$place_of_acq."','".$dOnor."','".$nUrse."','".$expiration_date."','".$remarks."','".$before_expire."','".$Date."','".$age."')";
		mysqli_query($connect,$insert_blood);
		$notif_message_donor = '<b>Inserted A Blood Donor</b>' . '<br>' .'Blood Donor : ' .$dOnor;
		$notif_message_blood = '<b>Added New Blood</b>' . '<br>' .'Blood Type : ' .$_POST['blood_type'];
		$qry4 = "INSERT INTO notifications(type,has_read,notif_message,notif_type_message) VALUES('admin','0','".$notif_message_donor."','notice')";
		mysqli_query($connect,$qry4);
		$qry5 = "INSERT INTO notifications(type,has_read,notif_message,notif_type_message) VALUES('sub','0','".$notif_message_donor."','notice')";
		mysqli_query($connect,$qry5);
		$qry6 = "INSERT INTO notifications(type,has_read,notif_message,notif_type_message) VALUES('admin','0','".$notif_message_blood."','notice')";
		mysqli_query($connect,$qry6);
		$qry7 = "INSERT INTO notifications(type,has_read,notif_message,notif_type_message) VALUES('sub','0','".$notif_message_blood."','notice')";
		mysqli_query($connect,$qry7);
		header("location:blood_search.php");
		mysqli_close($connect);
?>