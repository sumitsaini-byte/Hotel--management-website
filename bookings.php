<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
 
<?php require('inc/links.php'); ?>
<title><?php echo $settings_r['site_title'] ?> - BOOKING</title>


</head>
<body class="bg-light">
   
    <?php require('inc/header.php'); 
    if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
        redirect('rooms.php');}
    ?>

   

    

    <div class="container">
        <div class="row">

            <div class="col-12 my-5 px-4">
                <h2 class="fw-bold">BOOKING</h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                    <span class="text-secondary"> > </span>
                    <a href="#" class="text-secondary text-decoration-none">BOOKINGS</a> 
                </div>
            </div>


          

            <?php
                $query = "SELECT * FROM `booking_order`
                WHERE booking_status= '0'  AND user_id=? OR booking_status= '1' AND user_id=? ORDER BY booking_id DESC";

                $result = select($query,[$_SESSION['uId'],$_SESSION['uId']],'ii');
                while($data = mysqli_fetch_assoc($result)){

                    $date = date("d-m-Y",strtotime($data['datentime']));
                    $checkin = date("d-m-Y",strtotime($data['check_in']));
                    $checkout = date("d-m-Y",strtotime($data['check_out']));
              
                    $status_bg ="";
                    $btn = "";
                  
                    if($data['arrival']==0)
                            {
                                $btn="<button onclick='cancel_booking($data[booking_id])' type='button' class='btn btn-danger btn-sm shadow-none'>Cancel</button>";
                            }
                    if($data["booking_status"]==1){
                       $status_bg="bg-success";
                        $booked = "booked";
                    }
                    else if($data["booking_status"]==0){
                        $booked = "pending";
                    } 
                    if(!($data['cancel']==1)){
                    echo<<<bookings
                      <div class='col-md-4 px-4 mb-4'>
                        <div class='bg-white p-3 rounded shadow-sm'>
                          <h5 class='fw-bold'>$data[room_name]</h5>
                          <p>$data[trans_amt] per night</p> 
                          <p>
                            <b>Check in : </b> $checkin <br>
                            <b>Check out : </b> $checkout
                          </p>
                          <p>
                           <b>Amount : </b> $data[trans_amt] <br>
                           <b>Date : </b> $date
                          </p>
                          <p>
                            <b class'bg-warning'>$booked</b>
                          </p>
                          $btn
                    
                        </div>
                      </div>
                    bookings;
                    } 
                    
            }
            ?>

        </div>
    </div>        

<?php require('inc/footer.php');?>
<script>
    function cancel_booking(id)
    {
        if(confirm('are you sure to cancel booking?'))
        {
            
            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/cancel_booking.php",);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
            xhr.onload = function()
            {   console.log(this.responseText);
                if(this.responseText==1){
                    window.location.href="bookings.php?cancel_status=true";
                  }
                else
                {
                    alert('error','connection failed!');
                }  
            } 
                        
            xhr.send('cancel_booking&id='+id);
        }   
    }  
                    
</script>

</body>
</html>