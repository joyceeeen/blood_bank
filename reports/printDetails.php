<?php
require('fpdf/fpdf.php');
$con = mysqli_connect('localhost','root','','blood_bank');
$date = date("M.d, Y");
$blood_types = "";
session_start();
$remarkscategory = $_SESSION['remarkscategory'];
$blood_typescategory = $_SESSION['blood_typescategory'];
$donorcategory = $_SESSION['donorcategory'];
$remarks = "";



$pdf = new FPDF('L');
$pdf->AddPage();
$pdf->Image('header.png','0','8','295','50');
$pdf->Ln(38);
$pdf->SetFont('Arial','B',9);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',11);
$pdf->Write(15,'                                                                                                       Department of Health');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',11);
$pdf->Write(15,"                                                                                                        St. Luke's Hospital");
$pdf->Ln(8);
$pdf->SetFont('Arial','B',11);
$pdf->Write(15,'                                                                                                                 Taguig');
$pdf->SetFont('Arial','B',11);
$pdf->Ln(8);
$Apositive = mysqli_query($con,"select * from blood where blood_type='1' ") or die(mysql_error());
$numrowsOne = mysqli_num_rows($Apositive);

$Anegative = mysqli_query($con,"select * from blood where blood_type='2' ") or die(mysql_error());
$numrowsTwo = mysqli_num_rows($Anegative);

$Bpositive = mysqli_query($con,"select * from blood where blood_type='3' ") or die(mysql_error());
$numrowsThree = mysqli_num_rows($Bpositive);

$Bnegative = mysqli_query($con,"select * from blood where blood_type='4' ") or die(mysql_error());
$numrowsFour = mysqli_num_rows($Bnegative);

$Opositive = mysqli_query($con,"select * from blood where blood_type='7' ") or die(mysql_error());
$numrowsFive = mysqli_num_rows($Opositive);

$Onegative = mysqli_query($con,"select * from blood where blood_type='8' ") or die(mysql_error());
$numrowsSix = mysqli_num_rows($Onegative);

$ABpositive = mysqli_query($con,"select * from blood where blood_type='5' ") or die(mysql_error());
$numrowsSeven = mysqli_num_rows($ABpositive);

$ABnegative = mysqli_query($con,"select * from blood where blood_type='6' ") or die(mysql_error());
$numrowsEight = mysqli_num_rows($ABnegative);







$pdf->Write(15,'                                                                                                                                                                                                          Blood Availability' );
$pdf->Ln(5);
$pdf->Write(15,'                                                                                                                                                                                                A+     =    '. $numrowsOne . '         AB-     =    '. $numrowsEight );
$pdf->Ln(5);
$pdf->Write(15,'                                                                                                                                                                                                A-      =    '. $numrowsTwo.'         AB+    =    '. $numrowsSeven);
$pdf->Ln(5);
$pdf->Write(15,'                                                                                                                                                                                                B+     =    '. $numrowsThree.'         O-       =    '. $numrowsSix);
$pdf->Ln(5);
$pdf->Write(15,'                                                                                                                                                                                                B-      =    '. $numrowsFour.'         O+      =    '. $numrowsFive);

$pdf->Ln(15);
$pdf->Write(15,'                                                                                                            Blood Inventory');
$pdf->SetFont('Arial','B',11);
$pdf->Ln(8);
$pdf->Write(15,'                                                                                                                     for');
$pdf->Write(10,'                                                                                                                                                                                                                                                   ' . $date);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(13);
if($donorcategory == "All"){
    if($remarkscategory == 10 && $blood_typescategory == 10){
        $locquery=mysqli_query($con,"select * from blood" ) or die(mysql_error());  }
    else if($remarkscategory == 10 && $blood_typescategory == 1){
        $locquery=mysqli_query($con,"select * from blood where blood_type='1' " ) or die(mysql_error()); }
    else if($remarkscategory == 10 && $blood_typescategory == 2){
        $locquery=mysqli_query($con,"select * from blood where blood_type='2' " ) or die(mysql_error()); }
    else if($remarkscategory == 10 && $blood_typescategory == 3){
        $locquery=mysqli_query($con,"select * from blood where blood_type='3' " ) or die(mysql_error()); }
    else if($remarkscategory == 10 && $blood_typescategory == 4){
        $locquery=mysqli_query($con,"select * from blood where blood_type='4' " ) or die(mysql_error()); }
    else if($remarkscategory == 10 && $blood_typescategory == 5){
        $locquery=mysqli_query($con,"select * from blood where blood_type='5' " ) or die(mysql_error()); }
    else if($remarkscategory == 10 && $blood_typescategory == 6){
        $locquery=mysqli_query($con,"select * from blood where blood_type='6' " ) or die(mysql_error()); }
    else if($remarkscategory == 10 && $blood_typescategory == 7){
        $locquery=mysqli_query($con,"select * from blood where blood_type='7' " ) or die(mysql_error()); }
    else if($remarkscategory == 10 && $blood_typescategory == 8){
        $locquery=mysqli_query($con,"select * from blood where blood_type='8' " ) or die(mysql_error()); }
    else if($remarkscategory == 0 && $blood_typescategory == 10){
        $locquery=mysqli_query($con,"select * from blood where remarks='0'" ) or die(mysql_error());  }
    else if($remarkscategory == 1 && $blood_typescategory == 10){
        $locquery=mysqli_query($con,"select * from blood where remarks='1'" ) or die(mysql_error());  }
    else if($remarkscategory == 2 && $blood_typescategory == 10){
        $locquery=mysqli_query($con,"select * from blood where remarks='2'" ) or die(mysql_error());  }
    else{
        $locquery=mysqli_query($con,"select * from blood where remarks='".$remarkscategory."' and blood_type = '".$blood_typescategory."'" ) or die(mysql_error());  }
}
else{
    if($remarkscategory == 10 && $blood_typescategory == 10){
        $locquery=mysqli_query($con,"select * from blood WHERE donor = '".$donorcategory."'" ) or die(mysql_error());  }
    else if($remarkscategory == 10 && $blood_typescategory == 1){
        $locquery=mysqli_query($con,"select * from blood where blood_type='1' and donor = '".$donorcategory."'" ) or die(mysql_error()); }
    else if($remarkscategory == 10 && $blood_typescategory == 2){
        $locquery=mysqli_query($con,"select * from blood where blood_type='2' and donor = '".$donorcategory."'" ) or die(mysql_error()); }
    else if($remarkscategory == 10 && $blood_typescategory == 3){
        $locquery=mysqli_query($con,"select * from blood where blood_type='3' and donor = '".$donorcategory."'" ) or die(mysql_error()); }
    else if($remarkscategory == 10 && $blood_typescategory == 4){
        $locquery=mysqli_query($con,"select * from blood where blood_type='4' and donor = '".$donorcategory."'" ) or die(mysql_error()); }
    else if($remarkscategory == 10 && $blood_typescategory == 5){
        $locquery=mysqli_query($con,"select * from blood where blood_type='5' and donor = '".$donorcategory."'" ) or die(mysql_error()); }
    else if($remarkscategory == 10 && $blood_typescategory == 6){
        $locquery=mysqli_query($con,"select * from blood where blood_type='6' and donor = '".$donorcategory."'" ) or die(mysql_error()); }
    else if($remarkscategory == 10 && $blood_typescategory == 7){
        $locquery=mysqli_query($con,"select * from blood where blood_type='7' and donor = '".$donorcategory."'" ) or die(mysql_error()); }
    else if($remarkscategory == 10 && $blood_typescategory == 8){
        $locquery=mysqli_query($con,"select * from blood where blood_type='8' and donor = '".$donorcategory."'" ) or die(mysql_error()); }
    else if($remarkscategory == 0 && $blood_typescategory == 10){
        $locquery=mysqli_query($con,"select * from blood where remarks='0' and donor = '".$donorcategory."'" ) or die(mysql_error());  }
    else if($remarkscategory == 1 && $blood_typescategory == 10){
        $locquery=mysqli_query($con,"select * from blood where remarks='1' and donor = '".$donorcategory."'" ) or die(mysql_error());  }
    else if($remarkscategory == 2 && $blood_typescategory == 10){
        $locquery=mysqli_query($con,"select * from blood where remarks='2' and donor = '".$donorcategory."'" ) or die(mysql_error());  }
    else{
        $locquery=mysqli_query($con,"select * from blood where remarks='".$remarkscategory."' and blood_type = '".$blood_typescategory."' and donor = '".$donorcategory."'" ) or die(mysql_error());  }
}


$pdf->Write(12,'               ');
    $pdf->Cell(30, 6, 'Call Number', 1, 0, 'C');
    $pdf->Cell(30, 6, 'Blood type', 1, 0, 'C');
    $pdf->Cell(50, 6, 'Place of Acquisition', 1, 0, 'C');
    $pdf->Cell(40, 6, 'Expiration date', 1, 0, 'C');
    $pdf->Cell(30, 6, 'Remarks', 1, 0, 'C');
    $pdf->Cell(30, 6, 'Nurse/Staff', 1, 0, 'C');
    $pdf->Cell(30, 6, 'Donor', 1, 0, 'C');



        $pdf->Ln(6);

$pdf->SetFont('Arial', '', 6);
while($locrow=mysqli_fetch_array($locquery))
{

    if($locrow['remarks'] == 0){
    $remarks = "Available";
}
else if($locrow['remarks'] == 1){
    $remarks = "Claimed";
}
else if($locrow['remarks'] == 2){
    $remarks = "Expired";
}


if($locrow['blood_type'] == 1){
    $blood_types = "A+";
}
else if($locrow['blood_type'] == 2){
    $blood_types = "A-";
}
else if($locrow['blood_type'] == 3){
    $blood_types = "B+";
}
else if($locrow['blood_type'] == 4){
    $blood_types = "B-";
}
else if($locrow['blood_type'] == 5){
    $blood_types = "AB+";
}
else if($locrow['blood_type'] == 6){
    $blood_types = "AB-";
}
else if($locrow['blood_type'] == 7){
    $blood_types = "O+";
}
else if($locrow['blood_type'] == 8){
    $blood_types = "O-";
}



    $pdf->Write(12,'                              ');
    $pdf->Cell(30, 6, $locrow['call_number'], 1, 0, 'C');
    $pdf->Cell(30, 6, $blood_types, 1, 0, 'C');
    $pdf->Cell(50, 6, $locrow['place_of_acquisition'], 1, 0, 'C');
    $pdf->Cell(40, 6, $locrow['expiration_date'], 1, 0, 'C');
    $pdf->Cell(30, 6, $remarks, 1, 0, 'C');
    $pdf->Cell(30, 6, $locrow['incharge'], 1, 0, 'C');
    $pdf->Cell(30, 6, $locrow['donor'], 1, 0, 'C');
        $pdf->Ln(6);
}

$pdf->Ln(8);
$pdf->Ln(8);
$pdf->Ln(8);





$pdf->Output();
?>
