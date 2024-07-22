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
       header("location:booking_record.php");
    }
    else
    {
        echo'<script> alert("data not deleted");</script>';

    }
  }
  $id=$_GET['booking_id'];
  $arrival=$_GET['arrival'];
  $q="UPDATE booking_order set arrival='$arrival' where booking_id=$id";
  mysqli_query($con,$q);
  header('location:booking_record.php')

  
 
  ?>