<?php 
  require('inc/essentials.php');
  require('inc/db-config.php');
  adminLogin();
  $query = "Select * from booking_order";
  $result =mysqli_query($con,$query);
 
   
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN PANEL - USERS</title>
    <?php require('inc/links.php'); ?>
</head>
  
<body class="bg-light">

<?php require('inc/header.php');?>
<div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <h3 class="md-4">BOOKING RECORDS</h3>

            <div class="card border-0 shadow-sm mb-4" >
              <div class="card-body"> 
              
           
            <div class="table-responsive">
             <table class="table table-hover border text-center"style="min_width: 1300px;">
               <thead>
                <tr class="bg-dark text-light">
                  <th scope="col">Booking ID</th>
                  <th scope="col">Room ID</th>
                  <th scope="col">Check IN</th>
                  <th scope="col">Check OUT</th>
                  <th scope="col">Price</th>
                  <th scope="col">cancelation</th>
                  <th scope="col">Arrival status</th>
                  <th scope="col">Booking Status</th>
                  <th scope="col">Action</th>
                </tr>
                <tr>
                <?php
                while($row = mysqli_fetch_assoc($result))
                {  
                    $checkin = date("d-m-Y",strtotime($row['check_in']));
                    $checkout = date("d-m-Y",strtotime($row['check_out']));

               
                  ?>  
                  
                  <td> <?php echo $row['booking_id'] ?></td>
                 <td><?php echo $row['room_id'] ?></td>
                  <td><?php echo $checkin ?></td>
                  <td><?php echo $checkout ?></td>
                  <td><?php echo $row['trans_amt'] ?></td>
                  <td><?php 
                    if($row['cancel']==1){
                      echo '<p>canceled</p>';
                    }
                    else{
                      echo '<p>Not Canceled</p>';
                    }
                    ?>
                    </td>
                  <td>
                    <?php 
                    if($row['cancel']==0){
                    if($row['arrival']==1){
                      echo '<p><a href="delete.php?booking_id='.$row['booking_id'].'&arrival=0" class="btn btn-sm btn-outline-dark shadow-none"><i class="bi bi-file-check"></i></a></p>';
                    }
                    else{
                      echo '<p><a href="delete.php?booking_id='.$row['booking_id'].'&arrival=1" class="btn btn-sm btn-outline-dark shadow-none"><i class="bi bi-person-x"></i></a></p>';
                    }
                  }
                  else {
                    echo '<p>Canceled</p>';
                  }
                     
                    ?> 
                  </td>
                  <td>
                  <?php 
                  if($row['cancel']==0){
                    if($row['booking_status']==1){
                      echo '<p><a href="update.php?booking_id='.$row['booking_id'].'&booking_status=0" class="btn btn-sm btn-outline-dark shadow-none"><i class="bi bi-file-check"></i></a></p>';
                    }
                    else{
                      echo '<p><a href="update.php?booking_id='.$row['booking_id'].'&booking_status=1" class="btn btn-sm btn-outline-dark shadow-none"><i class="bi bi-person-x"></i></a></p>';
                    }
                  }
                  else {
                    echo '<p>Canceled</p>';
                  }
                  ?>
                  </td>
                  <td>
                  <form action="delete.php" method="POST">
                      <input type="hidden" name="id" value="<?php echo $row['booking_id']?>">
                       <input value="DELETE" type="submit" name="delete" class='btn btn-danger shadow-none btn-sm'>
                      <i class='bi bi-trash'></i>
                  </form>
                  </td> 
                </tr>
                 <?php
                  }
                  
                 ?>
               </thead>
              <tbody>
              </tbody>
            </table>
            </div>

           </div>
        </div>
      
    </div>
  </div>
</div>


<?php require('inc/script.php'); ?>

<script src="scripts/booking_record.js"></script>

</body>
</html>               

