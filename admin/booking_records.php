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
    <title>ADMIN PANEL - Booking Records</title>
    <?php require('inc/links.php'); ?>
</head>
  
<body class="bg-light">

<?php require('inc/header.php');?>
<div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <h3 class="md-4">Booking Records</h3>

            <div class="card border-0 shadow-sm mb-4" >
              <div class="card-body"> 
              
              <div class="text-end mb-4">
                 <input type ="text"oninput="get_bookings(this.value)" class="form-control shadow-none">
              </div>
              
            <div class="table-responsive">
             <table class="table table-hover border" style="min-width: 1200px;">
               <thead>
                <tr class="bg-dark text-light">
                  <th scope="col">#</th>
                  <th scope="col">User Details</th>
                  <th scope="col">Room Details</th>
                  <th scope="col">Bookings Details</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
               </thead>
              <tbody id="table-data">
              </tbody>
            </table>
            </div>

           </div>
        </div>
      
    </div>
  </div>
</div>

<<?php require('inc/script.php'); ?>

<script src="scripts/booking_records.js"></script>

</body>
</html>               

