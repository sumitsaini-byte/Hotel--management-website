<?php 

    require('../inc/db-config.php');
    require('../inc/essentials.php');
    adminLogin();

    if(isset($_POST['get_bookings']))
    {
        $querry = "SELECT bo.*, FROM 'booking_order'bo
          INNER JOIN 'booking_details' bd ON bo.booking_id = bd.booking_id
          WHERE bo.booking_status ='booked' AND bo.arrival = 0 ORDER BY bo.booking_id ASC ";

        $res = selectall('booking_order');
        $i=1;
        $table_data ="";
        
        while($data = mysqli_fetch_assoc($res))
        {
            $date = date("d-m-Y",strtotime($data['datentime']));
            $checkin = date("d-m-Y",strtotime($data['check_in']));
            $checkout = date("d-m-Y",strtotime($data['check_out']));

            $table_data .="
             <tr>
              <td>
               <span class='badge bg-primary'>
                Order ID: $data[order_id]
               </span>
               <br>
               <b>Name : </b> $data[user_name]
               <br>
               <b>Phone No: </b> $data[phonenum]
              </td>
              <td>    
               <br>
               <b>Room : </b> $data[room_name]
               <br>
               <b>Price : </b> ₹$data[price]
              </td> 
              <td>
                <b>Check-in:</b>$checkin
                <br>
                <b>Check-out:</b>$checkout
                <br>
                <b>Paid:</b>$data[trans_amt]
                <br>
                <b>Date:</b>$date
               </td>
              <td>
               <button type='button' onclick ='assign_room($data[booking_id])' class='btn text-white btn-sm fm-bold custom-bg shadow-none' data-bs-toggle='modal' data-bs-target='#assign-room'>
                <i class='bi bi-check2-square'></i> Assign Room
               </button>
               <br>
               <button type='button' onclick='cancel_booking($data[booking_id])' class='mt-2 btn btn-outline-danger btn-sm fm-bold shadow-none'>
                <i class='bi bi-trash'></i> Cancel Booking
               </button>
              </td>
             </tr>  
            ";

            $i++;
        }

        echo $table_data;
             
    }


    if(isset($_POST['assign_room']))
    {
        $firm_data = filteration($_POST);

        $query = "UPDATE 'booking_order' bo INNER JOIN 'booking_details' bd
        ON bo.booking_id = bd.booking_id
        SET bo.arrival =?, bo.rate_review=?, bd.room_no =?
        WHERE bo.booking_id=?";

        $values =[1,0,$frm_data['room_no'],$frm_data['booking_id']];

        $res = update($query,$values,'iisi');

        echo ($res==2) ? 1 : 0;
    }


    if(isset($_POST['cancel_booking']))
    {
        $frm_data = filteration($_POST);
        
        $query = "UPDATE 'booking_order' SET 'booking_status'=?,'refund'=? WHERE 'booking_id'=?";
        $values = ['cancelled',0,$frm_data['booking_id']];
        $res = update($query,$values,'sii');

        echo $res; 

    }

?>