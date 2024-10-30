<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- all css link -->
    <?php
    require('./inc/link.php')
    ?>

    <style>
        .border_hover :hover {
            border-top-color: gold !important;
            transform: scale(1.03);
            transition: 0.3s;
        }
    </style>
    <!-- sweeper  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


    <title>Montral Hotel-contact</title>



</head>

<body>





    <!-- HEader -->

    <?php
    include('./inc/header.php')
    ?>


    <!-- Facalites -->

    <div class=" mt-5 mb-5">
        <h1 class="fw-bold h-font text-center">Rooms</h1>
        <div class="col-4 m-auto">
        </div>
    </div>




    <div class="container ">
        <div class="row">
            <div class="col-md-3 col-lg-3 mb-3 mb-lg-0 col sticky-left">
                <nav class="navbar navbar-expand-lg flex-lg-colum navbar-light bg-light rounded">
                    <div class="container-fluid flex-lg-column aling-items-stretch">
                        <a class="navbar-brand h-font" href="#">Filteres</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#room_nav" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse flex-column aling-items-stretch" id="room_nav">
                            <div class="shadow bg-white p-3 mb-3 rounded w-100">
                                <h6 style="font-size:18px">Check availability</h6>
                                <div class="mb-2">

                                    <label>check availability In</label>
                                    <input type="date" class="form-control" placeholder="select calender">
                                </div>
                                <div class="mb-2">

                                    <label>check availability out</label>
                                    <input type="date" class="form-control" placeholder="select calender">
                                </div>

                            </div>
                            <div class="shadow bg-white p-3 mb-3 rounded w-100">
                                <h6 style="font-size:18px" class="w-100">Facalites</h6>
                                <div class="mb-2 w-100 ">
                                    <input type="checkbox" id="f1" class="form-check-input me-1">

                                    <label class="form-label" for="f1">facilityes one</label>
                                </div>

                                <div class="mb-2 w-100 ">
                                    <input type="checkbox" id="f2" class="form-check-input me-1">

                                    <label class="form-label" for="f2">facilityes two</label>
                                </div>
                                <div class="mb-2 w-100 ">
                                    <input type="checkbox" id="f3" class="form-check-input me-1">

                                    <label class="form-label" for="f3">facilityes two</label>
                                </div>


                            </div>
                            <div class="shadow bg-white p-3 mb-3 rounded w-100">
                                <h6 style="font-size:18px">Guest</h6>
                                <div class="d-flex">
                                    <div class="me-2">

                                        <label>Adult</label>
                                        <input type="number" class="form-control">
                                    </div>
                                    <div class="mb-2">

                                        <label>Children</label>
                                        <input type="number" class="form-control">
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </nav>
            </div>


            <div class="col-md-9 col-md-9 col-lg-9 col-xl-9 my-5 ">
                <?php

                $res = select("SELECT * FROM `rooms` WHERE `room_active`=?", [0], "i");

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

                                                    <div class="row  pt-3 pb-3  px-2 m-2 shadow-sm aling-items-center">

                                                        <div class="col-md-5 mb-md-0 mb-lg-0 mb-2 " >

                                                            <img class="card-img-top w-100 img-fluid" src="$img_PATH" alt="Card image cap">


                                                        </div>

                                                        <div class="col-md-4 ">
                                                            <div class="card-body  ">
                                                                <h5 class="card-title pb-1">Name:$row[room_name]</h5>

                                                                <h6 class="text-left">Features</h6>
                                                                $feature_name
                                                                <h6>Facilities</h6>
                                                                                                                         $facilities


                                                                <h6>Guest</h6>

                                                                <div class="row ">

                                                                    <div class="col-6 mb-6">$row[room_adult] Adult</div>
                                                                    <div class="col-6 mb-6">$row[room_child] children</div>

                                                                </div>
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


                                                        </div>
                                                        <div class="col-md-3 aling-items-center text-center">

                                                            <div class="card-body ">
                                                                <h5>ر.س $row[room_price] per night</h5>
                                                                <div class=" justify-content-center mb-2">
                                                                    <button class="btn w-100">
                                                                        <a href="#" class=" text-bold btn btn-primary  bt-color">Book now</a>

                                                                    </button>
                                                                    <button class="btn btn-color w-100">
                                                                        <a href="room_details.php?room_id=$row[sr_no]&roomDetails" class=" text-bold btn btn-primary">More details >></a>

                                                                    </button>


                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>


                                           





                       data;
                }



                ?>

            </div>
        </div>
    </div>



    <!-- Footer -->

    <?php
    include('./inc/footer.php')
    ?>
</body>

</html>