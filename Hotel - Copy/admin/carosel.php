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
                <h4 class="text-center">Home carusel Image settings</h4>


                <!-- Team member siting-->
                <div class="card shadow-sm mt-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="mb-3">
                                <h5 class="card-title pb-3">Add Carusel Image</h5>
                            </div>

                            <button type="button" class="btn btn-sm bg-secondary text-white " data-toggle="modal" data-target="#carusel_model"><i class="bi bi-plus-square-fill"></i> Add</button>

                        </div>

                        <div id="Carusel_data" class="row">



                        </div>



                    </div>
                </div>

                <!-- Team member Modal-->

                <div class="modal fade" id="carusel_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content ">
                            <div class="modal-header d-flex justify-content-between">



                                <h5 class="modal-title" id="exampleModalLongTitle">Add Team Membeer</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form id="add_carusel_from">
                                <div class="modal-body">
                                    <div class="modal-body">

                                        <div class="form-group mb-3">
                                            <label for="exampleInputPassword1">carusel Photo</label>
                                            <input type="file" accept=".jpeg,.png,.webp,.jpg" class="form-control" id="carusel_imgae_inp" required name="" required></input>
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



    <script>
        let add_carusel_from = document.getElementById('add_carusel_from');

        add_carusel_from.addEventListener('submit', function(e) {

            e.preventDefault();
            add_carusel();
        })
        // insert new team member
        function add_carusel() {
            let carusel_imgae_inp = document.getElementById('carusel_imgae_inp');

            let frmdata = new FormData();
            frmdata.append('carusel_imge', carusel_imgae_inp.files[0]);
            frmdata.append('add_carusel', '');


            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/carusel_crud.php", true);




            xhr.onload = function() {

                $('#carusel_model').modal('hide');
                console.log(this.response);

                if (this.responseText == 1) {
                    alert("success", 'carusel added successfully');
                    get_carosel();
                    carusel_imgae_inp.value = '';

                } else if (this.responseText === "inv_img") {
                    alert("error", 'invalid image .Image allowed only png,jpeg,webp....! ');

                } else if (this.responseText === "size_img") {
                    alert("error", 'invalid image size. Image allowed less then 2 mb! ');

                } else if (this.responseText === "img_upd_Fail") {
                    alert("error", 'image didnt move to about folder ');

                }


            }

            xhr.send(frmdata);

        }



        function get_carosel() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/carusel_crud.php", true);


            xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');


            xhr.onload = function() {

                document.getElementById('Carusel_data').innerHTML = this.responseText;

            };
            xhr.send('get_carosel');



        }

        // delete member phpto
        function delete_carusel_Img(val) {

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/carusel_crud.php", true);

            xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {

                if (this.responseText == 1) {
                    alert("success", "Member delete successful..!");
                    get_carosel();
                }
            }



            xhr.send('sr_no=' + val + "&delete_carosel_Image");


        };


        window.onload = function() {

            get_carosel();
        }
    </script>
</body>

</html>