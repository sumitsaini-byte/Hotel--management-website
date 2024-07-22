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
    <title>ADMIN PANEL - Features & Facilities</title>
    <?php require('inc/links.php'); ?>
</head>
  
<body class="bg-light">

<?php require('inc/header.php')?>
<div class="container-fluid">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden" id="main-content">
        <h3 class="md-4">FEATURES & FACILITIES</h3>

            <div class="card border-0 shadow-sm mb-4" >
              <div class="card-body"> 
                
              <div class="d-flex allign-item-center justify-content-between mb-3">
                  <h5 class="card-title m-8"> Features</h5>
                  <button type="button " class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#feature-s">
                       <i class="bi bi-plus-square"></i>ADD
                      </button>
                    </div>
              
            <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;">
            <table class="table table-hover border">
              <thead>
                <tr class="bg-dark text-light">
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody id="features-data">
              </tbody>
            </table>
            </div>

  </div>
</div>

<div class="card border-0 shadow-sm mb-4" >
              <div class="card-body"> 
                
              <div class="d-flex allign-item-center justify-content-between mb-3">
                  <h5 class="card-title m-8"> Facilities</h5>
                  <button type="button " class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#facility-s">
                       <i class="bi bi-plus-square"></i>ADD
                      </button>
                    </div>
              
            <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;">
            <table class="table table-hover border">
              <thead>
                <tr class="bg-dark text-light">
                  <th scope="col">#</th>
                  <th scope="col">Icon</th>
                  <th scope="col">Name</th>
                  <th scope="col" width="40%">Descripition</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody id="facilities-data">
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

      <!-- Facility Modal -->

      <div class="modal fade" id="facility-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form id="facility_s_form">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" >Add Facility</h5>
              </div>
              <div class="modal-body">
                  <div class="mb-3">
                      <label class="form-label fw-bold">Name</label>
                      <input type="text" name="facility_name" class="form-control shadow-none" required>
                  </div>  
                  <div class="mb-3">
                  <label class="form-label fw-bold">Icon</label>
                  <input type="file" name="facility_icon" accept= ".svg"  class="form-control shadow-none" required>
                  </div>
                  <div class="mb-3">
                       <label class="form-label">Description</label>
                       <textarea name="facility_desc" class="form-control shadow-none" rows="3"></textarea>
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



<?php require('inc/script.php');?>
<script src="scripts/features_facilities.js"></script>

</body>
</html>