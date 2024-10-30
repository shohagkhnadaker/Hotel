<?php


require('../inc/essentials.php');
require('../inc/db_config.php');

// Add feature
if (isset($_POST['add_feature'])) {
    $frm_data = filterdata($_POST);

    $q = "INSERT INTO `features`( `feature_name`) VALUES (?)";
    $value = [$frm_data['name']];
    $res = Insert($q, $value, "s");
    echo $res;
};



// get_features
if (isset($_POST['Get_Features'])) {

    $res = mysqli_query($con, "SELECT * FROM `features` ORDER BY `sr_no` DESC");

    $i = 1;
    while ($data = mysqli_fetch_assoc($res)) {
        echo <<<data
                

                           <tr>
                                                    <td>$i</td>
                                                    <td>$data[feature_name]</td>
                                                    <td><button onclick=del_feature($data[sr_no]) class='btn btn-sm btn-danger'>Delete</button></td>
                                          

                            </tr>
                       

        data;
        $i++;
    };
};


// delete_features
if (isset($_POST['delete_feature'])) {
    $frm_data = filterdata($_POST);

    $res = select("SELECT * FROM `room_features` WHERE feature_id=?", [$frm_data['sr_no']], 'i');
    if (mysqli_num_rows($res) == 1) {
        echo "room_aded";
    } else {

        $q = "DELETE FROM `features` WHERE `sr_no`=?";



        $value = [$frm_data['sr_no']];
        $res = delete($q, $value, 'i');
        echo $res;
    }
};

// add facilites


if (isset($_POST['add_facilitess'])) {
    $frm_data = filterdata($_POST);


    $img_resut = upload_SVG_IMG($_FILES['img'], FACILITES_FOLDER);

    if ($img_resut == "inv_img") {

        echo $img_resut;
    } elseif ($img_resut == "inv_size") {
        echo $img_resut;
    } elseif ($img_resut == "img_upd_Fail") {
        echo $img_resut;
    } else {

        $q = "INSERT INTO `facilites`(`name`, `img`, `des`) VALUES (?,?,?)";
        $value = [$frm_data['name'], $img_resut, $frm_data['des']];
        $res = Insert($q, $value, "sss");
        echo $res;
    }
};

// get facilites
if (isset($_POST['Get_facilites'])) {

    $res = mysqli_query($con, "SELECT * FROM `facilites` ORDER BY `sr_no` DESC");

    $i = 1;
    while ($data = mysqli_fetch_assoc($res)) {

        $path = FACILITES_IMAGE_PATH;
        echo <<<data
                

                           <tr class='align-items-center'>
                                                    <td>$i</td>
                                                    <td style='width:100px;height:100px' class='d-flex aling-itams-center'><img class='w-100' src='$path$data[img]'></img></td>
                                                    <td>$data[name]</td>
                                                    <td>$data[des]</td>
                                                    <td><button onclick=del_facilites($data[sr_no]) class='btn btn-sm btn-danger'>Delete</button></td>
                                          

                            </tr>
                       

        data;
        $i++;
    };
};
// delete_facilites
if (isset($_POST['delete_fecilites'])) {
    $frm_data = filterdata($_POST);

    $res = select("SELECT * FROM `room_facilites` WHERE facilites_id=?", [$frm_data['sr_no']], 'i');
    if (mysqli_num_rows($res) == 1) {
        echo "room_aded";
    } else {
        $q1 = "SELECT `img` FROM `facilites` WHERE `sr_no`=?";

        $value = [$frm_data['sr_no']];
        $res1 = select($q1, $value, 'i');


        $res3 = mysqli_fetch_assoc($res1);
        $res4 = delete_Image($res3['img'], FACILITES_FOLDER);

        if ($res4) {

            $q = "DELETE FROM `facilites` WHERE `sr_no`=?";
            $res = delete($q, $value, 'i');
            echo $res;
        } else {
            echo 0;
        }
    }
};
