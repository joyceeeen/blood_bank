<?php 
	mysql_connect('localhost','root','');
	mysql_select_db('blood_bank');
	$remarkscategory = $_POST['remarkscategory'];
	$blood_typescategory = $_POST['blood_typescategory'];
	$donorcategory = $_POST['donorcategory'];
	$ifHas = false;
	if($donorcategory == "All"){
	    if($remarkscategory == 10 && $blood_typescategory == 10){
	        $locquery=mysql_query("select * from blood" ) or die(mysql_error());  }          
	    else if($remarkscategory == 10 && $blood_typescategory == 1){
	        $locquery=mysql_query("select * from blood where blood_type='1' " ) or die(mysql_error()); }            
	    else if($remarkscategory == 10 && $blood_typescategory == 2){
	        $locquery=mysql_query("select * from blood where blood_type='2' " ) or die(mysql_error()); }           
	    else if($remarkscategory == 10 && $blood_typescategory == 3){
	        $locquery=mysql_query("select * from blood where blood_type='3' " ) or die(mysql_error()); }           
	    else if($remarkscategory == 10 && $blood_typescategory == 4){
	        $locquery=mysql_query("select * from blood where blood_type='4' " ) or die(mysql_error()); }            
	    else if($remarkscategory == 10 && $blood_typescategory == 5){
	        $locquery=mysql_query("select * from blood where blood_type='5' " ) or die(mysql_error()); }            
	    else if($remarkscategory == 10 && $blood_typescategory == 6){
	        $locquery=mysql_query("select * from blood where blood_type='6' " ) or die(mysql_error()); }            
	    else if($remarkscategory == 10 && $blood_typescategory == 7){
	        $locquery=mysql_query("select * from blood where blood_type='7' " ) or die(mysql_error()); }            
	    else if($remarkscategory == 10 && $blood_typescategory == 8){
	        $locquery=mysql_query("select * from blood where blood_type='8' " ) or die(mysql_error()); }            
	    else if($remarkscategory == 0 && $blood_typescategory == 10){
	        $locquery=mysql_query("select * from blood where remarks='0'" ) or die(mysql_error());  }            
	    else if($remarkscategory == 1 && $blood_typescategory == 10){
	        $locquery=mysql_query("select * from blood where remarks='1'" ) or die(mysql_error());  }          
	    else if($remarkscategory == 2 && $blood_typescategory == 10){
	        $locquery=mysql_query("select * from blood where remarks='2'" ) or die(mysql_error());  }          
	    else{
	        $locquery=mysql_query("select * from blood where remarks='".$remarkscategory."' and blood_type = '".$blood_typescategory."'" ) or die(mysql_error());  
	    }

	    if(mysql_num_rows($locquery) > 0){
	    	$ifHas = true;
	    }
	}
	else {
	    if($remarkscategory == 10 && $blood_typescategory == 10){
	        $locquery=mysql_query("select * from blood WHERE donor = '".$donorcategory."'" ) or die(mysql_error());  }          
	    else if($remarkscategory == 10 && $blood_typescategory == 1){
	        $locquery=mysql_query("select * from blood where blood_type='1' and donor = '".$donorcategory."'" ) or die(mysql_error()); }            
	    else if($remarkscategory == 10 && $blood_typescategory == 2){
	        $locquery=mysql_query("select * from blood where blood_type='2' and donor = '".$donorcategory."'" ) or die(mysql_error()); }           
	    else if($remarkscategory == 10 && $blood_typescategory == 3){
	        $locquery=mysql_query("select * from blood where blood_type='3' and donor = '".$donorcategory."'" ) or die(mysql_error()); }           
	    else if($remarkscategory == 10 && $blood_typescategory == 4){
	        $locquery=mysql_query("select * from blood where blood_type='4' and donor = '".$donorcategory."'" ) or die(mysql_error()); }            
	    else if($remarkscategory == 10 && $blood_typescategory == 5){
	        $locquery=mysql_query("select * from blood where blood_type='5' and donor = '".$donorcategory."'" ) or die(mysql_error()); }            
	    else if($remarkscategory == 10 && $blood_typescategory == 6){
	        $locquery=mysql_query("select * from blood where blood_type='6' and donor = '".$donorcategory."'" ) or die(mysql_error()); }            
	    else if($remarkscategory == 10 && $blood_typescategory == 7){
	        $locquery=mysql_query("select * from blood where blood_type='7' and donor = '".$donorcategory."'" ) or die(mysql_error()); }            
	    else if($remarkscategory == 10 && $blood_typescategory == 8){
	        $locquery=mysql_query("select * from blood where blood_type='8' and donor = '".$donorcategory."'" ) or die(mysql_error()); }            
	    else if($remarkscategory == 0 && $blood_typescategory == 10){
	        $locquery=mysql_query("select * from blood where remarks='0' and donor = '".$donorcategory."'" ) or die(mysql_error());  }            
	    else if($remarkscategory == 1 && $blood_typescategory == 10){
	        $locquery=mysql_query("select * from blood where remarks='1' and donor = '".$donorcategory."'" ) or die(mysql_error());  }          
	    else if($remarkscategory == 2 && $blood_typescategory == 10){
	        $locquery=mysql_query("select * from blood where remarks='2' and donor = '".$donorcategory."'" ) or die(mysql_error());  }          
	    else{
	        $locquery=mysql_query("select * from blood where remarks='".$remarkscategory."' and blood_type = '".$blood_typescategory."' and donor = '".$donorcategory."'" ) or die(mysql_error());  
	    }
	    if(mysql_num_rows($locquery) > 0){
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