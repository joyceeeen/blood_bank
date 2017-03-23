<?php 
session_start();

	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	$fName = clean($_POST['fname']);
	$lName = clean($_POST['lname']);
	$sTatus = clean($_POST['status']);
	$eMail = clean($_POST['account_email']);
	$pAssword = clean($_POST['account_password']);
	$bDay = clean($_POST['bday']);
	$gEnder = clean($_POST['gender']);
	$aDdress = clean($_POST['address']);
	$cOntact = clean($_POST['contact']);
	$errors = '';

	$connect = mysqli_connect("localhost","root","","blood_bank");

		$if_Email_Exist = "SELECT * FROM catalog_accounts WHERE account_email = '".$eMail."'";
		$runEmail =  mysqli_query($connect,$if_Email_Exist);
		$if_First_Name_Exist = "SELECT * FROM catalog_accounts WHERE account_firstname = '".$fName."'";
		$runFName = mysqli_query($connect,$if_First_Name_Exist);
		$if_Last_Name_Exist = "SELECT * FROM catalog_accounts WHERE account_lastname = '".$lName."'";
		$runLName = mysqli_query($connect,$if_Last_Name_Exist);
	if(mysqli_num_rows($runEmail) > 0){
		$errors .= "<li color:'red'><font color='red'><b>Email ".$eMail." has already been taken</b></font></li>";
	}
	if(mysqli_num_rows($runFName) > 0){
		$errors .= "<li color:'red'><font color='red'><b>First Name ".$fName." already exist!</b></font></li>";
	}
	if(mysqli_num_rows($runLName) > 0){
		$errors .= "<li color:'red'><font color='red'><b>Last Name ".$lName." already exist!</b></font></li>";
	}
	if($bDay == date('Y-m-d')){
		$errors .= "<li color:'red'><font color='red'><b>You cannot have today's date as your birthday</b></font></li>";		
	}
	if($bDay > date('Y-m-d')){
		$errors .= "<li color:'red'><font color='red'><b>".$bDay." has not been pass yet!</b></font></li>";	
	}
	if(strlen($cOntact) != 11){
		$errors .= "<li color:'red'><font color='red'><b>The Contact Number has to be 11 numbers! - ".$cOntact."</b></font></li>";
	}
	if($errors != ''){
		$_SESSION['account_errors'] = $errors;
		header("location:sub_admin.php");
	}
	else{
		$connect = mysqli_connect("localhost","root","","blood_bank");

		$qry2 = "INSERT INTO catalog_accounts(account_email,account_password,account_firstname,account_lastname,account_civil_status,account_birthday,gender,account_contact_number,account_address,type) VALUES('".$eMail."','".md5($pAssword)."','".$fName."','".$lName."','".$sTatus."','".$bDay."','".$gEnder."','".$cOntact."','".$aDdress."','sub')";
		$run = mysqli_query($connect,$qry2);
		$notif_message = '<b>Successfully Created A New Admin</b>' . '<br>' .'Email :'. $eMail .'<br>'.'Password: ' .$pAssword;
		$qry3 = "INSERT INTO notifications(type,has_read,notif_message,notif_type_message) VALUES('admin','0','".$notif_message."','success')";
		$run2 = mysqli_query($connect,$qry3);
		header("location:home.php");


		mysqli_close($connect);

	}
?>