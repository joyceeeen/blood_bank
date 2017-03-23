<html xmlns="http://www.w3.org/1999/xhtml">
      <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Add Recipient</title>
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
            <li><a href="sub_admin.php">Account</a></li>
            <?php }?>
            <li>
              <a href="blood_inventory.php" style="width:160px">Blood Inventory</a>
            </li>
            <li>
              <a href="logOut.php">Logout</a>
            </li>
          </ul>
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
        <div id="content_top" style="margin-top:5%"></div>        
        <div id="content_bg_repeat">
          <div style="width:100%" align="center">
            <form action="../blood_bank/update_recipient.php" method="POST">
              <?php 
                  if(isset($_SESSION['recipient_errors']) && $_SESSION['recipient_errors'] != ''){
                    echo $_SESSION['recipient_errors'];
                    unset($_SESSION['recipient_errors']);
                  } 
              $call_Number = $_GET['call_number'];
              $connect = mysqli_connect("localhost","root","","blood_bank");
              $find_recipients = "SELECT DISTINCT(recipient) FROM blood WHERE recipient != '' ";
              $result = mysqli_query($connect,$find_recipients);?>
              <?php if(mysqli_num_rows($result) > 0){?>
                <label style="font-size:20px">Choose from the list of Recipients</label>
                <select name="recipient" class="form-control" style="width:250px;margin-bottom:10px">?>
                        <?php while($row = mysqli_fetch_array($result)){?>
                          <option value="<?php echo $row['recipient'];?>" ><?php echo $row['recipient'];?></option>
                        <?php }?>
                </select>
                <input type="hidden" name="c_num" value="<?php echo $call_Number;?>">
                <input type="hidden" name="list_recipient" value="list">
                <button class="btn btn-primary btn-lg">Submit</button>
                <h3 style="margin-top:2%">OR</h3>
                <?php }?>
            </form>
            <br>
            <h5 style="text-align:center">Click the picture to add New Recipient</h5>
            <a href="#" data-target=".add-recipient" data-toggle="modal"><img src="images/recipient.jpg" style=" margin-top:1%"></a>
          </div>
          </div>
        <div id="content_bottom"></div>
        
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
<div class="modal fade add-recipient" id="modal_notif" tabindex="-1" role="dialog" aria-labelledby="myForgetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" style="overflow-y: initial !important">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">x</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" style="color:black"><b>New Recipient</b></h4>
            </div>
            <div class="modal-body" style="height:200px;overflow-y: auto;">
                 
                <form action="../blood_bank/update_recipient.php" method="POST">
                  <label style="color:black">First Name</label>
                  <input type="text" name="fname" required class="form-control">
                  <label style="color:black">Last Name</label>
                  <input type="text" name="lname" required class="form-control">
                  <input type="hidden" name="c_num" value="<?php echo $call_Number;?>">
                  <br>
                  <button class="myButton" style="margin-left:30%">Add</button> 
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="color: #2E8B57;">Cancel</button>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->
    </body>
</html>
