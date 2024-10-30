<?php

require('inc/essentials.php');
require('inc/db_config.php');


adminLogin();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php

    require('inc/link.php');

    ?>
    <link rel="stylesheet" href="css/commom.css">



    <title>Admin_Dashbord</title>
</head>

<body>
    <!-- top header -->
    <?php
    require('inc/header.php');
    require('inc/scripts.php');

    ?>

    <div class="container-fluid main_content ">
        <div class="row">
            <div class=" col-lg-10 ms-auto p-4 ">
                <h4 class="text-center">settings</h4>

                <!-- genarel  setting-->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title pb-3">Genarel setting</h5>
                            <button type="button" class="btn btn-sm bg-secondary text-white" data-toggle="modal" data-target="#genarelmodal"><i class="bi bi-pencil-square"></i> edit</button>

                        </div>
                        <h6 class="card-subtitle mb-2 text-muted fw-bold">Site title</h6>
                        <p id="site_title"></p>
                        <h6 class="card-subtitle mb-2 text-muted fw-bold">side About</h6>

                        <p class="card-text" id="site_about"></p>

                    </div>
                </div>

                <!-- genarel edite Modal -->

                <div class="modal fade" id="genarelmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content ">
                            <div class="modal-header d-flex justify-content-between">

                                <h5 class="modal-title" id="exampleModalLongTitle">Genarel setting</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="Post" id="updGenarel">
                                <div class="modal-body">
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label for="exampleInputEmail1">Site Title</label>
                                            <input type="text" name='site_titles' id='site_title_inp' required class="form-control" id="" aria-describedby="emailHelp" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="exampleInputPassword1">site About</label>
                                            <textarea class="form-control" id="site_about_inp" required name="site_abouts" id="exampleFormControlTextarea1" rows="5" require></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" onclick="site_titles.value = g_data.site_title , site_abouts.value = g_data.site_about" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary ">Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>


                <!-- shutdown  setting-->
                <div class="card mt-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title pb-3">shutdown setting</h5>

                        <div class="d-flex justify-content-between">

                            <p id="site_title">If you on your shutdown the website coustomar can not book hotel</p>
                            <div class="form-check form-switch mx-3">
                                <input onchange=upd_shutdown(this.value) class="form-check-input large" type="checkbox" id="shutdown_toggle">
                            </div>
                        </div>


                    </div>
                </div>



                <!-- contract  setting-->
                <div class="card shadow-sm mt-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title pb-3">Contact setting</h5>
                            <button type="button" class="btn btn-sm bg-secondary text-white" data-toggle="modal" data-target="#conratctmodal"><i class="bi bi-pencil-square"></i> edit</button>

                        </div>

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <h6 class="card-subtitle mb-2 text-muted fw-bold">Address</h6>
                                    <p id="address"></p>
                                </div>


                                <div class="mb-3">
                                    <h6 class="card-subtitle mb-2 text-muted fw-bold">Map</h6>

                                    <p class="card-text" id="gmap"></p>
                                </div>

                                <div class="mb-3">
                                    <h6 class="card-subtitle mb-2 text-muted fw-bold">phone</h6>

                                    <p class=""><i class="bi bi-telephone-fill"> <span id="phn1"></span></i></p>
                                    <p class=""><i class="bi bi-telephone-fill"> <span id="phn2"></span></i></p>
                                </div>
                                <div class="mb-3">
                                    <h6 class="card-subtitle mb-2 text-muted fw-bold">Email</h6>

                                    <p class="card-text" id="email"></p>
                                </div>

                            </div>
                            <div class="col-lg-6">

                                <div class="mb-3">
                                    <h6 class="card-subtitle mb-2 text-muted fw-bold"></h6>

                                    <p class=""><i class="text-primary bi bi-facebook"></i> <span id="fb"></span></p>
                                    <p class=""><i class="text-primary bi bi-twitter"></i> <span id="tw"></span></p>
                                    <p class=""><i class="bi bi-linkedin"></i> <span id="link"></span></p>
                                    <p class=""><i class="bi bi-snapchat text-warning"></i></i> <span id="snap"></span></p>
                                </div>
                                <div class="mb-3 w-100 p-2">
                                    <h6 class="card-subtitle mb-2 text-muted fw-bold">ifram</h6>

                                    <iframe id="ifram" class="p-2 w-100" loading='lazy' src=""></iframe>
                                </div>

                            </div>

                        </div>



                    </div>
                </div>
                <!-- Contract Model -->

                <!-- contract edite Modal -->

                <div class="modal fade bd-example-modal-lg" id="conratctmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content ">
                            <div class="modal-header d-flex justify-content-between">
                                <h5 class="modal-title" id="exampleModalLongTitle">conracts setting</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form id="update_contrats_form">
                                <div class="modal-body">
                                    <div class="modal-body">


                                        <div class="row">


                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label for="exampleInputEmail1">Adress</label>
                                                    <input type="text" id='address_inp' name='address' class="form-control" id="" aria-describedby="emailHelp" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="exampleInputPassword1">Google Map</label>
                                                    <input class="form-control" id="gmap_inp" required></input>
                                                </div>

                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone-fill"></i></span>
                                                    <input id="phn1_inp" type="number" class="form-control" placeholder="number" required aria-label="Username" aria-describedby="basic-addon1">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone-fill"></i></span>
                                                    <input id="phn2_inp" type="number" class="form-control" placeholder="number" aria-label="Username" aria-describedby="basic-addon1">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="exampleInputEmail1">Email</label>
                                                    <input type="text" id='email_inp' class="form-control" aria-describedby="emailHelp" required>
                                                </div>




                                            </div>
                                            <div class="col-lg-6">


                                                <div class="form-group mb-3">
                                                    <label for="exampleInputEmail1">Social link</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1"><i class="text-primary bi bi-facebook"></i></span>
                                                        <input id="fb_inp" type="text" class="form-control" placeholder="src" required aria-label="Username" aria-describedby="basic-addon1">
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1"><i class="text-primary bi bi-twitter"></i></span>
                                                        <input id="tw_inp" type="taxt" class="form-control" placeholder="src" required aria-label="Username" aria-describedby="basic-addon1">
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1"><i class=" bi bi-linkedin"></i></span>
                                                        <input id="link_inp" type="taxt" class="form-control" placeholder="src" required aria-label="Username" aria-describedby="basic-addon1">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1"><i class=" text-warning bi bi-snapchat"></i></span>
                                                        <input id="snap_inp" type="taxt" class="form-control" placeholder="src" required aria-label="Username" aria-describedby="basic-addon1">
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="exampleInputEmail1">ifrem</label>
                                                        <input type="text" id='ifram_inp' class="form-control" aria-describedby="emailHelp" required>
                                                    </div>

                                                </div>

                                            </div>



                                        </div>





                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" onclick=contract_inp(c_data) data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary ">Save changes</button>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>

                </div>

                <!-- Team member siting-->
                <div class="card shadow-sm mt-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="mb-3">
                                <h5 class="card-title pb-3">Add Team Member</h5>
                            </div>

                            <button type="button" class="btn btn-sm bg-secondary text-white " data-toggle="modal" data-target="#tream_model"><i class="bi bi-plus-square-fill"></i> Add</button>

                        </div>

                        <div id="team_member_data" class="row">



                        </div>



                    </div>
                </div>

                <!-- Team member Modal-->

                <div class="modal fade" id="tream_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content ">
                            <div class="modal-header d-flex justify-content-between">



                                <h5 class="modal-title" id="exampleModalLongTitle">Add Team Membeer</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form id="Add_team_from">
                                <div class="modal-body">
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" name='Team_naem' id='Team_Member_name_inp' required class="form-control" aria-describedby="emailHelp" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="exampleInputPassword1">Member Photo</label>
                                            <input type="file" accept=".jpeg,.png,.webp" class="form-control" id="Team_member_img_inp" required name="" required></input>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary ">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>





            </div>



        </div>


    </div>



    <!-- load js -->
    <script src="scripts/setting.js">

    </script>

</body>

</html>