<?php
session_start();

$account_id = $_SESSION['SESS_ACCOUNT_ID'];

$connect = mysqli_connect("localhost","root","","blood_bank");
if($account_id == 1){
$notif_success_count = "SELECT * FROM notifications WHERE type = 'admin' AND has_read = '0' AND notif_type_message = 'success' ORDER by notif_id desc";
$notif_notice_count = "SELECT * FROM notifications WHERE type = 'admin' AND has_read = '0' AND notif_type_message = 'notice' ORDER by notif_id desc";
$notif_warning_count = "SELECT * FROM notifications WHERE type = 'admin' AND has_read = '0' AND notif_type_message = 'warning' ORDER by notif_id desc";
$notif_error_count = "SELECT * FROM notifications WHERE type = 'admin' AND has_read = '0' AND notif_type_message = 'error' ORDER by notif_id desc";
}
else{
$notif_success_count = "SELECT * FROM notifications WHERE type = 'sub' AND has_read = '0' AND notif_type_message = 'success' ORDER by notif_id desc";
$notif_notice_count = "SELECT * FROM notifications WHERE type = 'sub' AND has_read = '0' AND notif_type_message = 'notice' ORDER by notif_id desc";
$notif_warning_count = "SELECT * FROM notifications WHERE type = 'sub' AND has_read = '0' AND notif_type_message = 'warning' ORDER by notif_id desc";
$notif_error_count = "SELECT * FROM notifications WHERE type = 'sub' AND has_read = '0' AND notif_type_message = 'error' ORDER by notif_id desc";
}
$result_success=mysqli_query($connect,$notif_success_count);
$result_notice=mysqli_query($connect,$notif_notice_count);
$result_warning=mysqli_query($connect,$notif_warning_count);
$result_error=mysqli_query($connect,$notif_error_count);
$title_success = '';
$title_notice = '';
$title_warning = '';
$title_error = '';
if(mysqli_num_rows($result_success) > 0){
    $title_success = "Click for New Success Messages!";
}
else if(mysqli_num_rows($result_success) == 0){
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
            document.getElementById('div-success').style.pointerEvents = 'none';
          });
    </script>
<?php }
if(mysqli_num_rows($result_notice) > 0){
    $title_notice = "Click for New Notice Messages!";
}

else if(mysqli_num_rows($result_notice) == 0){
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
            document.getElementById('div-notice').style.pointerEvents = 'none';
          });
    </script>
<?php }
if(mysqli_num_rows($result_warning) > 0){
    $title_warning = "Click for New Warning Messages!";
}

else if(mysqli_num_rows($result_warning) == 0){
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
            document.getElementById('div-warning').style.pointerEvents = 'none';
          });
    </script>
<?php }
if(mysqli_num_rows($result_error) > 0){
    $title_error = "Click for New Error Messages!";
}

else if(mysqli_num_rows($result_error) == 0){
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
            document.getElementById('div-error').style.pointerEvents = 'none';
          });
    </script>
<?php }
    ?>
        <div class="prompt-box" id="div-success" style="display: block;background:#e9ffd9 url('prompt/success.png') no-repeat 10px 50%;
    border:1px solid #a6ca8a;cursor: pointer;" title="<?php echo $title_success;?>" onclick="location.href='notification_type.php?value=success';">
                &emsp;<b><font size="1em" value="" color="black"><?php echo 'Success Message';?>
                <?php 
                    if(mysqli_num_rows($result_success) > 0){?>
                <span style="color:white;margin-left:27%;background-color: #00FF00;
border-radius: 9px;font-size: 11px;padding: 3px 7px 3px 7px;"><?php echo mysqli_num_rows($result_success);?></span>
<?php }?>
</font></b>
            </div>
            <br>
            <div class="prompt-box" id="div-notice" style="display: block;background:#e3f7fc url('prompt/notice.png') no-repeat 10px 50%;
    border:1px solid #8ed9f6;cursor: pointer;" title="<?php echo $title_notice;?>" onclick="location.href='notification_type.php?value=notice';">
                &emsp;<b><font size="1em" color="black"><?php echo 'Notice Message';?>
                <?php 
                    if(mysqli_num_rows($result_notice) > 0){?>
                <span style="color:white;margin-left:31%;background-color: #0000FF;
border-radius: 9px;font-size: 11px;padding: 3px 7px 3px 7px;"><?php echo mysqli_num_rows($result_notice);?></span>
<?php }?>
</font></b>
            </div>
            <br>
        <div class="prompt-box" id="div-warning" style="display: block;background:#fff8c4 url('prompt/warning.png') no-repeat 10px 50%;
    border:1px solid #f2c779;cursor: pointer;" title="<?php echo $title_warning;?>" onclick="location.href='notification_type.php?value=warning';">
                &emsp;<b><font size="1em" color="black"><?php echo 'Warning Message';?>
                <?php 
                    if(mysqli_num_rows($result_warning) > 0){?>
                <span style="color:white;margin-left:26%;background-color: #FF4500;
border-radius: 9px;font-size: 11px;padding: 3px 7px 3px 7px;"><?php echo mysqli_num_rows($result_warning);?></span>
<?php }?>
</font></b>
            </div>
            <br>
        <div class="prompt-box" id="div-error" style="display: block;background:#ffecec url('prompt/error.png') no-repeat 10px 50%;
    border:1px solid #f5aca6;cursor: pointer;" title="<?php echo $title_error;?>" onclick="location.href='notification_type.php?value=error';">
                &emsp;<b><font size="1em" color="black"><?php echo 'Error Message';?>
                <?php 
                    if(mysqli_num_rows($result_error) > 0){?>
                <span style="color:white;margin-left:35%;background-color: #FF0000;
border-radius: 9px;font-size: 11px;padding: 3px 7px 3px 7px;"><?php echo mysqli_num_rows($result_error);?></span>
<?php }?>
</font></b>
            </div>