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

    <div class="container-fluid main_content mt-5">
        <div class="row">
            <div class=" col-lg-10 ms-auto p-4 ">
                <h4 class="text-center">Room setings</h4>

                <!-- Room ADd  setting-->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title pb-3">Add room</h5>
                            <button type="button" class="btn btn-sm bg-secondary text-white" data-toggle="modal" data-target="#room_model"><i class="bi bi-plus"></i> Add</button>

                        </div>

                    </div>
                </div>

                <!-- Room  Modal -->

                <div class="modal modal-lg fade" id="room_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content ">
                            <div class="modal-header d-flex justify-content-between">

                                <h5 class="modal-title" id="exampleModalLongTitle">Add Room</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="Post" id="add_room_frm">
                                <div class="modal-body">
                                    <div class="modal-body">


                                        <div class="row">
                                            <div class="form-group mb-3 col-md-6 col-lg-6">
                                                <label for="exampleInputEmail1">Name</label>
                                                <input type="text" name='room_name' id='site_title_inp' required class="form-control" id="" aria-describedby="emailHelp" required>
                                            </div>
                                            <div class="form-group mb-3 col-md-6 col-lg-6">
                                                <label for="exampleInputPassword1">Area</label>
                                                <input type="number" class="form-control" required name="room_area" require></input>
                                            </div>
                                            <div class="form-group mb-3 col-md-6 col-lg-6">
                                                <label for="exampleInputPassword1">Quantity</label>
                                                <input type="number" class="form-control" required name="room_quantity" require></input>
                                            </div>
                                            <div class="form-group mb-3 col-md-6 col-lg-6">
                                                <label for="exampleInputPassword1">Price</label>
                                                <input type="number" class="form-control" required name="room_price" require></input>
                                            </div>
                                            <div class="form-group mb-3 col-md-6 col-lg-6">
                                                <label for="exampleInputPassword1">Adult Max()</label>
                                                <input type="number" class="form-control" required name="room_adult" require></input>
                                            </div>
                                            <div class="form-group mb-3 col-md-6 col-lg-6">
                                                <label for="exampleInputPassword1">children Max()</label>
                                                <input type="number" class="form-control" required name="room_child" require></input>
                                            </div>

                                            <!-- get feature -->
                                            <p class="font-weight-bold">Features</p>
                                            <?php

                                            $res = selectAll('features');
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                echo <<<data
                                                
                                                    <div class="form-check col-md-3 col-lg-3 mb-4">
                                                            <label class="form-check-label"> 
                                                    <input class="form-check-input" type="checkbox" name='feature' value="$row[sr_no]" id="flexCheckDefault">
                                            $row[feature_name]
                                                    </label>
                                                    </div>
                                        data;
                                            }

                                            ?>


                                            <!-- get Facilites -->
                                            <p class="font-weight-bold">Facilites</p>
                                            <?php

                                            $res = selectAll('facilites');
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                echo <<<data
                                                
                                                    <div class="form-check col-md-3 col-lg-3 mb-2">
                                                            <label class="form-check-label"> 
                                                    <input class="form-check-input" name='facilites' type="checkbox" value="$row[sr_no]" id="flexCheckDefault">
                                            $row[name]
                                                    </label>
                                                    </div>
                                        data;
                                            }

                                            ?>



                                            <div class="form-group mb-3">
                                                <label for="exampleInputPassword1">Descriotipn</label>
                                                <textarea class="form-control" required name="room_des" id="exampleFormControlTextarea1" rows="5" require></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary ">Save changes</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>


                <!-- get room table -->
                <div class="card shadow-sm">
                    <div class="card-body">


                        <div class="table-resposive-md " style="height: 300px; overflow-y:scroll;">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Area</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">price</th>
                                        <th scope="col">Member allow</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                <tbody id="room_table">


                                </tbody>
                            </table>
                        </div>



                    </div>
                </div>

                <!-- edite room -->

                <div class="modal modal-lg fade" id="room_edite" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content ">
                            <div class="modal-header d-flex justify-content-between">

                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Room</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="Post" id="edite_room_frm">
                                <div class="modal-body">
                                    <div class="modal-body">


                                        <div class="row">
                                            <div class="form-group mb-3 col-md-6 col-lg-6">
                                                <label for="exampleInputEmail1">Name</label>
                                                <input type="text" name='room_name' id='site_title_inp' required class="form-control" id="" aria-describedby="emailHelp" required>
                                            </div>
                                            <div class="form-group mb-3 col-md-6 col-lg-6">
                                                <label for="exampleInputPassword1">Area</label>
                                                <input type="number" class="form-control" required name="room_area" require></input>
                                            </div>
                                            <div class="form-group mb-3 col-md-6 col-lg-6">
                                                <label for="exampleInputPassword1">Quantity</label>
                                                <input type="number" class="form-control" required name="room_quantity" require></input>
                                            </div>
                                            <div class="form-group mb-3 col-md-6 col-lg-6">
                                                <label for="exampleInputPassword1">Price</label>
                                                <input type="number" class="form-control" required name="room_price" require></input>
                                            </div>
                                            <div class="form-group mb-3 col-md-6 col-lg-6">
                                                <label for="exampleInputPassword1">Adult Max()</label>
                                                <input type="number" class="form-control" required name="room_adult" require></input>
                                            </div>
                                            <div class="form-group mb-3 col-md-6 col-lg-6">
                                                <label for="exampleInputPassword1">children Max()</label>
                                                <input type="number" class="form-control" required name="room_child" require></input>
                                            </div>
                                            <div class="form-group mb-3 col-md-6 col-lg-6">
                                                <label for="exampleInputPassword1"></label>
                                                <input type="hidden" class="form-control" required name="room_id" require></input>
                                            </div>
                                            <!-- get feature -->
                                            <p class="font-weight-bold">Features</p>
                                            <?php

                                            $res = selectAll('features');
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                echo <<<data
                                                
                                                    <div class="form-check col-md-3 col-lg-3 mb-4">
                                                            <label class="form-check-label"> 
                                                    <input class="form-check-input" type="checkbox" name='feature' value="$row[sr_no]" id="flexCheckDefault">
                                            $row[feature_name]
                                                    </label>
                                                    </div>
                                        data;
                                            }

                                            ?>


                                            <!-- get Facilites -->
                                            <p class="font-weight-bold">Facilites</p>
                                            <?php

                                            $res = selectAll('facilites');
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                echo <<<data
                                                
                                                    <div class="form-check col-md-3 col-lg-3 mb-2">
                                                            <label class="form-check-label"> 
                                                    <input class="form-check-input" name='facilites' type="checkbox" value="$row[sr_no]" id="flexCheckDefault">
                                            $row[name]
                                                    </label>
                                                    </div>
                                        data;
                                            }

                                            ?>



                                            <div class="form-group mb-3">
                                                <label for="exampleInputPassword1">Descriotipn</label>
                                                <textarea class="form-control" required name="room_des" id="exampleFormControlTextarea1" rows="5" require></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary ">Save changes</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>




                <!-- Add room model image-->

                <div class="modal modal-lg fade" id="Add_img_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content ">
                            <div class="modal-header d-flex justify-content-between">

                                <h5 class="modal-title" id="exampleModalLongTitle">Room Name</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="Post" id="add_room_img_frm">
                                <div class="modal-body">
                                    <div class="modal-body">


                                        <div id="model_alert"> </div>
                                        <div class="card shadow-sm">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-around row my-4">
                                                    <input type="hidden" name='room_id' required class="form-control">
                                                    <input type="hidden" name='room_name_p' required class="form-control">
                                                    <div class="form-group mb-6 col-md-6 col-lg-6">

                                                        <input type="file" accept=".jpeg,.png,.webp" name='room_img' required class="form-control">
                                                    </div>


                                                    <div class="form-group d-flex justify-content-end mb-6 col-md-6 col-lg-6">

                                                        <button type="button" class="btn btn-sm bg-secondary text-white" onclick=add_room_IMG()><i class="bi bi-plus"></i> Add photo</button>
                                                    </div>


                                                </div>
                                                <hr>

                                                <div>



                                                    <div class=" table-resposive-md " style=" height: 300px; overflow-y:scroll;">

                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">image</th>
                                                                    <th scope="col">thume</th>
                                                                    <th scope="col">action</th>

                                                                </tr>
                                                            <tbody id="room_img_table">


                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>





                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>


            </div>



        </div>


    </div>
    <script src="./scripts/room.js"></script>

</body>

</html>