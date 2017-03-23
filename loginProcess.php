<?php
session_start();

	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysqli_real_escape_string($str);
	}
	function createSessionId() {

    $chars = "ABCDEFGHIJKMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+~`':;\|-";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;

        while ($i <= 200) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }

        return $pass;

    }
	$email = $_POST['email_add'];
	$password = $_POST['password'];

$connect = mysqli_connect("localhost","root","","blood_bank");


$qry = "SELECT * FROM catalog_accounts WHERE account_email = '".$email."' AND account_password = '".md5($password)."'";
$result=mysqli_query($connect,$qry);

	//Check whether the query was successful or not
	if($result) {
		if(mysqli_num_rows($result) == 1) {
			session_regenerate_id();
			$member = mysqli_fetch_assoc($result);
			$_SESSION['SESS_ACCOUNT_ID'] = $member['account_id'];
			$_SESSION['SESS_FIRST_NAME'] = $member['account_firstname'];
			$_SESSION['SESS_LAST_NAME'] = $member['account_lastname'];
			$_SESSION['SESS_TYPE'] = $member['type'];
			session_write_close();
			header("location: home.php");
		}else {
			$_SESSION['msg'] = 'Invalid Credentials!!.';
			header("location:blood_login.php");
		}
	}else {
		die("Query failed");
	}
?>
