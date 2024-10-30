<?php


require('../inc/essentials.php');
require('../inc/db_config.php');




// get genarel data
if (isset($_POST['get_genarel'])) {


    $q = "SELECT * FROM `settings` WHERE `sr_no`=?";
    $value = [1];
    $res = select($q, $value, "i");
    $data = mysqli_fetch_assoc($res);
    $json_data = json_encode($data);
    echo $json_data;
};

// update Genarel data
if (isset($_POST['upd_genarel'])) {

    $flt_data = filterdata($_POST);
    $q = "UPDATE `settings` SET `site_title`=?,`site_about`=? WHERE `sr_no`=?";
    $value = [$flt_data['site_title_val'], $flt_data['site_about_val'], 1];
    $res = update($q, $value, "ssi");
    echo $res;
};


// update Shutdown
if (isset($_POST['shutdown_val'])) {


    $frm_data = ($_POST['shutdown_val'] == 0) ? 1 : 0;

    $q = "UPDATE `settings` SET `site_sutdown`=? WHERE `sr_no`=?";
    $value = [$frm_data, 1];
    $res = update($q, $value, "ii");
    echo $res;
};


// Get Contract Data
if (isset($_POST['get_contarct'])) {


    $q = "SELECT * FROM `contracts` WHERE `sr_no`=?";
    $value = [1];
    $res = select($q, $value, "i");
    $data = mysqli_fetch_assoc($res);
    $json_data = json_encode($data);
    echo $json_data;
};

// update contract data
if (isset($_POST['contract_update'])) {

    $flt_data = filterdata($_POST);



    $q = "UPDATE `contracts` SET `address`=?,`map`=?,`phn1`=?,`phn2`=?,`email`=?,`fb`=?,`tw`=?,`link`=?,`snap`=?,`ifram`=? WHERE `sr_no`=?";
    $value = [$flt_data['address'], $flt_data['gmap'], $flt_data['phn1'], $flt_data['phn2'], $flt_data['email'], $flt_data['fb'], $flt_data['tw'], $flt_data['link'], $flt_data['snap'], $flt_data['ifram'], 1];
    $res = update($q, $value, "ssiissssssi");
    echo $res;
};
// Add member
if (isset($_POST['add_member'])) {
    $flt_data = filterdata($_POST);

    $img_resut = upload_Img($_FILES['member_img'], ABOUT_FOLDER);

    if ($img_resut == "inv_img") {
        echo $img_resut;
    } elseif ($img_resut == "inv_size") {
        echo $img_resut;
    } elseif ($img_resut == "img_upd_Fail") {
        echo $img_resut;
    } else {

        $q = "INSERT INTO `members`( `member_name`, `member_img`) VALUES (?,?)";
        $value = [$flt_data['name'], $img_resut];
        $res = Insert($q, $value, "ss");
        echo $res;
    }
};



// get_Members
if (isset($_POST['get_Members'])) {

    $res = selectAll('members');


    while ($data = mysqli_fetch_assoc($res)) {
        $path = Abot_image_path;
        echo <<<data
                     <div class="col-md-3 col-sm-3 col-xs-3">
                                <div class="card bg-dark text-white ">
                                    <img class="card-img " id="img" src="$path$data[member_img]" alt="Card image">
                                    <div class="card-img-overlay text-end">


                                        <button onclick="deleteImg($data[sr_no])" class="btn btn-danger "><i class="bi bi-trash3-fill"></i> Delete</button>
                                    </div>
                                    <h5 class="py-2 card-title text-center">$data[member_name]</h5>
                                </div>

                            </div>


                       

        data;
    };
};

// delete member
if (isset($_POST['delete_memeber'])) {

    $q = "SELECT * FROM `members` WHERE `sr_no`=?";
    $value = [$_POST['sr_no']];
    $res = select($q, $value, 'i');


    $imageName = mysqli_fetch_assoc($res);

    $img_res = delete_Image($imageName['member_img'], ABOUT_FOLDER);
    if ($img_res) {
        $q = "DELETE FROM `members` WHERE `member_img`=?";
        $value = [$imageName['member_img']];
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
