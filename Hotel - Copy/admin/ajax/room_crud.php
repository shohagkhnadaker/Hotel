<?php

require('../inc/essentials.php');
require('../inc/db_config.php');




// Add room
if (isset($_POST['add_room'])) {

    $frm_data = filterdata($_POST);

    $feature = filterdata(json_decode($_POST['feature']));
    $facilities =  filterdata(json_decode($_POST['facilites']));

    $q1 = "INSERT INTO `rooms`(`room_name`, `room_area`, `room_quantity`, `room_price`, `room_adult`, `room_child`, `room_des`) VALUES (?,?,?,?,?,?,?)";
    $flag = 1;

    $value = [
        $frm_data['room_name'], $frm_data['room_area'],
        $frm_data['room_quantity'], $frm_data['room_price'], $frm_data['room_adult'], $frm_data['room_child'], $frm_data['room_des']
    ];
    $res = Insert($q1, $value, "siiiiis");

    if ($res == 0) {
        $flag = 0;
    };

    $room_id = mysqli_insert_id($con);
    $q2 = "INSERT INTO `room_facilites`(`room_id`, `facilites_id`) VALUES (?,?)";

    if ($smtp = mysqli_prepare($con, $q2)) {
        foreach ($facilities as $f) {
            mysqli_stmt_bind_param($smtp, "ii", $room_id, $f);

            mysqli_stmt_execute($smtp);
        };
        mysqli_stmt_close($smtp);
    } else {
        $flag = 0;
    }





    $q3 = "INSERT INTO `room_features`( `room_id`, `feature_id`) VALUES (?,?)";

    if ($smtp = mysqli_prepare($con, $q3)) {
        foreach ($feature as $f) {
            mysqli_stmt_bind_param($smtp, "ii", $room_id, $f);

            mysqli_stmt_execute($smtp);
        };
        mysqli_stmt_close($smtp);
    } else {
        $flag = 0;
    }


    if ($flag == 1) {
        echo 1;
    } else {
        echo 0;
    }
}

// get all rooms
if (isset($_POST['get_rooms'])) {


    $res = selectAllbyDESC('rooms');
    $i = 1;

    while ($row = mysqli_fetch_assoc($res)) {
        $status = "";
        if ($row['room_active'] == 0) {
            $status .= "<buttun onclick=change_status($row[sr_no],1)><a class='btn btn-primary'>active</a></buttun>";
        } else {
            $status .=  "<buttun onclick=change_status($row[sr_no],0)><a class='btn btn-warning'>Inactive</a></buttun>";
        }


        echo <<<data
                       <tr>
                      <th>$i</th>
                      <th>$row[room_name]</th>
                      <th>$row[room_area]</th>
                      <th>$row[room_quantity]</th>
                      <th>$row[room_price]</th>
                      <th>
                      <span class='rounded-pill text-light bg-secondary p-1'>Adult: $row[room_adult]</span></br>
                      <span class='rounded-pill text-light bg-secondary p-1'>Children: $row[room_child]</span>
                      </th>
                      <th>$status</th>

                      <th>
                      <div class=''>
                      <button type='button' data-toggle="modal" data-target="#room_edite" onclick=edit_room($row[sr_no],'$row[room_name]') class='btn btn-sm  btn-primary overflow-hidden '><i class="bi bi-pencil-square text-light"></i></button>
                       <button type='button' data-toggle="modal" data-target="#Add_img_model" onclick=room_modal_data($row[sr_no],'$row[room_name]') class='m-2 btn btn-sm btn-secondary '><i class="bi bi-card-image"></i></button>
                      
                       <button type='button'onclick='delete_room($row[sr_no])'   class='btn btn-sm btn-danger'><i class="bi bi-trash-fill text-light"></i></button>
                      </div>
                      </th>
            
                      </tr>
    
  data;

        $i++;
    }
}

// 

// Update room
if (isset($_POST['change_Status'])) {

    $frm_data = filterdata($_POST);

    $q1 = "UPDATE `rooms` SET `room_active`=?  WHERE `sr_no`=?";

    $value = [$frm_data['status_value'], $frm_data['room_id']];
    $res2 = update($q1, $value, "ii");

    echo $res2;
}



// Get edite room

if (isset($_POST['get_edite_room'])) {
    $frm_data = filterdata($_POST);

    $q = "SELECT * FROM `rooms` WHERE sr_no=?";
    $value = [$frm_data['room_id']];
    $res = select($q, $value, 'i');
    $room = mysqli_fetch_assoc($res);





    $q2 = "SELECT * FROM `room_facilites` WHERE room_id=?";
    $res2 = select($q2, $value, 'i');

    $facilities = [];

    if (mysqli_num_rows($res2) > 0) {


        while ($row = mysqli_fetch_assoc($res2)) {
            array_push($facilities, $row['facilites_id']);
        }
    }

    $q3 = "SELECT * FROM `room_features` WHERE room_id=?";
    $res3 = select($q3, $value, 'i');

    $feature = [];

    if (mysqli_num_rows($res3) > 0) {


        while ($row = mysqli_fetch_assoc($res3)) {
            array_push($feature, $row['feature_id']);
        }
    };



    $data = ["rooms" => $room, "features" => $feature, "facilites" => $facilities];
    $data = json_encode($data);
    echo $data;
}



// Update room
if (isset($_POST['upd_room'])) {

    $frm_data = filterdata($_POST);

    $feature = filterdata(json_decode($_POST['feature']));
    $facilities =  filterdata(json_decode($_POST['facilites']));

    $q1 = "UPDATE `rooms` SET `room_name`=?,`room_area`=?,`room_quantity`=?,`room_price`=?,`room_adult`=?,`room_child`=?,`room_des`=? WHERE sr_no=?";
    $flag = 1;

    $value = [
        $frm_data['room_name'], $frm_data['room_area'], $frm_data['room_quantity'], $frm_data['room_price'], $frm_data['room_adult'], $frm_data['room_child'], $frm_data['room_des'], $frm_data['room_id']
    ];
    if (update($q1, $value, "siiiiisi")) {
        $flag = 1;
    } else {
        $flag = 0;
    };



    $dete_q1 = "DELETE FROM `room_facilites` WHERE room_id=?";
    $res_d2 = delete($dete_q1, [$frm_data['room_id']], 'i');

    $dete_q2 = "DELETE FROM `room_features` WHERE room_id=?";
    $res_d2 = delete($dete_q2, [$frm_data['room_id']], 'i');

    if ($res_d2 & $res_d2) {
        $flag = 1;
    } else {
        $flag = 0;
    }


    $q2 = "INSERT INTO `room_facilites`(`room_id`, `facilites_id`) VALUES (?,?)";

    if ($smtp = mysqli_prepare($con, $q2)) {
        foreach ($facilities as $f) {
            mysqli_stmt_bind_param($smtp, "ii", $frm_data['room_id'], $f);
            $flag = 1;

            mysqli_stmt_execute($smtp);
        };
        mysqli_stmt_close($smtp);
    } else {
        $flag = 0;
    }





    $q3 = "INSERT INTO `room_features`( `room_id`, `feature_id`) VALUES (?,?)";

    if ($smtp = mysqli_prepare($con, $q3)) {
        foreach ($feature as $f) {
            mysqli_stmt_bind_param($smtp, "ii",  $frm_data['room_id'], $f);

            mysqli_stmt_execute($smtp);
        };
        $flag = 1;

        mysqli_stmt_close($smtp);
    } else {
        $flag = 0;
    }


    if ($flag == 1) {
        echo 1;
    } else {
        echo 0;
    }
}
// 

// add_room_photo
if (isset($_POST['add_room_img'])) {
    $flt_data = filterdata($_POST);

    $img_resut = upload_Img($_FILES['room_img'], ROOM_FOLDER);

    if ($img_resut == "inv_img") {
        echo $img_resut;
    } elseif ($img_resut == "size_img") {
        echo $img_resut;
    } elseif ($img_resut == "img_upd_Fail") {
        echo $img_resut;
    } else {

        $q = "INSERT INTO `room_img`(`room_id`, `room_img`) VALUES (?,?)";
        $value = [$flt_data['room_id'], $img_resut];
        $res1 = Insert($q, $value, "is");
        echo $res1;
    }
};




// get all rooms Image
if (isset($_POST['get_room_allIamge'])) {

    $frm_data = filterdata($_POST);
    $value = [$frm_data['room_id']];

    $q = "SELECT * FROM `room_img` WHERE `room_id`=? ORDER BY `sr_no` DESC";
    $res = select($q, $value, "i");

    $i = 1;


    while ($row = mysqli_fetch_assoc($res)) {
        $path = ROOM_IMG_PATH;

        $thum = "";
        if ($row['thum'] == 1) {
            $thum .= "<button class='rounded bg-secondary' type='button'><i class='bi bi-check-circle-fill text-light px-3 py-2 bg-primary border rounded shadow'></i></button>";
        } else {
            $thum = "<button class='rounded bg-secondary' type='button' onclick='remove_thum($row[sr_no],$row[room_id])'><i class='bi bi-check-circle-fill text-light px-3 py-2 bg-secondary border rounded shadow'></i></button>";
        }


        echo <<<data
                         <tr class='align-middle'>
                         <th>$i</th>
                    
                      
                          <th style="height:150px;width: 250px;" '><img class='img-fluid' src='$path$row[room_img]'></img></th>
                         <th class=''>$thum</th>


                        <th><button type='button' onclick="delete_room_photo($row[sr_no],$row[room_id])" class='btn btn-danger'><i class="bi bi-trash3-fill"></i></button></th>
                          </tr>
    
        data;
        $i++;
    }
}

// delete room single photo

if (isset($_POST['delete_room_photo'])) {

    $qury = "SELECT * FROM `room_img` WHERE `sr_no`=? and `room_id`=? and `thum`=? ";
    $value = [$_POST['sr_no'], $_POST['room_id'], 1];
    $resf = select($qury, $value, 'iii');

    if (mysqli_num_rows($resf) > 0) {
        echo "thum";
        exit;
    }


    $q = "SELECT * FROM `room_img` WHERE `sr_no`=? and `room_id`=? ";
    $value = [$_POST['sr_no'], $_POST['room_id']];
    $res = select($q, $value, 'ii');


    $imageName = mysqli_fetch_assoc($res);

    $img_res = delete_Image($imageName['room_img'], ROOM_FOLDER);
    if ($img_res) {
        $q2 = "DELETE FROM `room_img` WHERE `room_img`=?";
        $value2 = [$imageName['room_img']];
        $res2 = delete($q2, $value2, "s");
        if ($res2 == 1) {
            echo 1;
        } else {
            echo 0;
        }
    } else {
        echo 'image unlink faild';
    }
};

// Change Room thum Imge
if (isset($_POST['remove_thum'])) {

    $q = "UPDATE `room_img` SET `thum`=? WHERE `room_id`=? ";
    $value = [0, $_POST['room_id']];
    $res = update($q, $value, 'ii');


    $q2 = "UPDATE `room_img` SET `thum`=? WHERE `room_id`=? And `sr_no`=? ";
    $value2 = [1, $_POST['room_id'], $_POST['sr_no']];
    $res2 = update($q2, $value2, 'iii');
    echo $res2;
};



// Change Room thum Imge
if (isset($_POST['delete_room'])) {




    $frm_data = filterdata($_POST);


    $qury = "SELECT `room_img` FROM `room_img` WHERE `room_id`=?";

    $roomimg = select($qury, [$frm_data['room_id']], 'i');

    while ($img = mysqli_fetch_assoc($roomimg)) {
        delete_Image($img['room_img'], ROOM_FOLDER);
    }

    $q = "DELETE FROM `room_img` WHERE `room_id`=?";
    $value = [$frm_data['room_id']];
    $res = delete($q, $value, 'i');

    $q1 = "DELETE FROM `room_facilites` WHERE `room_id`=?";
    $value1 = [$frm_data['room_id']];
    $res1 = delete($q1, $value1, 'i');

    $q2 = "DELETE FROM `room_features` WHERE `room_id`=?";
    $value2 = [$frm_data['room_id']];
    $res2 = delete($q2, $value2, 'i');

    $q3 = "DELETE FROM `rooms` WHERE `sr_no`=?";
    $value3 = [$frm_data['room_id']];
    $res3 = delete($q3, $value3, 'i');
    echo 1;
};
