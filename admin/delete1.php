<?php
  require('inc/db-config.php');
  if(isset($_POST['delete']))
  {
    $id =$_POST['id'];
    $query ="DELETE FROM booking_order WHERE booking_id='$id' ";
    $query_run = mysqli_query($con,$query);
    
    if($query_run)
    {
       echo'<script> alert("data deleted");</script>';
       header("location:booking_details.php");
    }
    else
    {
        echo'<script> alert("data not deleted");</script>';

    }
  }
 
  
 
  ?>