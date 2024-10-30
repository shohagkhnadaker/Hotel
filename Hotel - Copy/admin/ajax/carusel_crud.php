<?php


require('../inc/essentials.php');
require('../inc/db_config.php');

// Add member
if (isset($_POST['add_carusel'])) {

    $img_resut = upload_Img($_FILES['carusel_imge'], CAROSEL_FOLDER);

    if ($img_resut == "inv_img") {
        echo $img_resut;
        exit;
    } elseif ($img_resut == "size_img") {
        echo $img_resut;
        exit;
    } elseif ($img_resut == "img_upd_Fail") {
        echo $img_resut;
        exit;
    } else {

        $q = "INSERT INTO `carusel`( `carosel_image`) VALUES (?)";
        $value = [$img_resut];
        $res = Insert($q, $value, "s");
        echo $res;
    }
};



// get_Members
if (isset($_POST['get_carosel'])) {

    $res = selectAll('carusel');


    while ($data = mysqli_fetch_assoc($res)) {
        $path = CARUSEL_IMAGE_PATH;
        echo <<<data
                     <div class="col-md-3 col-sm-3 col-xs-3">
                                <div class="card bg-dark text-white ">
                                    <img class="card-img " id="img" src="$path$data[carosel_image]" alt="Card image">
                                    <div class="card-img-overlay text-end">

                                        <button onclick="delete_carusel_Img($data[sr_no])" class="btn btn-danger "><i class="bi bi-trash3-fill"></i> Delete</button>
                                    </div>
                                 
                                </div>

                            </div>


                       

        data;
    };
};

// delete member
if (isset($_POST['delete_carosel_Image'])) {

    $q = "SELECT * FROM `carusel` WHERE `sr_no`=?";
    $value = [$_POST['sr_no']];
    $res = select($q, $value, 'i');


    $imageName = mysqli_fetch_assoc($res);

    $img_res = delete_Image($imageName['carosel_image'], CAROSEL_FOLDER);
    if ($img_res) {
        $q = "DELETE FROM `carusel` WHERE `carosel_image`=?";
        $value = [$imageName['carosel_image']];
        $res = delete($q, $value, "s");
        if ($res == 1) {
            echo 1;
        } else {
            echo 0;
        }
    } else {
        echo 'image unlink faild';
    }
};
