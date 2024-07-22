<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> -HOME </title>
    <style>
        .availability-form{
            margin-top : -50px;
            z-index: 2;
            position: relative;
        }
        @media screen and (max-width: 575px){
        .availability-form{
            margin-top : 25px;
            padding: 0 35px;
        }
        }
    </style> 
</head>
<body class="bg-light">
   
       <?php require('inc/header.php'); ?>
  
    <!-- carousel -->
  
    <div class="container-fluid px-lg-4 mt-4">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php
                    $res = selectAll('carousel');
                     while($row = mysqli_fetch_assoc($res))
                     {
                         $path = CAROUSEL_IMG_PATH;
                         echo <<<data
                            <div class="swiper-slide">
                                <img src="$path$row[image]" class="w-100 d-block"> 
                            </div>
                         data;
                     }
                ?>
   </div>
        </div>
             <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div> 
    </div>
       
    <!-- check availability form -->
    
    <div class="container availability-form">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded">
                <h5 class="mb-4">Check Booking Availability</h5>
                <form action="rooms.php">
                    <div class="row align-items-end">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500">Check-in</label>
                            <input type="date" class="form-control shadow-none" name="checkin" required>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500">Check-out</label>
                            <input type="date" class="form-control shadow-none" name="checkout" required>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500">Adult</label>
                            <select class="form-select shadow-none" name="adult" aria-label="Default select example">
                            <?php 
                                $guests_q = mysqli_query($con,"SELECT MAX(adult) AS `max_adult`,
                                 MAX(childern) AS `max_childern` FROM `rooms` WHERE `status`='1' AND `removed`='0'");
                                 $guests_res = mysqli_fetch_assoc($guests_q);

                                 for($i=1;$i<=$guests_res['max_adult']; $i++){
                                    echo"<option value='$i'>$i</option>";
                                }
                            ?>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label class="form-label" style="font-weight: 500">Children</label>
                            <select class="form-select shadow-none" name="childern" aria-label="Default select example">
                            <?php 
                                for($i=1;$i<=$guests_res['max_childern']; $i++){
                                    echo"<option value='$i'>$i</option>";
                                }
                            ?>
                            </select>
                        </div>
                        <input type="hidden" name="check_availability">
                        <div class="col-lg-1 mb-3">
                            <button type="submit" class="btn text-white shadow-none custom-bg">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--ours rooms-->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR Rooms</h2>
    <div class="container">
        <div class="row">
        <?php
                $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `id` DESC LIMIT 3",[1,0],'ii');

                while($room_data = mysqli_fetch_assoc($room_res))
                {
                    // get features of room

                    $fea_q = mysqli_query($con,"SELECT f.name FROM `features` f 
                        INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
                        WHERE rfea.room_id = '$room_data[id]'");

                    $features_data = "";
                    while($fea_row = mysqli_fetch_assoc($fea_q)){
                        $features_data .="<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                            $fea_row[name] 
                        </span>";

                    }

                    // get facilities of room

                    $fac_q = mysqli_query($con,"SELECT f.name FROM `facilities` f 
                        INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id 
                        WHERE rfac.room_id = '$room_data[id]'");

                    $facilities_data ="";
                    while($fac_row = mysqli_fetch_assoc($fac_q)){
                        $facilities_data .="<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                            $fac_row[name] 
                        </span>";
                    }

                    // get thumbnail of image

                    $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
                    $thumb_q = mysqli_query($con,"SELECT * FROM `room_images` 
                        WHERE `room_id`='$room_data[id]' 
                        AND `thumb`='1'");

                    if(mysqli_num_rows($thumb_q)>0){
                        $thumb_res = mysqli_fetch_assoc($thumb_q);
                        $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
                    }

                    $book_btn ="";

                    if(!$settings_r['shutdown']){

                          $login=0;
                          if(isset($_SESSION['login']) && $_SESSION['login']==true)
                          {
                              $login=1;
                          }    
                         $book_btn="<button onclick= 'checkLoginToBook($login,$room_data[id])' class='btn btn-sm text-white custom-bg shadow-none'>Book Now</button>";
                    }

                    // print room card

                    echo <<<data
                        <div class="col-lg-4 col-md-6 my-3">
                            <div class="card border-0 shadow" style="width: 350px; margin: auto;">
                                <img src="$room_thumb" class="card-img-top">
                                <div class="card-body">
                                <h5>$room_data[name]</h5>
                                <h6 class"mb-4">₹$room_data[price] pre night</h6>
                                    <div class="features mb-4">
                                        <h6 class="mb-1">Features</h6>
                                        $features_data
                                    </div>
                                    <div class="facilities mb-4">
                                        <h6 class="mb-1">Facilities</h6>
                                        $facilities_data
                                    </div>
                                    <div class="guests mb-4">
                                        <h6 class="mb-1">Guests</h6>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">
                                        $room_data[adult] Adults 
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap lh-base">
                                        $room_data[childern] Children
                                        </span>
                                    </div>
                                    <div class="rating mb-2">
                                        <h6 class="mb-1">Rating</h6>
                                        <span class="badge rounded-pill bg-light">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        </span>
                                    </div>                                    
                                    <div class="d-flex justify-content-evenly">
                                        $book_btn 
                                        <a href="room_details.php?id=$room_data[id]" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                 data;


                }
            ?>
            <div class="col-lg-12 text-center mt-5">
             <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms >>></a>
            </div>      
          </div>

    </div>

    <!-- Our Facilities -->

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR Facilities</h2>
    <div class="container">
        <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
        <?php 
         $res = mysqli_query($con,"SELECT * FROM `facilities` ORDER BY `id` DESC LIMIT 5");
         $path = FACILITIES_IMG_PATH;

         while($row = mysqli_fetch_assoc($res)){
            echo<<<data
                <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                    <img src="$path$row[icon]" width="50px">
                    <h5 class="mt-3">$row[name]</h5>
                </div>
            data;
         }
        ?>

                <div class="col-lg-12 text-center mt-5">
                    <a href="facilities.php" class="btn btn-sm text-white custom-bg shadow-none">More Facilities</a>
                </div>
            
        </div>
    </div>

    <!-- Testimonials -->

    <h2 class="mt-5 pt-4bmb-4 text-center fw-bold h-font">Testimonials</h2>
    <div class="swiper swiper-testimonials mb-4">
        <div class="swiper-wrapper mb-5">
          <div class="swiper-slide bg-white p-4">
            <div class="profile d-flex align-items-center mb-3">
                <img src="images/features/wifi.jpeg" width="30px">
                <h6 class="m-0 ms-2">Random user1 </h6> 
            </div>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis libero eos dolorum 
                deserunt architecto a possimus laborum sunt exercitationem laboriosam ducimus
                 fuga sequi alias quod, tempore dolor dolorem fugit aut.
            </p>
            <div class="rating">
                <span class="badge rounded-pill bg-light">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </span>
            </div>
          </div>
          <div class="swiper-slide bg-white p-4">
            <div class="profile d-flex align-items-center mb-3">
                <img src="images/features/wifi.jpeg" width="30px">
                <h6 class="m-0 ms-2">Random user1 </h6> 
            </div>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis libero eos dolorum 
                deserunt architecto a possimus laborum sunt exercitationem laboriosam ducimus
                 fuga sequi alias quod, tempore dolor dolorem fugit aut.
            </p>
            <div class="rating">
                <span class="badge rounded-pill bg-light">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </span>
            </div>
          </div>
          <div class="swiper-slide bg-white p-4">
            <div class="profile d-flex align-items-center mb-3">
                <img src="images/features/wifi.jpeg" width="30px">
                <h6 class="m-0 ms-2">Random user1 </h6> 
            </div>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis libero eos dolorum 
                deserunt architecto a possimus laborum sunt exercitationem laboriosam ducimus
                 fuga sequi alias quod, tempore dolor dolorem fugit aut.
            </p>
            <div class="rating">
                <span class="badge rounded-pill bg-light">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </span>
            </div>
          </div>
         
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
    <div class="swiper-pagination"></div>
      </div>

      <!-- Reach Us -->

    
    <h2 class="mt-5 pt-4b mb-4 text-center fw-bold h-font">Reach Us</h2>
    <div class="container ">
        <div class="row">
            <div class="col-lg-8 col-md-8 bg-white rounded mb-lg-0 p-4">
              <iframe class="w-100" src="<?php echo $contact_r['iframe'] ?>" height="300" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></iframe>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="rounded bg-white md-4 p-4">
                    <h5>Call Us</h5>
                    <a href= " +<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone"></i> +<?php echo $contact_r['pn1'] ?>
                    </a>
                    <br>
                    
                    <a href="tel: +918827324709" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone"></i> +918827324709
                    </a>
                </div> 
                <div class="bg-white p-4 rounded mb-4">
                    <h5>Follow Us</h5>
                    <?php
                    if($contact_r['tw']!=''){
                        echo<<<data
                        <a href="$contact_r[tw]" class="d-inline-block mb-3"> 
                        <span class="badge bg-light text-dark fs-6 p-2">
                        <i class="bi bi-twitter me-1"></i> twitter
                        </span>
                         </a>
                        <br>
                        data;
                    } 
                    ?>
                   
                    <a href="<?php echo $contact_r['fb'] ?>" class="me-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                        <i class="bi bi-facebook me-1"></i> facebook
                        </span>
                    </a>
                    <br>
                     <a href="<?php echo $contact_r['insta'] ?>" class="me-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                         <i class="bi bi-instagram me-1"></i> instagram
                        </span>
                     </a>

                        

                </div>
            </div>
        </div>
        <div class="col-lg-12 text-center mt-5">
            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Know more</a>
        </div>
    
    </div>

    <!-- footer -->

    <?php require('<inc/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      },
      keyboard: {
        enabled: true,
      },

      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
    var swiper = new Swiper(".swiper-testimonials", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      slidesPerView: "3",
      loop: true,
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: false,
      },
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints: {
        320: {
        slidesPerView: 1,
      },
        640: {
        slidesPerView: 1,
      },
        768: {
        slidesPerView: 2,
      },
        1024: {
        slidesPerView: 3,
      },
      }
    });
  </script>
</body>
</html>