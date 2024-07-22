<?php
   
   require('admin/inc/db-config.php');
   require('admin/inc/essentials.php');

date_default_timezone_set("Asia/Kolkata");
session_start();
if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
    redirect('pay_response.php');
}
$TXN_AMOUNT="";

 $user_res = select("SELECT * FROM `user_cred` WHERE `id` = ? LIMIT 1", [$_SESSION['uId']],"i");
$user_data = mysqli_fetch_assoc($user_res);
 

$CUST_ID="";
if(isset($_POST['pay_now'])){
     $frm_data = filteration($_POST);

     $query1 = "INSERT INTO `booking_order`( `user_id`,`room_id`,`room_name`,`user_name`, `phonenum`, `address`, `check_in`, `check_out`,`trans_amt`)  VALUES (?,?,?,?,?,?,?,?,?)";
     insert($query1,[$_SESSION['uId'],$_SESSION['room']['id'],$_SESSION['room']['name'],$frm_data['name'],$frm_data['phonenum'],$frm_data['address'],$frm_data['checkin'],$frm_data['checkout'],$_SESSION['room']['payment']],'iississsi');

  
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        var seconds=0;
        function displayseconds()
        {
            seconds +=1;
        }
        setInterval(displayseconds,1000);
        function redirectpage()
        {
            window.location="pay_response.php"
        }
        setTimeout('redirectpage()',3000);
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processing</title>
</head>
<body>
   
        <h1>Please do not refresh this page ....</h1>
        
</body>
</html>