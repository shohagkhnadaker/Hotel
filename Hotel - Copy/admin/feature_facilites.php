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

    <div class="container-fluid main_content">
        <div class="row">
            <div class=" col-lg-10 ms-auto p-4 ">
                <div class="d-flex justify-content-between"></div>
                <div>

                </div>


                <!-- Add feature-->

                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title pb-3"> Add features</h5>
                            <button type="button" class="btn btn-sm bg-secondary text-white" data-toggle="modal" data-target="#featuremodal"><i class="bi bi-pencil-square"></i>Add feature</button>

                        </div>

                    </div>
                </div>

                <!-- feature edite Modal -->

                <div class="modal fade" id="featuremodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content ">
                            <div class="modal-header d-flex justify-content-between">

                                <h5 class="modal-title" id="exampleModalLongTitle"> Add feature</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form method="Post" id="feature_frm">
                                <div class="modal-body">
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label for="exampleInputEmail1">Feature Name</label>
                                            <input type="text" name='feature_name_inv' id='site_title_inp' required class="form-control" id="" aria-describedby="emailHelp" required>
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


                <div class="card shadow-sm">
                    <div class="card-body">


                        <div class="table-resposive-md " style="height: 300px; overflow-y:scroll;">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>

                                    </tr>
                                </thead>
                                <tbody id="feature_data">




                                </tbody>
                            </table>
                        </div>



                    </div>
                </div>



            </div>



        </div>


    </div>



    <div class="container-fluid main_content">
        <div class="row">
            <div class=" col-lg-10 ms-auto p-4 ">
                <div class="d-flex justify-content-between"></div>
                <div>

                </div>


                <!--Add facilites -->

                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title pb-3"> Add facilites</h5>
                            <button type="button" class="btn btn-sm bg-secondary text-white" data-toggle="modal" data-target="#facalitymodal"><i class="bi bi-pencil-square"></i>Add Facilites</button>

                        </div>

                    </div>
                </div>

                <!-- facilites edite Modal -->

                <div class="modal fade" id="facalitymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content ">
                            <div class="modal-header d-flex justify-content-between">

                                <h5 class="modal-title" id="exampleModalLongTitle"> Add facilitiyes</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form method="Post" id="facaliti_frm">
                                <div class="modal-body">
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label for="exampleInputEmail1">Facality Name</label>
                                            <input type="text" name='facaliti_name_inv' required class="form-control" id="" aria-describedby="emailHelp" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="exampleInputEmail1">photo</label>
                                            <input type="file" accept=".svg" name='facaliti_img_inv' required class="form-control" id="" aria-describedby="emailHelp" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="exampleInputPassword1">description</label>
                                            <textarea class="form-control" required name="facaliti_des_inv" id="exampleFormControlTextarea1" rows="5" require></textarea>
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


                <div class="card shadow-sm">
                    <div class="card-body">


                        <div class="table-resposive-md " style="height: 300px; overflow-y:scroll;">

                            <table class="table ">
                                <thead class="bg-blue">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Icon</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>

                                    </tr>
                                </thead>
                                <tbody id="fecilites_data">




                                </tbody>
                            </table>
                        </div>



                    </div>
                </div>



            </div>



        </div>


    </div>







    <script>
        // insert new team member
        let facaliti_frm = document.getElementById('facaliti_frm');

        let feature_frm = document.getElementById('feature_frm');

        feature_frm.addEventListener("submit", function(e) {
            e.preventDefault();
            add_feature_new();
        });

        function add_feature_new() {

            let frmdata = new FormData();
            frmdata.append('name', feature_frm.elements['feature_name_inv'].value);
            frmdata.append('add_feature', '');


            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/feature_facilies_crud.php", true);




            xhr.onload = function() {

                $('#featuremodal').modal('hide');

                if (this.responseText == 1) {
                    alert("success", 'Feature added successfully');
                    Get_Features();
                    feature_frm.elements['feature_name_inv'].value = "";

                } else {
                    alert("error", 'server down ');

                }


            }

            xhr.send(frmdata);

        }

        // get feature

        function Get_Features() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/feature_facilies_crud.php", true);


            xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');


            xhr.onload = function() {

                document.getElementById('feature_data').innerHTML = this.responseText;

            };
            xhr.send('Get_Features');



        }

        // delete feature
        function del_feature(val) {

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/feature_facilies_crud.php", true);


            xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');


            xhr.onload = function() {
                if (this.responseText == 1) {

                    alert('success', 'feature delete successfully....')
                    Get_Features();
                } else if (this.responseText = "room_aded") {
                    alert('error', 'Sorry....this Feature is alredy added on room...! fast you have to remove from room feature')
                    Get_Features();
                } else {
                    alert('error', 'server down....')

                }


            };
            xhr.send('sr_no=' + val + "&delete_feature");

        }


        facaliti_frm.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('hlw');

            add_facilites();

        })

        function add_facilites() {

            let frmdata = new FormData();
            frmdata.append('name', facaliti_frm.elements['facaliti_name_inv'].value);
            frmdata.append('img', facaliti_frm.elements['facaliti_img_inv'].files[0]);
            frmdata.append('des', facaliti_frm.elements['facaliti_des_inv'].value);
            frmdata.append('add_facilitess', '');


            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/feature_facilies_crud.php", true);




            xhr.onload = function() {

                $('#facalitymodal').modal('hide');

                if (this.responseText == 1) {
                    alert("success", 'Member added successfully');
                    Get_facilites();
                    facaliti_frm.reset();

                } else if (this.responseText === "inv_img") {
                    alert("error", 'invalid image .Image allowed only Svg....! ');

                } else if (this.responseText === "inv_size") {
                    alert("error", 'invalid image size. Image allowed less then 1 mb! ');

                } else if (this.responseText === "img_upd_Fail") {
                    alert("error", 'image didn`t move to about folder ');

                }

            }

            xhr.send(frmdata);

        }


        function Get_facilites() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/feature_facilies_crud.php", true);


            xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');


            xhr.onload = function() {

                document.getElementById('fecilites_data').innerHTML = this.responseText;

            };
            xhr.send('Get_facilites');

        };



        // delete facilites

        function del_facilites(val) {


            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/feature_facilies_crud.php", true);


            xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');


            xhr.onload = function() {
                console.log(this.responseText);
                if (this.responseText == 1) {

                    alert('success', 'fecilites delete successfully....')
                    Get_facilites();
                } else if (this.responseText = 'room_aded') {
                    alert('error', 'Sorry this facilites alredy added on room.Fast you have remove from room. ')
                } else {
                    alert('error', 'server down....')

                }


            };
            xhr.send('sr_no=' + val + "&delete_fecilites");

        }


        window.onload = function() {
            Get_Features();
            Get_facilites();
        }
    </script>



</body>

</html