<html xmlns="http://www.w3.org/1999/xhtml">
      <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Blood Donors</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
           <link rel="shortcut icon" href="images/bllod.ico">
           <link href="assets/bootstrap.css" rel="stylesheet" />
                 <link href="assets/bootstrap.min.css" rel="stylesheet" />
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

  <div id="content_top"></div>  

<div id="content_bg_repeat" style="width:100%">
   
     

                <div class="container" style="margin-left:30%">
          <div >
              <form role="form" align="center" method="POST" action="../blood_bank/donorProcess.php">
          </div>
       
        
  
          <div style="margin-left:0px;width:100%">
            <div class="col-xs-12 col-sm-12 col-md-4 well well-sm" style="color:green;background-color:#FFFFFF; ">
              <center><legend>Blood Details</legend></center>
            
              <div>
                 <center>
                  <?php
                      $connect = mysqli_connect("localhost","root","","blood_bank");
                      $number_of_bloods = "SELECT * FROM blood";
                      $result = mysqli_query($connect,$number_of_bloods);
                  ?>
                  <label>Call Number</label><input class="form-control" name="call_number" placeholder="Genre" type="text" style="width:50%" value="<?php echo date('Y').'-BLOOD-'.(mysqli_num_rows($result)+1);?>"/>
                 </center>
      
      <br>
                <center>  <label>Donor</label></center>
                  <input class="form-control" style="width:50%;margin-left:25%" name="donor" placeholder="Donor" type="text" required /><br>
                  <center>  <label>Blood Type</label></center>
                  <select class="form-control" style="width:40%;margin-left:30%" align="center" name="blood_type">
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                  </select><br>
                  <center>  <label>Birthday</label></center>
                  <input type="date" name="bday" class="form-control" value="<?php echo date('Y-m-d');?>" style="width:45%;margin-left:28%"> 
                    <br>
                    <center>  <label>Place of Acquisition</label></center>
                  <input class="form-control" name="place" placeholder="Place of Acquisition" type="text" required /><br>
                    <center>  <label>Nurse/Staff</label></center>
                  <input class="form-control" name="nurse_staff" style="width:50%;margin-left:25%" placeholder="Nurse/Staff" type="text" required/><br>
                  
                    <input type="submit" value="Add Donor" class="myButton" style="margin-top:1.6px;margin-left:105px;">
                </div>
              </form>
            </div>
          </div>  </div>

</div>
        <div id="content_bottom"></div>
    <div class="modal fade notif-modal" tabindex="-1" role="dialog" aria-labelledby="myForgetModalLabel" aria-hidden="true">
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
    </body>
</html>