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


    <title>Montral Hotel-facilities</title>



</head>

<body>





    <!-- HEader -->

    <?php
    include('./inc/header.php')
    ?>


    <!-- Facalites -->

    <div class=" mt-5 mb-5">
        <h1 class="fw-bold h-font text-center">Our Facalites</h1>
        <div class="col-4 m-auto">

            <hr class="text-black text-bold">
            <p class="text-center pt-4 pb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi eligendi aut exercitationem hic.</p>
        </div>


        <div class="container pt-3">
            <div class="row ">

                <?php

                $res = selectAll('facilites');
                while ($row = mysqli_fetch_assoc($res)) {
                    $path = FACILITES_IMAGE_PATH;
                    echo <<<data

                           <div id='facilitesss' class="border_hover mb-3 m-auto col-lg-2 col-md-2 col-sm-4 col-mb-3 col-xs-5 col-6 "'>
                            <div class="border-top border-4 border-black bg-white shadow  rounded text-center m-auto pt-5 pb-5 m-2">
                             <img class='w-100' src='$path$row[img]'></img>
                             <h4 class='text-center'>$row[name]</h4>
                             <p>$row[des]</p>
                             </div>
                            </div>




                data;
                }


                ?>

            </div>

        </div>



        <!-- Footer -->

        <?php
        include('./inc/footer.php')
        ?>
</body>

</html>