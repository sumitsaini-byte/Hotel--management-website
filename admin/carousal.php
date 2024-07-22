<?php 
require('inc/essentials.php');
adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN PANEL - carousel</title>
    <?php require('inc/links.php'); ?>
</head>
  
<body class="bg-light">

<?php require('inc/header.php')?>
<div class="container-fluid">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden" id="main-content">
        <h3 class="md-4">carousel</h3>
          

        <!-- carousel Section -->

            <div class="card border-0 shadow-sm mb-4" >
              <div class="card-body">
                    <div class="d-flex allign-item-center justify-content-between mb-3">
                        <h5 class="card-title m-0"> Images</h5>
                        <button type="button " class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#carousel-s">
                        <i class="bi bi-plus-square"></i>ADD
                        </button>
                    </div>

                    <div class="row" id="carousel-data">
                    </div>
              </div>
            </div>

         <!-- carousel Modal  -->

      <div class="modal fade" id="carousel-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form id="carousel_s_form">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" >Add Image</h5>
              </div>
              <div class="modal-body">
            
                  <div class="mb-3">
                  <label class="form-label fw-bold">Picture</label>
                  <input type="file" name="carousel_picture" id="carousel_picture_inp" accept= ".jpg , .png , .jpeg , .webp "  class="form-control shadow-none" required>

                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" onclick="carousel_picture.value=''" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                <button type="submit" class="btn btn custom-bg text-white shadow-none">SUBMIT</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      
    </div>
  </div>
</div>


<?php require('inc/script.php');?>
<script src="scripts/carousel.js"></script>


</body>
</html>