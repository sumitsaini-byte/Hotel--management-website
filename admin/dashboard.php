<?php 
require('inc/essentials.php');
require('inc/db-config.php');
  adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN PANEL - dashboard</title>
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

<?php 
require('inc/header.php');

 $is_shutdown = mysqli_fetch_assoc(mysqli_query($con,"SELECT `shutdown` FROM `settings`"));
 $current_users = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
 COUNT(id) AS `total`,
 COUNT(CASE WHEN `status`=1 THEN 1 END) AS `active`,
 COUNT(CASE WHEN `status`=0 THEN 1 END) AS `inactive`
  FROM `user_cred`")); 

 $current_bookings = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(CASE WHEN booking_status=1 AND arrival=0 THEN 1 END) AS `new_bookings` FROM `booking_order`")); 
 
 $unread_queries = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(sr_no) AS `count` FROM `user_queries` WHERE `seen`=0"));

?>
<div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden" id="main-content">
         <div class="d-flex align-items-center justify-content-between mb-4">
          <h3 class="mb-0 fs-5 fw-bold">DASHBOARD</h3>
          <?php
          if($is_shutdown['shutdown']){
            echo<<<data
            <h6 class="badge bg-danger py-2 px-3 rounded">shut down mode is active</h6>
            data;
          }
          ?>
         </div>

         <div class="row mb-4">
          <div class="col-md-3 mb-4">
            <a href="booking_details.php"  class="text-decoration-none">
              <div class="card text-center p-3 text-success">
                <h6>NEW BOOKINGS</h6>
                <h1 class="mt-2 mb-0"><?php echo $current_bookings['new_bookings'] ?></h1>
              </div>
            </a>
          </div>
          
          <div class="col-md-3 mb-4">
            <a href="user_queries.php"  class="text-decoration-none">
              <div class="card text-center p-3 text-info">
                <h6>USER QUERIES</h6>
                <h1 class="mt-2 mb-0"><?php echo $unread_queries['count']?></h1>
              </div>
            </a>
          </div>

          <div class="col-md-3 mb-4">
            <a href="users.php"  class="text-decoration-none">
              <div class="card text-center p-3 text-warning">
                <h6>USERS</h6>
                <h1 class="mt-2 mb-0"><?php echo $current_users['total'] ?></h1>
              </div>
            </a>
          </div>
         </div>

          <div class="d-flex align-items-center justify-content-between mb-4">           
            <h5>BOOKING ANALYTICS</h5>
          </div>
          
          
         <div class="row mb-3">

          <div class="col-md-3 mb-4">
               <a href="booking_details.php"  class="text-decoration-none">
                <div class="card text-center p-3 text-primary">
                <h6>TOTAL BOOKINGS</h6>
                <h1 class="mt-2 mb-0" id="total_bookings">0</h1>
                <h4 class="mt-2 mb-0" id="total_amt">₹0</h4>
                </div>
               </a>
          </div>
          <div class="col-md-3 mb-4">
          <a href="booking_record.php"  class="text-decoration-none">

              <div class="card text-center p-3 text-success">
                <h6>ACTIVE BOOKINGS</h6>
                <h1 class="mt-2 mb-0" id="active_bookings">0</h1>
                <h4 class="mt-2 mb-0" id="active_amt">₹0</h4>
              </div>
              </a>

          </div>
          <div class="col-md-3 mb-4">
          <a href="booking_record.php"  class="text-decoration-none">

              <div class="card text-center p-3 text-primary">
                <h6>CANCELLED BOOKINGS</h6>
                <h1 class="mt-2 mb-0" id="cancelled_bookings">0</h1>
                <h4 class="mt-2 mb-0" id="cancelled_amt"></h4>
              </div>
              </a>

          </div>
         
         </div>

        <h5>USERS</h5>
        <div class="row mb-3">

          <div class="col-md-3 mb-4">
          <a href="users.php"  class="text-decoration-none">

              <div class="card text-center p-3 text-info">
                <h6>TOTAL USERS</h6>
                <h1 class="mt-2 mb-0"><?php echo $current_users['total'] ?></h1>
              </div>
              </a>

          </div>
          <div class="col-md-3 mb-4">
          <a href="users.php"  class="text-decoration-none">

              <div class="card text-center p-3 text-success">
                <h6>ACTIVE USERS</h6>
                <h1 class="mt-2 mb-0"><?php echo $current_users['active'] ?></h1>
              </div>
              </a>

          </div>
          <div class="col-md-3 mb-4">
          <a href="users.php"  class="text-decoration-none">

              <div class="card text-center p-3 text-warning">
                <h6>INACTIVE USERS</h6>
                <h1 class="mt-2 mb-0"><?php echo $current_users['inactive'] ?></h1>
              </div>
              </a>

          </div>

        </div>

      </div>
    </div>
</div>
<?php require('inc/script.php'); ?>
<script src="scripts/dashboard.js"></script>
</body>
</html>