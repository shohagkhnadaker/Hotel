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





        <!-- Swiper -->
        <div class="swiper hotelswiper">
            <div class="swiper-wrapper">


                <?php
                $res = selectAll('carusel');

                while ($row = mysqli_fetch_assoc($res)) {
                    $path = CARUSEL_IMAGE_PATH;
                    echo <<<data


                                <div class="swiper-slide carousel">
                                    <img class="w-100 d-block " src="$path$row[carosel_image]" />
                                  </div>

                 data;
                };


                ?>



            </div>


        </div>
    </div>

    <!-- Check avility -->

    <div class="container-fluid p-lg-5  " id="avality">

        <div class="bg-white p-4 check  shadow ">Check avality

            <form action="Post">
                <div class="row aling-item-center">


                    <div class=" col-lg-3 col-md-6 col-sm-6">
                        <div class="form-group mb-3">
                            <label for="exampleInputPassword1">check avility In</label>
                            <input type="date" class="form-control" id="exampleInputPassword1" placeholder="select calender" required>
                        </div>
                    </div>



                    <div class=" col-lg-3 col-md-6 col-sm-6">
                        <div class="form-group mb-3">
                            <label for="exampleInputPassword1">Check avility out</label>
                            <input type="date" class="form-control" id="exampleInputPassword1" placeholder="select calender" required>
                        </div>
                    </div>

                    <div class=" col-lg-2 col-md-6 col-sm-6">
                        <div class="form-group mb-3">
                            <label for="exampleInputPassword1">Chilren</label>
                            <select class="form-select form-select-lg" aria-label=".form-select-lg example">
                                <option selected>choose a number</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>

                    <div class=" col-lg-2 col-md-6 col-sm-6 ">
                        <div class="form-group mb-3">
                            <label for="exampleInputPassword1">Adult</label>
                            <select class="form-select form-select-lg" aria-label=".form-select-lg example">
                                <option selected>choose a number</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>

                    <div class=" col-lg-2 col-md-12 col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary mt-4 ">Submit</button>
                    </div>




                </div>
            </form>

        </div>
    </div>


    <!-- Rooms -->


    <div class=" mt-5 mb-5">
        <h1 class="fw-bold h-font text-center">Rooms</h1>
        <div class="col-4 m-auto">

            <hr class="text-black text-bold">
        </div>

        <div class="container">

            <div class="row ">


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



                            <div class="col-lg-4 col-md-12 col-sm-6 mb-2   col-12 ">

                                <div class="card shadow-sm border-none m-auto  mx-3 pb-3"  >
                                <div style='height:300px;overflow:hidden border:1px solid'>
                                    <img class="card-img-top" src=$img_PATH alt="Card image cap">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">$row[room_name]</h5>
                                        <h6>SA : $row[room_price] per night</h6>

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
                                    

                                   
                                              <div class="d-grid gap-2 col-8 mx-auto">
                                       
                                                <button class="btn ">
                                                    <a href="#" class=" text-bold btn btn-block btn-primary bt-color">Book now</a>

                                                </button>
                                                  <button class="btn btn-color ">
                                                    <a href="room_details.php?room_id=$row[sr_no]&roomDetails" class=" text-bold btn btn-primary">More details >></a>

                                                </button>
                                                </div>
                                              


                           

                                </div>










                            </div>






                    data;
                }



                ?>





                <div class="col-12 mt-4 text-center"><a href="room.php" class="bt-color btn btn-sm btn-primary border-0">Show more >>>> </a></div>

            </div>
        </div>

    </div>


    <!-- Facalityes -->


    <div class="container mb-5 mt-5">

        <h1 class="fw-bold h-font text-center">Facilities</h1>
        <div class="col-4 m-auto mb-5">

            <hr class="text-black text-bold">
        </div>


        <div class="row ">



            <div class="col-lg-2 col-md-2 col-sm-4 mb-3">
                <div class="bg-white shadow border rounded text-center m-auto pt-5 pb-5 m-2">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAA
                        AAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEc0lEQVR4nO2YW4hWVRTHf6NdrMl0aqrR
                        tHTApvooCknoZcig5qUbPWSoVJraS5ZBaT0IkV2my0MaFGVBL4ElXR5Kw4esGBxBKpjpwfE2
                        SXax0orMy6R+seS/YXU4l2/mO998M3T+sOFw9tprrb33uu0FBQoUKFBglKIBKAELgU7gfaAH2A
                        McBAY0Dupfj2ieAxZorfGoC84F7gPeA/YD5SqH8XgXuFe8a46bgXXA4YgiPwHrgZXA3cBMYBrQBJ
                        yu0aR/M0WzUmt+jvA6LBk35a38WGAO8LUTdhLYAjwEtOUg43LgYaBbvIOcr4C7pENVuBH41jE+ADyjk6
                        0VpgPPyqeCXPOrG4bCbLLs39uwnX4jw4dzgGXAL04P86NJlTK4FfhVC48Cz1fggOYD1wOPAW8BXwL9MVGrX3NG8
                        6jW2No0TABeBI5JJ9vYLVnKvOJsdBtwRQr92fKdD4G/q4hYh4AP5AtnpcgryWeCj64GTosSjQc+FdEJ4KmUk5oKvAD8
                        EXF+s+M1wBLZ8/SYqNWquSWi7Yk49++ygCkph/20dDT6jdL9FMzmvtHEX8DtCUzO140NuA1/DiwCmhk6mrWxL9ymBnTiJj
                        MOd0jXsqLpKb/5yJ1Ie8wiy7oPuChifrMWuIz80Qa8KRllyVyckPnbnd62B1qAHfqxxV+VdrrRLViXcu15YqoiVJD7ifQMGC9
                        dy9K9xS/s18RmOfIs4Af9+w6YnSH8PJnlS8AGoC8mavVJKYtCt8lvsvLYXumwD7hOum3Wv37p/h+0ijhErCP6tnwyMUHQGcBc3
                        drxIUSsf7TpueIVhyaVMqF82eY2ZjonlgqhCDTHezLBPs8EHnEbL2sj5rCr5IylmKhV0twq5RO/+e/FM25DDdIlBIP90jUVVyvp
                        3J8w3+F8KtjoUuBCBo+LVDFE+XUk0C+UbqZjRYjL5OMiCXO3EuIYqscYVcR7nDWskcxKdKsYFwBbnQl1yrzyxjgl22By3ZKdC
                        
                    yxD73R1TloV2qha7TWgS+sOaezUv1dVK1n0ScJsV+/tkg5Vo8MVbJZt49CqRBYiXSXjiBJrUuRZLbpjKT4zaNypUGmMV0Tsda2bO65
                    TX67M26ZbatR3u+a6XL1ka9+I2P4KN2eyc8U8J3ypEuYuV7a8HMm+WZikUw+3bbxmiXeo5UxmTbBIEeWkKx4toV1aBc9prgwacPxNVk3xoAuRnTmF3waZ0wnxtkfXsMDsfH7C3ET1q+yxtN1Fre3qZy1IKXnmi3ddYXnlCT2OsiKWFZCP1ygXVYWLXcK00avSo+SiVkktn15H1621IwKTXfFot3FPRgu0QR3FcHP7xKPuMMVel1J/6s2QhWvci/PtnAJGLjBF3nG3cm0K7VXAb6JdH9cJqTfGuqae1WRXxtDMAH507+ysnlbdYI+ijxNecJfoyWxzmxJK9BEFa7J9JoX3KutPcW+NrmFuvVbdtw1djj6N0KWxuVGFCa5RUFYTMKtrMmLRrATYm9I1HDVoGWR5X6BAgQL/A/wLdx2nSguoJAMAAAAASUVORK5CYII=">
                </div>
            </div>




            <div class="col-lg-2 col-md-2 col-sm-4 mb-3">
                <div class="bg-white shadow border rounded text-center m-auto pt-5 pb-5 m-2">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAA
                        AAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEc0lEQVR4nO2YW4hWVRTHf6NdrMl0aqrR
                        tHTApvooCknoZcig5qUbPWSoVJraS5ZBaT0IkV2my0MaFGVBL4ElXR5Kw4esGBxBKpjpwfE2
                        SXax0orMy6R+seS/YXU4l2/mO998M3T+sOFw9tprrb33uu0FBQoUKFBglKIBKAELgU7gfaAH2A
                        McBAY0Dupfj2ieAxZorfGoC84F7gPeA/YD5SqH8XgXuFe8a46bgXXA4YgiPwHrgZXA3cBMYBrQBJ
                        yu0aR/M0WzUmt+jvA6LBk35a38WGAO8LUTdhLYAjwEtOUg43LgYaBbvIOcr4C7pENVuBH41jE+ADyjk6
                        0VpgPPyqeCXPOrG4bCbLLs39uwnX4jw4dzgGXAL04P86NJlTK4FfhVC48Cz1fggOYD1wOPAW8BXwL9MVGrX3NG8
                        6jW2No0TABeBI5JJ9vYLVnKvOJsdBtwRQr92fKdD4G/q4hYh4AP5AtnpcgryWeCj64GTosSjQc+FdEJ4KmUk5oKvAD8
                        EXF+s+M1wBLZ8/SYqNWquSWi7Yk49++ygCkph/20dDT6jdL9FMzmvtHEX8DtCUzO140NuA1/DiwCmhk6mrWxL9ymBnTiJj
                        MOd0jXsqLpKb/5yJ1Ie8wiy7oPuChifrMWuIz80Qa8KRllyVyckPnbnd62B1qAHfqxxV+VdrrRLViXcu15YqoiVJD7ifQMGC9
                        dy9K9xS/s18RmOfIs4Af9+w6YnSH8PJnlS8AGoC8mavVJKYtCt8lvsvLYXumwD7hOum3Wv37p/h+0ijhErCP6tnwyMUHQGcBc3
                        drxIUSsf7TpueIVhyaVMqF82eY2ZjonlgqhCDTHezLBPs8EHnEbL2sj5rCr5IylmKhV0twq5RO/+e/FM25DDdIlBIP90jUVVyvp
                        3J8w3+F8KtjoUuBCBo+LVDFE+XUk0C+UbqZjRYjL5OMiCXO3EuIYqscYVcR7nDWskcxKdKsYFwBbnQl1yrzyxjgl22By3ZKdC
                        
                    yxD73R1TloV2qha7TWgS+sOaezUv1dVK1n0ScJsV+/tkg5Vo8MVbJZt49CqRBYiXSXjiBJrUuRZLbpjKT4zaNypUGmMV0Tsda2bO65
                    TX67M26ZbatR3u+a6XL1ka9+I2P4KN2eyc8U8J3ypEuYuV7a8HMm+WZikUw+3bbxmiXeo5UxmTbBIEeWkKx4toV1aBc9prgwacPxNVk3xoAuRnTmF3waZ0wnxtkfXsMDsfH7C3ET1q+yxtN1Fre3qZy1IKXnmi3ddYXnlCT2OsiKWFZCP1ygXVYWLXcK00avSo+SiVkktn15H1621IwKTXfFot3FPRgu0QR3FcHP7xKPuMMVel1J/6s2QhWvci/PtnAJGLjBF3nG3cm0K7VXAb6JdH9cJqTfGuqae1WRXxtDMAH507+ysnlbdYI+ijxNecJfoyWxzmxJK9BEFa7J9JoX3KutPcW+NrmFuvVbdtw1djj6N0KWxuVGFCa5RUFYTMKtrMmLRrATYm9I1HDVoGWR5X6BAgQL/A/wLdx2nSguoJAMAAAAASUVORK5CYII=">
                </div>
            </div>




            <div class="col-lg-2 col-md-2 col-sm-4 mb-3">
                <div class="bg-white shadow border rounded text-center m-auto pt-5 pb-5 m-2">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAA
                        AAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEc0lEQVR4nO2YW4hWVRTHf6NdrMl0aqrR
                        tHTApvooCknoZcig5qUbPWSoVJraS5ZBaT0IkV2my0MaFGVBL4ElXR5Kw4esGBxBKpjpwfE2
                        SXax0orMy6R+seS/YXU4l2/mO998M3T+sOFw9tprrb33uu0FBQoUKFBglKIBKAELgU7gfaAH2A
                        McBAY0Dupfj2ieAxZorfGoC84F7gPeA/YD5SqH8XgXuFe8a46bgXXA4YgiPwHrgZXA3cBMYBrQBJ
                        yu0aR/M0WzUmt+jvA6LBk35a38WGAO8LUTdhLYAjwEtOUg43LgYaBbvIOcr4C7pENVuBH41jE+ADyjk6
                        0VpgPPyqeCXPOrG4bCbLLs39uwnX4jw4dzgGXAL04P86NJlTK4FfhVC48Cz1fggOYD1wOPAW8BXwL9MVGrX3NG8
                        6jW2No0TABeBI5JJ9vYLVnKvOJsdBtwRQr92fKdD4G/q4hYh4AP5AtnpcgryWeCj64GTosSjQc+FdEJ4KmUk5oKvAD8
                        EXF+s+M1wBLZ8/SYqNWquSWi7Yk49++ygCkph/20dDT6jdL9FMzmvtHEX8DtCUzO140NuA1/DiwCmhk6mrWxL9ymBnTiJj
                        MOd0jXsqLpKb/5yJ1Ie8wiy7oPuChifrMWuIz80Qa8KRllyVyckPnbnd62B1qAHfqxxV+VdrrRLViXcu15YqoiVJD7ifQMGC9
                        dy9K9xS/s18RmOfIs4Af9+w6YnSH8PJnlS8AGoC8mavVJKYtCt8lvsvLYXumwD7hOum3Wv37p/h+0ijhErCP6tnwyMUHQGcBc3
                        drxIUSsf7TpueIVhyaVMqF82eY2ZjonlgqhCDTHezLBPs8EHnEbL2sj5rCr5IylmKhV0twq5RO/+e/FM25DDdIlBIP90jUVVyvp
                        3J8w3+F8KtjoUuBCBo+LVDFE+XUk0C+UbqZjRYjL5OMiCXO3EuIYqscYVcR7nDWskcxKdKsYFwBbnQl1yrzyxjgl22By3ZKdC
                        
                    yxD73R1TloV2qha7TWgS+sOaezUv1dVK1n0ScJsV+/tkg5Vo8MVbJZt49CqRBYiXSXjiBJrUuRZLbpjKT4zaNypUGmMV0Tsda2bO65
                    TX67M26ZbatR3u+a6XL1ka9+I2P4KN2eyc8U8J3ypEuYuV7a8HMm+WZikUw+3bbxmiXeo5UxmTbBIEeWkKx4toV1aBc9prgwacPxNVk3xoAuRnTmF3waZ0wnxtkfXsMDsfH7C3ET1q+yxtN1Fre3qZy1IKXnmi3ddYXnlCT2OsiKWFZCP1ygXVYWLXcK00avSo+SiVkktn15H1621IwKTXfFot3FPRgu0QR3FcHP7xKPuMMVel1J/6s2QhWvci/PtnAJGLjBF3nG3cm0K7VXAb6JdH9cJqTfGuqae1WRXxtDMAH507+ysnlbdYI+ijxNecJfoyWxzmxJK9BEFa7J9JoX3KutPcW+NrmFuvVbdtw1djj6N0KWxuVGFCa5RUFYTMKtrMmLRrATYm9I1HDVoGWR5X6BAgQL/A/wLdx2nSguoJAMAAAAASUVORK5CYII=">
                </div>
            </div>




            <div class="col-lg-2 col-md-2 col-sm-4 mb-3">
                <div class="bg-white shadow border rounded text-center m-auto pt-5 pb-5 m-2">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAA
                        AAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEc0lEQVR4nO2YW4hWVRTHf6NdrMl0aqrR
                        tHTApvooCknoZcig5qUbPWSoVJraS5ZBaT0IkV2my0MaFGVBL4ElXR5Kw4esGBxBKpjpwfE2
                        SXax0orMy6R+seS/YXU4l2/mO998M3T+sOFw9tprrb33uu0FBQoUKFBglKIBKAELgU7gfaAH2A
                        McBAY0Dupfj2ieAxZorfGoC84F7gPeA/YD5SqH8XgXuFe8a46bgXXA4YgiPwHrgZXA3cBMYBrQBJ
                        yu0aR/M0WzUmt+jvA6LBk35a38WGAO8LUTdhLYAjwEtOUg43LgYaBbvIOcr4C7pENVuBH41jE+ADyjk6
                        0VpgPPyqeCXPOrG4bCbLLs39uwnX4jw4dzgGXAL04P86NJlTK4FfhVC48Cz1fggOYD1wOPAW8BXwL9MVGrX3NG8
                        6jW2No0TABeBI5JJ9vYLVnKvOJsdBtwRQr92fKdD4G/q4hYh4AP5AtnpcgryWeCj64GTosSjQc+FdEJ4KmUk5oKvAD8
                        EXF+s+M1wBLZ8/SYqNWquSWi7Yk49++ygCkph/20dDT6jdL9FMzmvtHEX8DtCUzO140NuA1/DiwCmhk6mrWxL9ymBnTiJj
                        MOd0jXsqLpKb/5yJ1Ie8wiy7oPuChifrMWuIz80Qa8KRllyVyckPnbnd62B1qAHfqxxV+VdrrRLViXcu15YqoiVJD7ifQMGC9
                        dy9K9xS/s18RmOfIs4Af9+w6YnSH8PJnlS8AGoC8mavVJKYtCt8lvsvLYXumwD7hOum3Wv37p/h+0ijhErCP6tnwyMUHQGcBc3
                        drxIUSsf7TpueIVhyaVMqF82eY2ZjonlgqhCDTHezLBPs8EHnEbL2sj5rCr5IylmKhV0twq5RO/+e/FM25DDdIlBIP90jUVVyvp
                        3J8w3+F8KtjoUuBCBo+LVDFE+XUk0C+UbqZjRYjL5OMiCXO3EuIYqscYVcR7nDWskcxKdKsYFwBbnQl1yrzyxjgl22By3ZKdC
                        
                    yxD73R1TloV2qha7TWgS+sOaezUv1dVK1n0ScJsV+/tkg5Vo8MVbJZt49CqRBYiXSXjiBJrUuRZLbpjKT4zaNypUGmMV0Tsda2bO65
                    TX67M26ZbatR3u+a6XL1ka9+I2P4KN2eyc8U8J3ypEuYuV7a8HMm+WZikUw+3bbxmiXeo5UxmTbBIEeWkKx4toV1aBc9prgwacPxNVk3xoAuRnTmF3waZ0wnxtkfXsMDsfH7C3ET1q+yxtN1Fre3qZy1IKXnmi3ddYXnlCT2OsiKWFZCP1ygXVYWLXcK00avSo+SiVkktn15H1621IwKTXfFot3FPRgu0QR3FcHP7xKPuMMVel1J/6s2QhWvci/PtnAJGLjBF3nG3cm0K7VXAb6JdH9cJqTfGuqae1WRXxtDMAH507+ysnlbdYI+ijxNecJfoyWxzmxJK9BEFa7J9JoX3KutPcW+NrmFuvVbdtw1djj6N0KWxuVGFCa5RUFYTMKtrMmLRrATYm9I1HDVoGWR5X6BAgQL/A/wLdx2nSguoJAMAAAAASUVORK5CYII=">
                </div>
            </div>





            <div class="col-lg-2 col-md-2 col-sm-4 mb-3">
                <div class="bg-white shadow border rounded text-center m-auto pt-5 pb-5 m-2">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAA
                        AAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEc0lEQVR4nO2YW4hWVRTHf6NdrMl0aqrR
                        tHTApvooCknoZcig5qUbPWSoVJraS5ZBaT0IkV2my0MaFGVBL4ElXR5Kw4esGBxBKpjpwfE2
                        SXax0orMy6R+seS/YXU4l2/mO998M3T+sOFw9tprrb33uu0FBQoUKFBglKIBKAELgU7gfaAH2A
                        McBAY0Dupfj2ieAxZorfGoC84F7gPeA/YD5SqH8XgXuFe8a46bgXXA4YgiPwHrgZXA3cBMYBrQBJ
                        yu0aR/M0WzUmt+jvA6LBk35a38WGAO8LUTdhLYAjwEtOUg43LgYaBbvIOcr4C7pENVuBH41jE+ADyjk6
                        0VpgPPyqeCXPOrG4bCbLLs39uwnX4jw4dzgGXAL04P86NJlTK4FfhVC48Cz1fggOYD1wOPAW8BXwL9MVGrX3NG8
                        6jW2No0TABeBI5JJ9vYLVnKvOJsdBtwRQr92fKdD4G/q4hYh4AP5AtnpcgryWeCj64GTosSjQc+FdEJ4KmUk5oKvAD8
                        EXF+s+M1wBLZ8/SYqNWquSWi7Yk49++ygCkph/20dDT6jdL9FMzmvtHEX8DtCUzO140NuA1/DiwCmhk6mrWxL9ymBnTiJj
                        MOd0jXsqLpKb/5yJ1Ie8wiy7oPuChifrMWuIz80Qa8KRllyVyckPnbnd62B1qAHfqxxV+VdrrRLViXcu15YqoiVJD7ifQMGC9
                        dy9K9xS/s18RmOfIs4Af9+w6YnSH8PJnlS8AGoC8mavVJKYtCt8lvsvLYXumwD7hOum3Wv37p/h+0ijhErCP6tnwyMUHQGcBc3
                        drxIUSsf7TpueIVhyaVMqF82eY2ZjonlgqhCDTHezLBPs8EHnEbL2sj5rCr5IylmKhV0twq5RO/+e/FM25DDdIlBIP90jUVVyvp
                        3J8w3+F8KtjoUuBCBo+LVDFE+XUk0C+UbqZjRYjL5OMiCXO3EuIYqscYVcR7nDWskcxKdKsYFwBbnQl1yrzyxjgl22By3ZKdC
                        
                    yxD73R1TloV2qha7TWgS+sOaezUv1dVK1n0ScJsV+/tkg5Vo8MVbJZt49CqRBYiXSXjiBJrUuRZLbpjKT4zaNypUGmMV0Tsda2bO65
                    TX67M26ZbatR3u+a6XL1ka9+I2P4KN2eyc8U8J3ypEuYuV7a8HMm+WZikUw+3bbxmiXeo5UxmTbBIEeWkKx4toV1aBc9prgwacPxNVk3xoAuRnTmF3waZ0wnxtkfXsMDsfH7C3ET1q+yxtN1Fre3qZy1IKXnmi3ddYXnlCT2OsiKWFZCP1ygXVYWLXcK00avSo+SiVkktn15H1621IwKTXfFot3FPRgu0QR3FcHP7xKPuMMVel1J/6s2QhWvci/PtnAJGLjBF3nG3cm0K7VXAb6JdH9cJqTfGuqae1WRXxtDMAH507+ysnlbdYI+ijxNecJfoyWxzmxJK9BEFa7J9JoX3KutPcW+NrmFuvVbdtw1djj6N0KWxuVGFCa5RUFYTMKtrMmLRrATYm9I1HDVoGWR5X6BAgQL/A/wLdx2nSguoJAMAAAAASUVORK5CYII=">
                </div>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-4 mb-3">
                <div class="bg-white shadow border rounded text-center m-auto pt-5 pb-5 m-2">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAA
                        AAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEc0lEQVR4nO2YW4hWVRTHf6NdrMl0aqrR
                        tHTApvooCknoZcig5qUbPWSoVJraS5ZBaT0IkV2my0MaFGVBL4ElXR5Kw4esGBxBKpjpwfE2
                        SXax0orMy6R+seS/YXU4l2/mO998M3T+sOFw9tprrb33uu0FBQoUKFBglKIBKAELgU7gfaAH2A
                        McBAY0Dupfj2ieAxZorfGoC84F7gPeA/YD5SqH8XgXuFe8a46bgXXA4YgiPwHrgZXA3cBMYBrQBJ
                        yu0aR/M0WzUmt+jvA6LBk35a38WGAO8LUTdhLYAjwEtOUg43LgYaBbvIOcr4C7pENVuBH41jE+ADyjk6
                        0VpgPPyqeCXPOrG4bCbLLs39uwnX4jw4dzgGXAL04P86NJlTK4FfhVC48Cz1fggOYD1wOPAW8BXwL9MVGrX3NG8
                        6jW2No0TABeBI5JJ9vYLVnKvOJsdBtwRQr92fKdD4G/q4hYh4AP5AtnpcgryWeCj64GTosSjQc+FdEJ4KmUk5oKvAD8
                        EXF+s+M1wBLZ8/SYqNWquSWi7Yk49++ygCkph/20dDT6jdL9FMzmvtHEX8DtCUzO140NuA1/DiwCmhk6mrWxL9ymBnTiJj
                        MOd0jXsqLpKb/5yJ1Ie8wiy7oPuChifrMWuIz80Qa8KRllyVyckPnbnd62B1qAHfqxxV+VdrrRLViXcu15YqoiVJD7ifQMGC9
                        dy9K9xS/s18RmOfIs4Af9+w6YnSH8PJnlS8AGoC8mavVJKYtCt8lvsvLYXumwD7hOum3Wv37p/h+0ijhErCP6tnwyMUHQGcBc3
                        drxIUSsf7TpueIVhyaVMqF82eY2ZjonlgqhCDTHezLBPs8EHnEbL2sj5rCr5IylmKhV0twq5RO/+e/FM25DDdIlBIP90jUVVyvp
                        3J8w3+F8KtjoUuBCBo+LVDFE+XUk0C+UbqZjRYjL5OMiCXO3EuIYqscYVcR7nDWskcxKdKsYFwBbnQl1yrzyxjgl22By3ZKdC
                        
                    yxD73R1TloV2qha7TWgS+sOaezUv1dVK1n0ScJsV+/tkg5Vo8MVbJZt49CqRBYiXSXjiBJrUuRZLbpjKT4zaNypUGmMV0Tsda2bO65
                    TX67M26ZbatR3u+a6XL1ka9+I2P4KN2eyc8U8J3ypEuYuV7a8HMm+WZikUw+3bbxmiXeo5UxmTbBIEeWkKx4toV1aBc9prgwacPxNVk3xoAuRnTmF3waZ0wnxtkfXsMDsfH7C3ET1q+yxtN1Fre3qZy1IKXnmi3ddYXnlCT2OsiKWFZCP1ygXVYWLXcK00avSo+SiVkktn15H1621IwKTXfFot3FPRgu0QR3FcHP7xKPuMMVel1J/6s2QhWvci/PtnAJGLjBF3nG3cm0K7VXAb6JdH9cJqTfGuqae1WRXxtDMAH507+ysnlbdYI+ijxNecJfoyWxzmxJK9BEFa7J9JoX3KutPcW+NrmFuvVbdtw1djj6N0KWxuVGFCa5RUFYTMKtrMmLRrATYm9I1HDVoGWR5X6BAgQL/A/wLdx2nSguoJAMAAAAASUVORK5CYII=">
                </div>
            </div>



        </div>
        <div class="col-12 mt-5 text-center"><a href="facility.php" class="bt-color btn btn-sm btn-primary border-0">Show more >>>> </a></div>



    </div>

    <!-- Testimoniyal -->

    <br>
    <br>
    <div class="container mb-5 mt-5">

        <h1 class="fw-bold h-font text-center">Testimoniyal</h1>
        <div class="col-4 m-auto mb-5">

            <hr class="text-black text-bold">
        </div>


        <div class="container">


            <div class="swiper mySwiper_testemonial">
                <div class="swiper-wrapper mb-5">



                    <div class="swiper-slide">
                        <div class="border shadow bg-white p-5 rounded-3">
                            <div class="">
                                <i class="bi bi-archive fw-bold"></i>

                            </div>
                            <h4>Shohag</h4>
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

                    <div class="swiper-slide">
                        <div class="border shadow bg-white p-5 rounded-3">
                            <div class="">
                                <i class="bi bi-archive fw-bold"></i>

                            </div>
                            <h4>Shohag</h4>
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

                    <div class="swiper-slide">
                        <div class="border shadow bg-white p-5 rounded-3">
                            <div class="">
                                <i class="bi bi-archive fw-bold"></i>

                            </div>
                            <h4>Shohag</h4>
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

                    <div class="swiper-slide">
                        <div class="border shadow bg-white p-5 rounded-3">
                            <div class="">
                                <i class="bi bi-archive fw-bold"></i>

                            </div>
                            <h4>Shohag</h4>
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

                    <div class="swiper-slide">
                        <div class="border shadow bg-white p-5 rounded-3">
                            <div class="">
                                <i class="bi bi-archive fw-bold"></i>

                            </div>
                            <h4>Shohag</h4>
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



                </div>
                <div class="swiper-pagination"></div>
            </div>


        </div>




    </div>




    <!-- Reach us -->

    <br>
    <br>
    <div class="container mb-5 mt-5">

        <h1 class="fw-bold h-font text-center">Reach Us</h1>
        <div class="col-4 m-auto mb-5">

            <hr class="text-black text-bold">
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8  p-3 bg-white border">



                <?php

                if ($Contract_r['ifram'] != '') {
                    echo <<<data

                            <iframe class="w-100" src="$Contract_r[ifram]" height="300" loading="lazy"></iframe>

                data;
                }

                ?>



            </div>
            <div class="col-lg-4 col-md-4 pt-3 ">

                <div class="bg-white p-2 shadow-sm rounded mb-3  text-lg-left text-xl-left">
                    <h4>Call us</h4>

                    <div class="mb-2"><i class="bi bi-telephone-fill"></i><a class="text-decoration-none text-black" href="tel:<?php echo "$Contract_r[phn1]"  ?>">+<?php echo "$Contract_r[phn1]"  ?></a></div>
                    <?php

                    if ($Contract_r['phn2'] != "") {
                        echo <<<data
                  
                                     <div class="mb-2"><i class="bi bi-telephone-fill"></i><a class="text-decoration-none text-black" href="tel:$Contract_r[phn2]">+ $Contract_r[phn2]</a></div>
                  
                  data;
                    }
                    ?>



                </div>



                <div class="bg-white p-2 shadow-sm rounded ">
                    <h4>Follow us</h4>

                    <?php

                    if ($Contract_r['fb'] != '') {
                        echo <<<data
                                     <div class="mb-2"><i class="text-primary bi bi-facebook"></i> <a target="_blank" class="text-decoration-none text-black" href="$Contract_r[fb] ">Facebook</a></div>
                          data;
                    }

                    if ($Contract_r['tw'] != '') {
                        echo <<<data
 
                                      <div class="mb-2"><i class="text-primary bi bi-twitter"></i> <a target="_blank" class="text-decoration-none text-black" href="$Contract_r[tw]">twitter</a></div>


                                data;
                    }

                    if ($Contract_r['link'] != '') {
                        echo <<<data
                                      <div class="mb-2"><i class="bi bi-linkedin"></i> <a target="_blank" class="text-decoration-none text-black" href="$Contract_r[link]">linkedin</a></div>
                          data;
                    }


                    if ($Contract_r['snap'] != '') {
                        echo <<<data
                                        <div class="mb-2"><i class="bi bi-snapchat text-warning"></i> <a target="_blank" class="text-decoration-none text-black"  href="$Contract_r[snap]">snapchat</a></div>
                          data;
                    }


                    ?>






                </div>


            </div>
        </div>


        <div class="col-12 mt-5 text-center"><a href="contact.php" class="bt-color btn btn-sm btn-primary border-0">Show more >>>> </a></div>
    </div>
    <!-- Footer -->

    <?php
    include('./inc/footer.php')
    ?>




    <!-- swiper js -->

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".hotelswiper", {
            spaceBetween: 30,
            effect: "fade",
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            }

        });


        // testimonal swiper
        var swiper = new Swiper(".mySwiper_testemonial", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            slidesPerView: "3",
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
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




</html>