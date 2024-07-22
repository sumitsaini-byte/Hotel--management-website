<?php 

    require('../inc/db-config.php');
    require('../inc/essentials.php');
    adminLogin();

    if(isset($_POST['get_bookings']))
    {

        $limit = 10;
        //$page = $frm_data['page'];
        //$start = ($page-1) * $limit;

        $querry = "SELECT bo.*, FROM 'booking_order'bo
          INNER JOIN 'booking_details' bd ON bo.booking_id = bd.booking_id
          WHERE ((bo.booking_status ='booked' AND bo.arrival =1)
          OR (bo.booking_status ='cancelled' AND bo.refund =1)
          OR(bo.booking_status ='payment failed')
          ORDER BY bo.booking_id DESC ";

        $res = selectall('booking_order');
        $i=1;
        $table_data ="";
        
        while($data = mysqli_fetch_assoc($res))
        {
            $date = date("d-m-Y",strtotime($data['datentime']));
            $checkin = date("d-m-Y",strtotime($data['check_in']));
            $checkout = date("d-m-Y",strtotime($data['check_out']));

            if($data['booking_status']=='booked'){
                $status_bg = 'bg-danger';
            }

            else if($data['booking_status']=='cancelled'){
                $status_bg = 'bg-danger';
            }
            else{
                 $status_bg = 'bg-waring text-dark';
            }



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
                <b>Amount:</b>$data[trans_amt]
                <br>
                <b>Date:</b>$date
               </td>
               <td>
               <span class='badge $status_bg'>$data[booking_status]</span>
              </td>
              <td>
               <button type='button' onclick='download($data[booking_id])' class='mt-2 btn btn-outline-danger btn-sm fm-bold shadow-none'>
               <i class=' bi bi-filetype-pdf'></i> 
               </button>
              </td>
             </tr>  
            ";

            $i++;
        }

        echo $table_data;
             
    }

    
?>