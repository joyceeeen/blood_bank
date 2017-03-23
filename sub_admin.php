<html xmlns="http://www.w3.org/1999/xhtml">
      <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Library</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
           <link rel="shortcut icon" href="images/caatalog.ico">
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
          header("location: catalog_login.php");
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
   
     

          <div class="container" style="margin-left:300px;">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 well well-sm" style="color:green;background-color:#FFFFFF; ">
              <center><legend>Add a Donor</legend></center>
              <form role="form" method="POST" action="../blood_bank/accountProcess.php">
                <?php 

                  if(isset($_SESSION['account_errors']) && $_SESSION['account_errors'] != ''){
                    echo $_SESSION['account_errors'];?>
                    <?php unset($_SESSION['account_errors']);?>
                  <?php }
                ?>
              <div>
              <br>
                <div class="col-xs-6 col-md-6">
                  <label>First Name</label>
                  <input class="form-control" name="fname" placeholder="First Name" type="text"
                    required autofocus />
                </div>

                <div class="col-xs-6 col-md-6">
                  <label>Last Name</label>
                  <input class="form-control" name="lname" placeholder="Last Name" type="text" required />
                </div>
              </div>
              <br> <br> <br> 
              <div class="col-xs-6 col-md-6"><br>
                <label>Civil Status</label>
              <select name="status" class="form-control">
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Divorce">Divorce</option>
                <option value="Complicated">Complicated</option>
              </select>
            </div>

    <div class="col-xs-6 col-md-6">
      <br><label>Birthday</label>
  <input class="form-control" type="date" name="bday" value="<?php echo date('Y-m-d')?>"></div>


                   <label style="margin-left:160px;margin-top:20px;">Email</label> 
              <input class="form-control" name="account_email" required placeholder="Email" type="email" />
               <label style="margin-left:160px;margin-top:20px;">Password</label> 
              <input class="form-control" name="account_password" required placeholder="Password" type="password" />
         <label style="margin-left:160px;margin-top:20px;">Address</label> 
              <input class="form-control" name="address" required placeholder="Address" type="text" />   
              <br>
               <div class="col-xs-6 col-md-6">
     
                  <label>Contact Number</label>
                <input class="form-control" name="contact" placeholder="Contact Number" type="text" required onkeydown='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46'/></div>
            
              <div class="col-xs-6 col-md-6">
              <label>Gender:</label>
              <p style="margin-left:10%">
            <input type="radio" name="gender" id="male" value="male" checked="checked">
            <label for="male">Male</label>
            <br>
            <input type="radio" name="gender" id="female" placeholder="Username" value="female">
            <label for="female">Female</label>
  </p>
</div>
  


  <br>  <br>  <br>  <br>  <br>

             <center><input type="submit" value="Register" class="myButton" ></center>
              </form>
            </div>
          </div>
        </div>
        
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="color: #2E8B57;">Cancel</button>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->
    </body>
</html>
