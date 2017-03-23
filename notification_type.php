<html xmlns="http://www.w3.org/1999/xhtml">
      <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Blood Bank - Notifications</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
                       <link rel="shortcut icon" href="images/bllod.ico">
           <link href="assets/bootstrap.css" rel="stylesheet" />
                 <link href="assets/bootstrap.min.css" rel="stylesheet" />
        <script src="assets/jquery.min.js"></script>
        <script src="assets/bootstrap.min.js"></script>
        <link href="styles.css" rel="stylesheet" type="text/css" media="screen" />
        <style >
        .filterable {
            margin-top: 15px;
        }
        .filterable .panel-heading .pull-right {
            margin-top: -20px;
        }
        .filterable .filters input[disabled] {
            background-color: transparent;
            border: none;
            cursor: auto;
            box-shadow: none;
            padding: 0;
            height: auto;
        }
        .filterable .filters input[disabled]::-webkit-input-placeholder {
            color: #333;
        }
        .filterable .filters input[disabled]::-moz-placeholder {
            color: #333;
        }
        .filterable .filters input[disabled]:-ms-input-placeholder {
            color: #333;
        }
        .modal .modal-header {
          border-bottom: none;
          position: relative;
        }
        .modal .modal-header .btn {
          position: absolute;
          top: 0;
          right: 0;
          margin-top: 0;
        }
        .modal .modal-footer {
          border-top: none;
          padding: 0;
        }
        .modal .modal-footer .btn-group > .btn:first-child {
          border-bottom-left-radius: 0;
        }
        .modal .modal-footer .btn-group > .btn:last-child {
          border-top-right-radius: 0;
        }

        </style>
        <script type="text/javascript">
          $(document).ready(function(){
            setInterval(function () {
              $('#notify_me').load('notification.php')
              $('#notification_count').load('notification_count.php')
            }, 1000);
            $('#notif').click(function(){
              $("#notification_count").fadeOut();
            });
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
        <?php $_SESSION['type_message']=$_GET['value'];
            $account_id = $_SESSION['SESS_ACCOUNT_ID'];

            $connect = mysqli_connect("localhost","root","","blood_bank");
            if($account_id == 1){
            $notifs = "SELECT * FROM notifications WHERE type = 'admin' AND has_read = '0' AND notif_type_message = '".$_SESSION['type_message']."' ORDER by notif_id desc";
            }
            else{
              $notifs = "SELECT * FROM notifications WHERE type = 'sub' AND has_read = '0' AND notif_type_message = '".$_SESSION['type_message']."' ORDER by notif_id desc";
            }
            $run = mysqli_query($connect,$notifs);
            if(mysqli_num_rows($run) == 0){
                unset($_SESSION['type_message']);
                header("Location: home.php");
            }

        ?>          	
<div id="notifications_list">
        <?php

$type = $_SESSION['type_message'];  
$styles = '';
        $panel_type = '';
          if($type == "success"){
            $styles = "color:black;margin-left:27%;background-color: #00CC33";
            $panel_type = 'success';
          }
          else if($type == 'notice'){
            $styles = "color:black;margin-left:27%;background-color: #00CCFF";
            $panel_type = 'primary';
          }
          else if($type == 'warning'){
            $styles = "color:black;margin-left:27%;background-color: #FF9933";
            $panel_type = 'warning';
          }
          else{
            $styles = "color:white;margin-left:27%;background-color: #CC0000";
            $panel_type = 'danger';
          }

$account_id = $_SESSION['SESS_ACCOUNT_ID'];

$connect = mysqli_connect("localhost","root","","blood_bank");
if($account_id == 1){
$notifs = "SELECT * FROM notifications WHERE type = 'admin' AND has_read = '0' AND notif_type_message = '".$type."' ORDER by notif_id desc";
}
else{
$notifs = "SELECT * FROM notifications WHERE type = 'sub' AND has_read = '0' AND notif_type_message = '".$type."' ORDER by notif_id desc";
}
$run = mysqli_query($connect,$notifs);
echo "<center>";
echo "<div class='container' style='width:40%;border-radius:5px;height: 590px;overflow-y: auto;'>";
echo "<div class='row'>";
echo "<div class='panel panel-".$panel_type." filterable'>";
echo "<div class='panel-heading'>";
echo "<h3 class='panel-title' style='padding-bottom:5px;'>".ucfirst($type)." Notifications</h3>";
//echo "<div class='pull-right'>";
//echo "<button class='btn btn-default btn-xs btn-filter'>  <span class='glyphicon glyphicon-filter'></span> Filter</button>";
//echo "</div>";
echo "</div>";
echo "</br>";
echo "<table class='table'>";
echo "<thead>";
echo " <tr class='filters'>";
echo "<th><input type='text' class='form-control text-center' placeholder='List of Notifications' disabled></th>";
echo "</tr>";
echo "</thead>";

while($temp = mysqli_fetch_array($run)){
echo "<tr id='hide_".$temp['notif_id']."'>";
echo "<td style='".$styles."'>" . $temp['notif_message'] . "</td>";
echo "<td align='center' style='color:black'><a href='update_notification.php?notif_id=".$temp['notif_id'].",type_message=".$type."' onClick='had_read(".$temp['notif_id'].")' id='type_mess' class='btn btn-".$panel_type."'>Ok</a></td>";
echo "</tr>";
}
echo"</table>"; 
?>
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
    </body>
</html>
<script type="text/javascript"> 
function had_read(id){
    $("#hide_"+id).fadeOut();
}
$(document).ready(function(){
                $("#has-success").fadeTo(3000, 500).slideUp(500, function(){
                });
                $('.filterable .btn-filter').click(function(){
                    var $panel = $(this).parents('.filterable'),
                    $filters = $panel.find('.filters input'),
                    $tbody = $panel.find('.table tbody');
                    if ($filters.prop('disabled') == true) {
                        $filters.prop('disabled', false);
                        $filters.first().focus();
                    } else {
                        $filters.val('').prop('disabled', true);
                        $tbody.find('.no-result').remove();
                        $tbody.find('tr').show();
                    }
                });

                $('.filterable .filters input').keyup(function(e){
                    /* Ignore tab key */
                    var code = e.keyCode || e.which;
                    if (code == '9') return;
                    /* Useful DOM data and selectors */
                    var $input = $(this),
                    inputContent = $input.val().toLowerCase(),
                    $panel = $input.parents('.filterable'),
                    column = $panel.find('.filters th').index($input.parents('th')),
                    $table = $panel.find('.table'),
                    $rows = $table.find('tbody tr');
                    /* Dirtiest filter function ever ;) */
                    var $filteredRows = $rows.filter(function(){
                        var value = $(this).find('td').eq(column).text().toLowerCase();
                        return value.indexOf(inputContent) === -1;
                    });
                    /* Clean previous no-result if exist */
                    $table.find('tbody .no-result').remove();
                    /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
                    $rows.show();
                    $filteredRows.hide();
                    /* Prepend no-result row if all rows are filtered */
                    if ($filteredRows.length === $rows.length) {
                        $table.find('tbody').prepend($('<tr class="no-result text-center" style="color:red"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
                    }
                });
            });
</script>