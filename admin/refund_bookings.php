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
    <title>ADMIN PANEL - Refund Bookings</title>
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

<?php require('inc/header.php');?>
<div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <h3 class="md-4">REFUND BOOKINGS</h3>

            <div class="card border-0 shadow-sm mb-4" >
              <div class="card-body"> 
              
              <div class="text-end mb-4">
                 <input type ="text"oninput="refund_bookings(this.value)" class="form-control shadow-none">
              </div>
              
            <div class="table-responsive">
             <table class="table table-hover border">
               <thead>
                <tr class="bg-dark text-light">
                  <th scope="col">#</th>
                  <th scope="col">User Details</th>
                  <th scope="col">Booking Details</th>
                  <th scope="col">Refund Amount</th>
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
  


    <!-- Feature Modal  -->

    <div class="modal fade" id="feature-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form id="feature_s_form">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" >Add Feature</h5>
              </div>
              <div class="modal-body">
                  <div class="mb-3">
                      <label class="form-label fw-bold">Name</label>
                      <input type="text" name="feature_name" class="form-control shadow-none" required>
                  </div>  
              </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                <button type="submit" class="btn btn custom-bg text-white shadow-none">SUBMIT</button>
              </div>
            </div>
          </form>
        </div>
      </div>

<?php require('inc/script.php'); ?>

<script src="scripts/refund_bookings.js"></script>

</body>
</html>               

