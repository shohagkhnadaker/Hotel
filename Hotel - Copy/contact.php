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

        .aler_css {
            position: fixed;
            top: 80px !important;
            right: 100px;
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
        <h1 class="fw-bold h-font text-center">Contact with us</h1>
        <div class="col-4 m-auto">

            <hr class="text-black text-bold">
            <p class="text-center pt-4 pb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi eligendi aut exercitationem hic.</p>
        </div>





    </div>




    <div class="container pb-4">
        <div class="row">
            <div class="col-md-6 col-md-6 bg-white">

                <div class="shadow p-2 pb-0">

                    <?php
                    if ($Contract_r['ifram'] != '') {

                        echo <<<data
  <iframe class="w-100" src="$Contract_r[ifram]" height="300" loading="lazy"></iframe>


<div class='overflow-hidden text-center px-2'>
  <h5 class="pt-3">location link:</h5>
  <h6><a class=" pt-5 text-decoration-none" href="$Contract_r[ifram]">$Contract_r[ifram]</a></h6>

</div>

data;
                    }


                    ?>



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
                        <?php

                        if ($Contract_r['email'] != "") {
                            echo <<<data
                                          <h5>Email</h5>
                                          <div class="mb-2"><i class="bi bi-envelope-open-fill"></i> <a class="text-decoration-none text-black" href="tel:0549108524">$Contract_r[email]</a></div>

                                 data;
                        }
                        ?>


                        <h5>Follow us</h5>

                        <div class="d-flex">

                            <?php

                            if ($Contract_r['fb'] != '') {
                                echo <<<data
                     <div class="mb-2 mx-2"><i class="text-primary bi bi-facebook"></i> <a class="text-decoration-none text-black" target="_blank" href="$Contract_r[fb] "></a></div>
          data;
                            }

                            if ($Contract_r['tw'] != '') {
                                echo <<<data

                      <div class="mb-2  mx-2"><i class="text-primary bi bi-twitter"></i> <a target="_blank" class="text-decoration-none text-black" href="$Contract_r[tw]"></a></div>


                data;
                            }

                            if ($Contract_r['link'] != '') {
                                echo <<<data
                      <div class="mb-2  mx-2"><i class="bi bi-linkedin"></i> <a target="_blank" class="text-decoration-none text-black" href="$Contract_r[link]"></a></div>
          data;
                            }


                            if ($Contract_r['snap'] != '') {
                                echo <<<data
                        <div class="mb-2  mx-2"><i class="bi bi-snapchat text-warning"></i> <a target="_blank" class="text-decoration-none text-black"  href="$Contract_r[snap]"></a></div>
          data;
                            }


                            ?>



                        </div>

                    </div>

                    <div class="bg-white p-2 shadow-sm rounded ">

                    </div>





                </div>
            </div>



            <!-- massage section -->

            <div class="col-md-6 col-md-6 bg-white">

                <div class="shadow p-4">
                    <h4 class="p-3">Send us a message</h4>
                    <form method="POST">



                        <div class="modal-body">
                            <div class="form-group mb-4">
                                <label class="pb-2" for="exampleInputPassword1">Name</label>
                                <input type="text" name="name_msg_inv" class="form-control" id="exampleInputPassword1" placeholder="name" required>
                            </div>
                            <div class="form-group mb-4">
                                <label class="pb-2" for="exampleInputPassword1">email</label>
                                <input type="email" name="email_msg_inv" class="form-control" id="exampleInputPassword1" placeholder="example@gmail.com" required>
                            </div>

                            <div class="form-group mb-4">
                                <label class="pb-2" for="exampleInputPassword1">Subject</label>
                                <input type="text" name="subject_msg_inv" class="form-control" id="exampleInputPassword1" placeholder="Subject" required>
                            </div>


                            <div class="form-group mb-4">
                                <label class="pb-2" for="exampleInputPassword1">Write your masssage</label>
                                <textarea type="text-area" name="msg_msg_inv" rows="7" class="form-control" id="exampleInputPassword1" placeholder="write here" required></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">

                            <button type="submit" name="send" class="btn bt-color btn-primary m-auto">Send</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->

    <?php
    include('./inc/footer.php');


    if (isset($_POST['send'])) {
        $frm_data = filterdata($_POST);



        $value = [$frm_data['name_msg_inv'], $frm_data['email_msg_inv'], $frm_data['subject_msg_inv'], $frm_data['msg_msg_inv'],];
        $q = "INSERT INTO `massage`( `name`, `email`, `subject`, `msg`) VALUES (?,?,?,?)";

        $res = Insert($q, $value, 'ssss');

        if ($res == 1) {


            echo alerts('success', "massege sent successfully...!");
        } else {
            echo alerts('error', "somthing wrong.server dow");
        }
    }



    ?>
</body>

</html>