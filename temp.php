<?php
	$con = mysqli_connect('localhost','root','','blood_bank');
	$remarkscategory = $_POST['remarkscategory'];
	$blood_typescategory = $_POST['blood_typescategory'];
	$donorcategory = $_POST['donorcategory'];
	$ifHas = false;
	if($donorcategory == "All"){
	    if($remarkscategory == 10 && $blood_typescategory == 10){
	        $locquery=mysqli_query($con,"select * from blood" ) or die(mysqli_error());  }
	    else if($remarkscategory == 10 && $blood_typescategory == 1){
	        $locquery=mysqli_query($con,"select * from blood where blood_type='1' " ) or die(mysqli_error()); }
	    else if($remarkscategory == 10 && $blood_typescategory == 2){
	        $locquery=mysqli_query($con,"select * from blood where blood_type='2' " ) or die(mysqli_error()); }
	    else if($remarkscategory == 10 && $blood_typescategory == 3){
	        $locquery=mysqli_query($con,"select * from blood where blood_type='3' " ) or die(mysqli_error()); }
	    else if($remarkscategory == 10 && $blood_typescategory == 4){
	        $locquery=mysqli_query($con,"select * from blood where blood_type='4' " ) or die(mysqli_error()); }
	    else if($remarkscategory == 10 && $blood_typescategory == 5){
	        $locquery=mysqli_query($con,"select * from blood where blood_type='5' " ) or die(mysqli_error()); }
	    else if($remarkscategory == 10 && $blood_typescategory == 6){
	        $locquery=mysqli_query($con,"select * from blood where blood_type='6' " ) or die(mysqli_error()); }
	    else if($remarkscategory == 10 && $blood_typescategory == 7){
	        $locquery=mysqli_query($con,"select * from blood where blood_type='7' " ) or die(mysqli_error()); }
	    else if($remarkscategory == 10 && $blood_typescategory == 8){
	        $locquery=mysqli_query($con,"select * from blood where blood_type='8' " ) or die(mysqli_error()); }
	    else if($remarkscategory == 0 && $blood_typescategory == 10){
	        $locquery=mysqli_query($con,"select * from blood where remarks='0'" ) or die(mysqli_error());  }
	    else if($remarkscategory == 1 && $blood_typescategory == 10){
	        $locquery=mysqli_query($con,"select * from blood where remarks='1'" ) or die(mysqli_error());  }
	    else if($remarkscategory == 2 && $blood_typescategory == 10){
	        $locquery=mysqli_query($con,"select * from blood where remarks='2'" ) or die(mysqli_error());  }
	    else{
	        $locquery=mysqli_query($con,"select * from blood where remarks='".$remarkscategory."' and blood_type = '".$blood_typescategory."'" ) or die(mysqli_error());
	    }

	    if(mysqli_num_rows($locquery) > 0){
	    	$ifHas = true;
	    }
	}
	else {
	    if($remarkscategory == 10 && $blood_typescategory == 10){
	        $locquery=mysqli_query($con,"select * from blood WHERE donor = '".$donorcategory."'" ) or die(mysqli_error());  }
	    else if($remarkscategory == 10 && $blood_typescategory == 1){
	        $locquery=mysqli_query($con,"select * from blood where blood_type='1' and donor = '".$donorcategory."'" ) or die(mysqli_error()); }
	    else if($remarkscategory == 10 && $blood_typescategory == 2){
	        $locquery=mysqli_query($con,"select * from blood where blood_type='2' and donor = '".$donorcategory."'" ) or die(mysqli_error()); }
	    else if($remarkscategory == 10 && $blood_typescategory == 3){
	        $locquery=mysqli_query($con,"select * from blood where blood_type='3' and donor = '".$donorcategory."'" ) or die(mysqli_error()); }
	    else if($remarkscategory == 10 && $blood_typescategory == 4){
	        $locquery=mysqli_query($con,"select * from blood where blood_type='4' and donor = '".$donorcategory."'" ) or die(mysqli_error()); }
	    else if($remarkscategory == 10 && $blood_typescategory == 5){
	        $locquery=mysqli_query($con,"select * from blood where blood_type='5' and donor = '".$donorcategory."'" ) or die(mysqli_error()); }
	    else if($remarkscategory == 10 && $blood_typescategory == 6){
	        $locquery=mysqli_query($con,"select * from blood where blood_type='6' and donor = '".$donorcategory."'" ) or die(mysqli_error()); }
	    else if($remarkscategory == 10 && $blood_typescategory == 7){
	        $locquery=mysqli_query($con,"select * from blood where blood_type='7' and donor = '".$donorcategory."'" ) or die(mysqli_error()); }
	    else if($remarkscategory == 10 && $blood_typescategory == 8){
	        $locquery=mysqli_query($con,"select * from blood where blood_type='8' and donor = '".$donorcategory."'" ) or die(mysqli_error()); }
	    else if($remarkscategory == 0 && $blood_typescategory == 10){
	        $locquery=mysqli_query($con,"select * from blood where remarks='0' and donor = '".$donorcategory."'" ) or die(mysqli_error());  }
	    else if($remarkscategory == 1 && $blood_typescategory == 10){
	        $locquery=mysqli_query($con,"select * from blood where remarks='1' and donor = '".$donorcategory."'" ) or die(mysqli_error());  }
	    else if($remarkscategory == 2 && $blood_typescategory == 10){
	        $locquery=mysqli_query($con,"select * from blood where remarks='2' and donor = '".$donorcategory."'" ) or die(mysqli_error());  }
	    else{
	        $locquery=mysqli_query($con,"select * from blood where remarks='".$remarkscategory."' and blood_type = '".$blood_typescategory."' and donor = '".$donorcategory."'" ) or die(mysqli_error());
	    }
	    if(mysqli_num_rows($locquery) > 0){
	    	$ifHas = true;
	    }
	}
	session_start();
	if($ifHas == true){
		$_SESSION['blood_typescategory'] = $blood_typescategory;
		$_SESSION['remarkscategory'] = $remarkscategory;
		$_SESSION['donorcategory'] = $donorcategory;
		header("location:reports\printDetails.php");

 	}
	else{

		$_SESSION['no_entry'] = 'No Results found!';
		header("location:blood_inventory.php");
	}
 ?>
