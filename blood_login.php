<head>
      <meta charset="utf-8" />
   <title>Blood Bank</title>
   <link rel="shortcut icon" href="images/bllod.ico">
   <link href="assets/bootstrap.css" rel="stylesheet" />
   <link href="assets/box.css" rel="stylesheet" />
   <link href="assets/bootstrap.min.css" rel="stylesheet" />
     <script src="assets/jquery.min.js"></script>
  <script src="assets/bootstrap.min.js"></script>
  
   <body background="images/bg.jpg">
    <?php session_start();
    if(isset($_SESSION['SESS_FIRST_NAME']) != null){
        header("location: home.php");
    }?>
    <div class="container">
        <div style="margin-top:140px;margin-bottom:20px">
            <?php
        if(isset($_SESSION['msg']) && $_SESSION['msg'] != ''){?>
            <div class="prompt-box" align="center" style="width:30%;margin-left:35%;background:#ffecec url('prompt/error.png') no-repeat 10px 50%;border:1px solid #f5aca6;" id="has-error">
                <b><font size="2em"><span>error: <?php echo $_SESSION['msg'];?></span></font></b>
            </div>
        <?php    unset($_SESSION['msg']);
        }
        ?>
        </div>
        <div class="card card-container">
          <center> <h3 style=" color: #1fa67b; width:100%;">Log in with your email account</h3></center>
            <p id="profile-name" class="profile-name-card"></p>
            <form method="post" action="../blood_bank/loginProcess.php" class="form-signin">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" name="email_add" class="form-control" placeholder="Email address" required autofocus>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
            </br>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" >Login</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
</body>
</html>
<script type="text/javascript"> 
$(document).ready(function(){
                $("#has-error").fadeTo(3000, 500).slideUp(500, function(){
                });
            });
</script>
