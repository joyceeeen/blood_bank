<?php
session_start();

$account_id = $_SESSION['SESS_ACCOUNT_ID'];

$connect = mysqli_connect("localhost","root","","blood_bank");
if($account_id == 1){
$check = "SELECT * FROM notifications WHERE type = 'admin' AND has_read = '0' ORDER by notif_id desc";
}
else{
$check = "SELECT * FROM notifications WHERE type <> 'admin' AND has_read = '0' ORDER by notif_id desc";	
}
$result=mysqli_query($connect,$check);
$num = mysqli_num_rows($result);

if(mysqli_num_rows($result) > 0)
{
	    $_SESSION['SESS_COUNT_NOTIF'] = $num;
	    echo $num;  
}
else{
	$_SESSION['SESS_COUNT_NOTIF'] = $num;
}
?>