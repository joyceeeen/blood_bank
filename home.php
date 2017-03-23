
<html xmlns="http://www.w3.org/1999/xhtml">
      <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Home - Blood Bank</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
           <link rel="shortcut icon" href="images/bllod.ico">
           <link href="assets/bootstrap.css" rel="stylesheet" />
           <link href="assets/bootstrap.min.css" rel="stylesheet" />
           <link href="assets/footer.css" rel="stylesheet" />
           <link href="assets/font.css" rel="stylesheet" />
           <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
        <script src="assets/jquery.min.js"></script>
        <script src="assets/bootstrap.min.js"></script>
        <link href="styles.css" rel="stylesheet" type="text/css" media="screen" />
        <script type="text/javascript">
          $(document).ready(function(){
            setInterval(function () {
              $('#notify_me').load('notification.php')
              $('#notification_count').load('notification_count.php')
            }, 1000);
          });
        </script>
    </head>
 <body>
      <?php session_start();
        if(isset($_SESSION['SESS_FIRST_NAME']) == ''){
          header("location: blood_login.php");
        }
       ?>
       <?php
            $connect = mysqli_connect("localhost","root","","blood_bank");
            $date = date('Y-m-d');
            $warning = "SELECT * FROM blood WHERE remarks = '0'";
            $runThis = mysqli_query($connect,$warning);
            $danger = "SELECT * FROM blood WHERE remarks = '0' AND expiration_date = '".$date."'";
            $runME = mysqli_query($connect,$danger);
             
            if(mysqli_num_rows($runThis) > 0){
              while($row = mysqli_fetch_array($runThis)){
                $date1=date_create($row['expiration_date']);
                  $date2=date_create($date);
                  $diff=date_diff($date1,$date2);
                if(date('Y-m-d') == $row['one_week_before_expire'] && date('Y-m-d') < $row['expiration_date']){
                  $bLood_TYpe = '';
                  if($row['blood_type'] == 1){
                    $bLood_TYpe = 'A+';
                  }
                  else if($row['blood_type'] == 2){
                    $bLood_TYpe = 'A-';
                  }
                  else if($row['blood_type'] == 3){
                    $bLood_TYpe = 'B+';
                  }
                  else if($row['blood_type'] == 4){
                    $bLood_TYpe = 'B-';
                  }
                  else if($row['blood_type'] == 5){
                    $bLood_TYpe = 'AB+';
                  }
                  else if($row['blood_type'] == 6){
                    $bLood_TYpe = 'AB-';
                  }
                  else if($row['blood_type'] == 7){
                    $bLood_TYpe = 'O+';
                  }
                  else{
                    $bLood_TYpe = 'O-';
                  }
                  $notif_message = "<b>".$diff->format("%a")." day/s before expiration</b>"."<br>"."Call Number: ".$row['call_number']."<br>"."Blood Type: ".$bLood_TYpe;
                $qry4 = "INSERT INTO notifications(type,has_read,notif_message,notif_type_message) VALUES('admin','0','".$notif_message."','warning')";
                mysqli_query($connect,$qry4);
                $qry5 = "INSERT INTO notifications(type,has_read,notif_message,notif_type_message) VALUES('sub','0','".$notif_message."','warning')";
                mysqli_query($connect,$qry5);
                }    
              }
            }
            if(mysqli_num_rows($runThis) > 0){
              while($row2 = mysqli_fetch_array($runME)){
                  $bLood_TYpe = '';
                  if($row2['blood_type'] == 1){
                    $bLood_TYpe = 'A+';
                  }
                  else if($row2['blood_type'] == 2){
                    $bLood_TYpe = 'A-';
                  }
                  else if($row2['blood_type'] == 3){
                    $bLood_TYpe = 'B+';
                  }
                  else if($row2['blood_type'] == 4){
                    $bLood_TYpe = 'B-';
                  }
                  else if($row2['blood_type'] == 5){
                    $bLood_TYpe = 'AB+';
                  }
                  else if($row2['blood_type'] == 6){
                    $bLood_TYpe = 'AB-';
                  }
                  else if($row2['blood_type'] == 7){
                    $bLood_TYpe = 'O+';
                  }
                  else{
                    $bLood_TYpe = 'O-';
                  }
                  $notif_message = "<b>Blood that expire</b>"."<br>"."Call Number: ".$row2['call_number']."<br>"."Blood Type: ".$bLood_TYpe;
                $qry4 = "INSERT INTO notifications(type,has_read,notif_message,notif_type_message) VALUES('admin','0','".$notif_message."','error')";
                mysqli_query($connect,$qry4);
                $qry5 = "INSERT INTO notifications(type,has_read,notif_message,notif_type_message) VALUES('sub','0','".$notif_message."','error')";
                mysqli_query($connect,$qry5);
                $qry6 = "UPDATE blood SET remarks = '2' WHERE call_number = '".$row2['call_number']."'";
                mysqli_query($connect,$qry6);

              }    
            }
            // if(mysqli_num_rows($runME) > 0){
            //   while($row2 = mysqli_fetch_array($runME)){
            //     $notif_message2 = "<b>User Must Return the book</b>"."<br>"."Borrower: ".$row2['borrower']."<br>"."Title: ".$row2['title']."<br>"."Author: ".$row2['author'];
            //     $qry6 = "INSERT INTO notifications(type,has_read,notif_message,notif_type_message) VALUES('admin','0','".$notif_message2."','error')";
            //     mysqli_query($connect,$qry6);
            //     $qry7 = "INSERT INTO notifications(type,has_read,notif_message,notif_type_message) VALUES('sub','0','".$notif_message2."','error')";
            //     mysqli_query($connect,$qry7);    
            //   }
            // }
            ?>
      <div id="wrap">
        <div id="menu">
          <ul>
            <li><a href="home.php" class="active">Home</a></li>
            <li>    
              <span id="notification_count"></span>
              <a href="#" id="notif" data-toggle="modal" data-target=".notif-modal">Notifications</a>
            </li>
            <li><a href="blood_search.php">Search</a></li>
            <?php if($_SESSION['SESS_TYPE'] == 'main'){?>
            <li><a href="sub_admin.php">Donor</a></li>
            <?php }?>
            <li>
              <a href="blood_inventory.php" style="width:160px">Blood Inventory</a>
            </li>
            <li>
              <a href="logOut.php">Logout</a>
            </li>
          </ul>
        </div>
        <div id="top_padding"></div>
        <div id="prew_img">
        
           <ul class="round">
      <li><img src="images/header2.jpg" alt="" style="padding:5px;
   border:3px solid green;
   background-color:#ff0;"/></li>
      <li><img src="images/header3.jpg" alt="" style="padding:5px;
   border:3px solid green;
   background-color:#ff0;"/></li>
      <li><img src="images/header4.jpg" alt="" style="padding:5px;
   border:3px solid green;
   background-color:#ff0;"/></li>
      <li><img src="images/header5.jpg" alt="" style="padding:5px;
   border:3px solid green;
   background-color:#ff0;"/></li>
      <li><img src="images/header6.jpg" alt="" style="padding:5px;
   border:3px solid green;
   background-color:#ff0;"/></li>
</ul>
<script type="text/javascript" src="lib/jquery.js"></script>
<script type="text/javascript" src="lib/jquery.roundabout.js"></script>
<script type="text/javascript">
      
      $(document).ready(function() {
        $('.round').roundabout();
      });
    
    </script>
        </div>
        <?php
                    if(isset($_SESSION['SESS_COUNT_NOTIF'])){?>
                        <?php if($_SESSION['SESS_COUNT_NOTIF'] > 0){?>
                        <script type="text/javascript">
                          $(document).ready(function(){
                            $("#notification_count").fadeIn();
                          });
                        </script>
                        <?php }
                        unset($_SESSION['SESS_COUNT_NOTIF']);
                        ?>
                    <?php }?>
        <br><br><br>
        <div id="content_top"></div>        
        <div id="content_bg_repeat">
          
          <div class="inside">
              <div class="row-1 outdent">
                <div class="wrapper">
                  <div class="metam1">
                    <!-- .box1 -->
                    <div class="box1" style="height:284px;">
                      <h2>Blood Availability</h2>
                      <h3 style="font-size:16;">
                      <a style="margin-left:15px;">A+ Available</a>
    

          <a style="margin-left: 10px;">A- Available</a>
           <a ></a>
          <br>          <br> <br>
          <a style="margin-left:10px;">B+ Available</a>
          <a style="margin-left: 10px;">B- Available</a>
<br>       <br>    <br>
           <a style="margin-left:0px;">AB+ Not Available</a>
          <a style="margin-left: 5px;">AB- Available</a>
          <br>          <br> <br>
           <a style="margin-left:15px;">O+ Available</a>
          <a style="margin-left: 10px;">O- Not Available</a>
                     </h3>
                    </div>
                    <!-- /.box1 -->
                  </div>
                  <div class="metam2">
                    <!-- .box1 -->
                    <div class="box1">
                      <h2>Mission</h2>
                      <h4>
TO PROVIDE QUALITY PATIENT CARE AND LONGER LIFE EXPECTANCY AMONG PATIENTS WITH INFECTIOUS AND COMMUNICABLE DISEASES THRU AN EFFICIENT AND EFFECTIVE CURATIVE, PREVENTIVE AND PROMOTIVE MANAGEMENT OF THESE DISEASES IN ACCORDANCE WITH THE ACCEPTED STANDARDS OF THE DEPARTMENT OF HEALTH.</h4>
                     
                 
                    </div>
                    <!-- /.box1 -->
                  </div>
                  <div class="metam3">
                    <!-- .box1 -->
                    <div class="box1">
                      <h2>Vision</h2>
                      <h4>
TO BECOME A CENTER OF EXCELLENCE FOR THE PROVISION OF QUALITY PATIENT CARE AMONG PATIENTS WITH INFECTIOUS AND COMMUNICABLE DISEASES, AND BE THE DOH’S ARM IN THE PROMOTIVE AND PREVENTIVE SERVICES RENDERED TO THE GENERAL PUBLIC. </h4>
                    </div>
                    <!-- /.box1 -->
                  </div>
                </div>
              </div>
              <div class="row-2">
                <div class="wrapper">
                  <div class="metam1">
                    <div class="indent">
                      <h2>Prayer</h2>
                     <p>A man there was, tho’ some did count him mad
The more he cast away the more he had.
He that bestows his goods upon the poor.
Shall have as much again, and ten times more.
Da Domine, ut quae ex inmensa bonitate tue nobis
clargiri dignatue eos, in quorum cunque manus deverint,
in tuem simper cedent gloriam.
Amen.</p><p>
(Translation) :  Grant O Lord! That what out of thine
Infinite bounty thou hast vouchsafed to lavish upon us,
into whosoever hands it may devolve may it always be improved
to thy glory.
Amen.</p>
                    </div>
                  </div>
                  <div class="metam2">
                    <div class="indent">
                      <h2>Latest news</h2>
                      <ul class="news">
                        <li>
                          <p class="date">28<span>Jan</span></p>
                         Donate for a cause in PUP                  </li>
                        <li>
                          <p class="date">14<span>June</span></p>
                       World Blood Donor Day              </li>
                        <li>
                          <p class="date">16<span>July</span></p>
                        Start of Volunteer Week                   </li>
                      </ul>
                    
                    </div>
                  </div>
                  <div class="metam3">
                    <div class="indent">
                      <h2>BloodBank Hours</h2>
                      <a href="#">Weekdays</a>
                      <p> 8:00 am - 7:00 pm</p>
                      <a href="#">Weekends</a>
                      <p>8:00 am - 5:00 pm</p>
                      <a href="#">Holidays</a> 
                      <p>12:00 am - 4:00 pm</p>
                   
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
        </div>
   </div>
        <div id="footer_top" style="width:100%;">
           <!-- The content of your page would go here. -->

    <footer class="footer-distributed">

      <div class="footer-left">

       <a  href='#' > <h3 >Blood<span>Bank</span></h3></a>

        <p class="footer-links">
          <a href="#" style="color:white;">A New Way of Innovating Blood Banks</a>
        
        </p>

      </div>

      <div class="footer-center">

        <div>
          <i class="fa fa-map-marker"></i>
          <p style="color:white;"><span >238B Bacood St.</span> Sta. Mesa, Manila</p>
        </div>

        <div>
          <i class="fa fa-phone"></i>
          <p style="color:white;">+9999 9999</p>
        </div>

        <div>
          <i class="fa fa-envelope" ></i>
          <p><a href="mailto:blooadbank@gmail.com" style="color:white;">Bloodbank@gmail.com</a></p>
        </div>

      </div>

      <div class="footer-right">

        <p class="footer-company-about" style="color:white;">
          <span>About the Blood Bank</span>
              <a style="color:white;">Blood Bank's mission is to serve our community by meeting the needs of patients, hospitals, and members for safe, high quality blood products and related services.</a>
        </p>

        <div class="footer-icons" >

          <a href="#" style="color:white;" ><i class="fa fa-facebook"></i></a>
          <a href="#" style="color:white;"><i class="fa fa-twitter"></i></a>
          <a href="#" style="color:white;"><i class="fa fa-google"></i></a>
          <a href="#" style="color:white;"><i class="fa fa-instagram"></i></a>

        </div>

      </div>

    </footer>
  </div>
    <div class="modal fade notif-modal" id="modal_notif" tabindex="-1" role="dialog" aria-labelledby="myForgetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" style="overflow-y: initial !important">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">x</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" style="color:black"><b>Notifications<b></h4>
            </div>
            <div class="modal-body" id="notify_me" style="height: 250px;overflow-y: auto;">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="color: #2E8B57;">Cancel</button>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->
<div class="modal fade messages-modal" id="modal_notif" tabindex="-1" role="dialog" aria-labelledby="myForgetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" style="overflow-y: initial !important">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">x</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" style="color:black"><b>Messages</b></h4>
            </div>
            <div class="modal-body" style="height: 250px;overflow-y: auto;">
                Messages 
                <span id="type-message" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="color: #2E8B57;">Cancel</button>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->
    </body>
</html>
<script type="text/javascript"> 
$(document).ready(function(){
                $("#has-success").fadeTo(3000, 500).slideUp(500, function(){
                });
            });
</script>
