<?php

require('../admin/inc/essentials.php');
require('../admin/inc/db_config.php');








if (isset($_POST['register'])) {

    $frmdata = filterdata($_POST);

    if ($frmdata['pass'] !== $frmdata['cpass']) {
        echo 'dismatch_pass';
        exit;
    }


    $res = select("SELECT * FROM `users` WHERE `number`= ? And `email`= ? LIMIT 1", [$frmdata['number'], $frmdata['email']], 'is');
    if (mysqli_num_rows($res) > 0) {
        $exist_user = mysqli_fetch_assoc($res);
        echo ($exist_user['email'] == $frmdata ? 'email_exiSt' : 'number_exis');
        exit;
    }
    $imgres = Upload_USER_IMG($_FILES['img']);
    if ($imgres == 'inv_img') {
        echo $imgres;
    } elseif ($imgres == 'img_upd_Fail') {
        echo $imgres;
    } else {
        echo 'done';
    }
}
