<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- all css link -->
    <?php
    require('./inc/link.php')
    ?>


    <!-- sweeper  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


    <title>Montral Hotel</title>



</head>

<body>

    <!-- HEader -->

    <?php
    include('./inc/header.php')
    ?>



    <!-- carosel -->
    <div class="container-fluid">








        <!-- Rooms -->


        <div class=" mt-5 mb-5">
            <h1 class="fw-bold h-font text-center">Room Details</h1>
            <div class="col-4 m-auto">

                <hr class="text-black text-bold">
            </div>
        </div>



        <div class="row w-100">


            <div class="col-lg-6 col-md-6 col-sm-12  shadow-sm caroselimg">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">

                        <?php

                        if (isset($_GET['roomDetails'])) {

                            $room_id = $_GET['room_id'];

                            $res = select("SELECT * FROM `room_img` WHERE `room_id`=?", [$room_id], 'i');
                            $activec = 'active';

                            $img_PATH = ROOM_IMG_PATH . "thum.jpg";
                            if (mysqli_num_rows($res) > 0) {

                                while ($row = mysqli_fetch_assoc($res)) {

                                    echo "
                                           <div class='carousel-item $activec ' >
                                         <img class='d-block w-100 img-fluid caroimg'style='width: 200px; margin-left: auto; margin-right: auto;' src='" . ROOM_IMG_PATH . $row['room_img'] . "' >
                                          </div>
                                            
                                      ";

                                    $activec = '';
                                }
                            } else {
                                echo "    <div class='carousel-item active'>
                                       <img class='d-block w-100' src='$img_PATH' >
                                     </div>

                
                        ";
                            }
                        } else {
                            redirect('index.php');
                        }



                        ?>


                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>







            </div>


            <?php

            if (isset($_GET['roomDetails'])) {

                $room_id = $_GET['room_id'];



                $res = select("SELECT * FROM `rooms` WHERE `sr_no`=?", [$room_id], "i");

                while ($row = mysqli_fetch_assoc($res)) {


                    $facility_Res = mysqli_query($con, " SELECT  facilites.name FROM
                            `facilites`  INNER JOIN `room_facilites`
                            ON facilites.sr_no=room_facilites.facilites_id
                            WHERE `room_id`='$row[sr_no]'");

                    $facilities = "";

                    while ($facility_row = mysqli_fetch_assoc($facility_Res)) {
                        $facilities .= "     
      

                       <div class='col-3 mb-2'> >$facility_row[name]</div>
        
                            
                                    ";
                    };
                    $feature_Res = mysqli_query($con, " SELECT  features.feature_name FROM
                        `features`  INNER JOIN `room_features`
                        ON features.sr_no=room_features.feature_id
                        WHERE `room_id`='$row[sr_no]'");


                    $feature_name = "";

                    while ($feature_row = mysqli_fetch_assoc($feature_Res)) {
                        $feature_name .= "        
                  

                                <div class=' m-2'>> $feature_row[feature_name]</div>
                            
                                
                                ";
                    };

                    $room_img = select("SELECT * FROM `room_img` WHERE `room_id`=? and `thum`=?", [$row['sr_no'], 1,], "ii");
                    $img_PATH = ROOM_IMG_PATH . 'thum.jpg';




                    if (mysqli_num_rows($room_img) > 0) {
                        $img_row = mysqli_fetch_assoc($room_img);
                        $img_PATH = ROOM_IMG_PATH . "$img_row[room_img]";
                    }




                    // echo ;
                    echo <<<data



                                            <div class="col-lg-6 col-md-6 col-sm-12 shadow-sm ">

                                                <div class="card mb-3 border-none p-4 ">
                                                    <div class="card-body ">
                                                                <h5>SA : $row[room_price] في الليلة الواحدة</h5>

                                                                    <div class="rating m-2">

                                                                    <span class="badge badge-pill badge-secondary">

                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                        <i class="bi bi-star-fill text-warning"></i>

                                                                    </span>

                                


                                                                    </div>

                                                                    </div>

                                                                <h6 class="text-left text-bold">Features:</h6>
                                                                <div class="d-flex">

                                                                $feature_name
                                                                </div>
                                                                <h6 class='text-bold'>Facilities:</h6>
                                                                <div class='d-flex'>
                                                                    $facilities
                                                                </div>
                                                    

                                                                <h6>Guest</h6>

                                                                <div class="row ">

                                                                    <div class="col-3 mb-6">$row[room_adult] Adult</div>
                                                                    <div class="col-3 mb-6">$row[room_child] children</div>

                                                                    </div>
                                                        
                                                                        </div>
                                                            
                                                                    <div class="d-flex justify-content-evenly mb-2 mt-5">
                                                                        <button type='button' class="bt-color btn btn-primary shadow btn-lg btn-block w-100 mx-4">
                                                                            <a href="#" class=" text-light text-decoration-none  ">Book now</a>

                                                                        </button>

                                                                </div>
                                                        </div>


                                                    </div>


                             

                                                                                                                    
                                                                                                                
                                            </div>        
                                                            <div class='col-12 col-lg-12 col-md-12  mt-4 shadow-sm mb-5 bg-light rounded-3 p-3 container'>
                                                        
                                                        
                                                        <div>
                                                        <h5>Description:</h5>
                                            
                                                        <p class='text-bold'> $row[room_des]</p>

                                                        </div>



                                                            <div>           <div class="  rounded-3 mt-4">
                                                                <h5>Review & rating:</h5>
                                                                                        <div class="">
                                                                                            <i class="bi bi-archive fw-bold"></i>

                                                                                        </div>
                                                                                        <h6>Shohag</h6>
                                                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste blanditiis optio, mollitia sequi quod hic cupiditate labore ipsum cumque porro dolores quae sunt magni commodi quibusdam quos. Explicabo, ratione suscipit?

                                                                                        </p>

                                                                                        <div class="rating">

                                                                                            <span class="badge badge-pill badge-secondary">

                                                                                                <i class="bi bi-star-fill text-warning"></i>
                                                                                                <i class="bi bi-star-fill text-warning"></i>
                                                                                                <i class="bi bi-star-fill text-warning"></i>
                                                                                                <i class="bi bi-star-fill text-warning"></i>
                                                                                                <i class="bi bi-star-fill text-warning"></i>

                                                                                            </span>



                                                                                        </div>
                                                                                    </div>
                                                                                    </div>                                             

                                            data;
                }
            } else {
                redirect('index.php');
            }



            ?>



        </div>




    </div>











    <!-- Footer -->

    <?php
    include('./inc/footer.php')
    ?>








</html>