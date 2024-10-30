<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- all css link -->
    <?php
    require('./inc/link.php');



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


    <style>

    </style>
    <title>Montral Hotel-About</title>



</head>

<body>

    <!-- HEader -->

    <?php
    include('./inc/header.php')
    ?>


    <!-- Facalites -->

    <div class=" mt-5 mb-5">
        <h1 class="fw-bold h-font text-center">About Us</h1>
        <div class="col-4 m-auto">

            <hr class="text-black text-bold">
            <p class="text-center pt-4 pb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi eligendi aut exercitationem hic.</p>
        </div>


    </div>

    <div class="container">

        <div class="row justify-content-between align-items-center">
            <div class="col-md-6 col-lg-6 ">
                <h4 class="mb-3">Lorem Isoam dolar sit</h4>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi, doloremque sapiente. Voluptatibus voluptatem fuga quos suscipit quibusdam temporibus quod, neque voluptas quo itaque vitae aspernatur, ad deserunt similique qui ea.
            </div>
            <div class="col-md-6 col-lg-6 ">
                <img class="" style="height: 400; width:400" src="./img/aa.png" alt="">
            </div>

        </div>
    </div>




    <div class="container pt-5">

        <div class="row">



            <div class="col-md-4 col-lg-2 col-sm-6 col-xs-6 col-4 border_hover mb-3">

                <div class=" border-top border-4 shadow p-4 border-black rounded border_hover">
                    <img class="w-100 border_hover" src="https://img.freepik.com/free-vector/hotel-booking-concept-background_23-2148146114.jpg?t=st=1718147236~exp=1718147836~hmac=5337dc6735644421190b1c00451217ff810950d49472d741ac814dfc977896a4" alt="">
                    <h5 class="text-center">100+ Rooms</h5>
                </div>

            </div>

            <div class="col-md-4 col-lg-2 col-sm-6 col-xs-6 col-4 border_hover mb-3">

                <div class=" border-top border-4 shadow p-4 border-black rounded border_hover">
                    <img class="w-100 border_hover" src="https://img.freepik.com/free-vector/hotel-booking-concept-background_23-2148146114.jpg?t=st=1718147236~exp=1718147836~hmac=5337dc6735644421190b1c00451217ff810950d49472d741ac814dfc977896a4" alt="">
                    <h5 class="text-center">100+ Rooms</h5>
                </div>

            </div>


            <div class="col-md-4 col-lg-2 col-sm-6 col-xs-6 col-4 border_hover mb-3">

                <div class=" border-top border-4 shadow p-4 border-black rounded border_hover">
                    <img class="w-100 border_hover" src="https://img.freepik.com/free-vector/hotel-booking-concept-background_23-2148146114.jpg?t=st=1718147236~exp=1718147836~hmac=5337dc6735644421190b1c00451217ff810950d49472d741ac814dfc977896a4" alt="">
                    <h5 class="text-center">100+ Rooms</h5>
                </div>

            </div>
            <div class="col-md-4 col-lg-2 col-sm-6 col-xs-6 col-4 border_hover mb-3">

                <div class=" border-top border-4 shadow p-4 border-black rounded border_hover">
                    <img class="w-100 border_hover" src="https://img.freepik.com/free-vector/hotel-booking-concept-background_23-2148146114.jpg?t=st=1718147236~exp=1718147836~hmac=5337dc6735644421190b1c00451217ff810950d49472d741ac814dfc977896a4" alt="">
                    <h5 class="text-center">100+ Rooms</h5>
                </div>

            </div>
            <div class="col-md-4 col-lg-2 col-sm-6 col-xs-6 col-4 border_hover mb-3">

                <div class=" border-top border-4 shadow p-4 border-black rounded border_hover">
                    <img class="w-100 border_hover" src="https://img.freepik.com/free-vector/hotel-booking-concept-background_23-2148146114.jpg?t=st=1718147236~exp=1718147836~hmac=5337dc6735644421190b1c00451217ff810950d49472d741ac814dfc977896a4" alt="">
                    <h5 class="text-center">100+ Rooms</h5>
                </div>

            </div>
            <div class="col-md-4 col-lg-2 col-sm-6 col-xs-6 col-4 border_hover mb-3">

                <div class=" border-top border-4 shadow p-4 border-black rounded border_hover">
                    <img class="w-100 border_hover" src="https://img.freepik.com/free-vector/hotel-booking-concept-background_23-2148146114.jpg?t=st=1718147236~exp=1718147836~hmac=5337dc6735644421190b1c00451217ff810950d49472d741ac814dfc977896a4" alt="">
                    <h5 class="text-center">100+ Rooms</h5>
                </div>

            </div>


        </div>


        <div class=" mt-5 mb-5">
            <h1 class="fw-bold h-font text-center">Management Team</h1>
        </div>


        <div class="container p-3">
            <div class="swiper mySwiper_about">
                <div class="swiper-wrapper pb-5">


                    <?php



                    function showMember()
                    {

                        $membersQ = selectAll('members');
                        while ($members_r = mysqli_fetch_assoc($membersQ)) {

                            $path_member = Abot_image_path;
                            echo <<<data


                                              <div class="swiper-slide bg-white rounded " ><img class="" src="$path_member$members_r[member_img]" alt="">
                                               <h6 class="text-center pt-3">$members_r[member_name]</h6>
                                                     </div>


                                     data;
                        }
                    }
                    showMember();

                    ?>



                </div>






                <div class="swiper-pagination"></div>
            </div>
        </div>

        <!-- Footer -->



        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <!-- Initialize Swiper -->
        <script>
            var swiper = new Swiper(".mySwiper_about", {

                slidesPerView: 4,

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



        <?php
        include('./inc/footer.php')
        ?>


</html>