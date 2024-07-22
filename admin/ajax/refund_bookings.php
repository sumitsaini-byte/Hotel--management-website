<?php 

    require('../inc/db-config.php');
    require('../inc/essentials.php');
    adminLogin();

    if(isset($_POST['get_bookings']))
    {
        $querry = "SELECT bo.* FROM 'booking_order'bo
          INNER JOIN'booking_details' bd ON bo.booking_id = bd.booking_id
          WHERE bo.booking_status ='booked' AND bo.refund = 0 ORDER BY bo.booking_id ASC ";
 
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
                <b>Room : </b> $data[room_name]
                <br>
                <b>Check-in:</b>$checkin
                <br>
                <b>Check-out:</b>$checkout
                <br>
                <b>Date:</b>$date
               </td>
               <td>
                <b>$data[trans_amt]</b>
               </td>
              <td>
               <button type='button' onclick='refund_booking($data[booking_id])' class=' btn btn-success btn-sm fm-bold shadow-none'>
               <i class='bi bi-cash-stack'></i> Refund
               </button>
              </td>
             </tr>  
            ";

            $i++;
        }

        echo $table_data;
             
    }


    if(isset($_POST['refund_booking']))
    {
        $frm_data = filteration($_POST);
        
        $query = "UPDATE 'booking_order' SET 'refund'=? WHERE 'booking_id'=?";
        $values = [1,$frm_data['booking_id']];
        $res = update($query,$values,'ii');

        echo $res; 

    }

?>