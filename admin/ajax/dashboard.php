<?php 

    require('../inc/db-config.php');
    require('../inc/essentials.php');
    adminLogin();

    if(isset($_POST['booking_analytics']))
    {
        $frm_data =filteration($_POST);
        $result = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
        COUNT(booking_id) AS `total_bookings`,
        SUM(trans_amt) AS `total_amt`,
        COUNT(CASE WHEN booking_status=1 AND arrival=1 THEN 1 END) AS `active_bookings`,
        SUM(CASE WHEN booking_status=1 AND arrival=1 THEN `trans_amt` END) AS `active_amt`, 
        COUNT(CASE WHEN cancel=1 THEN 1 END) AS `cancelled_bookings`,
        SUM(CASE WHEN cancel=1 THEN `trans_amt` END) AS `cancelled_amt` 
        FROM `booking_order`")); 
      
      $output = json_encode($result);

      echo $output;

    }

    