<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <?php require('inc/link.php');
    require('inc/db_config.php');
    require('inc/essentials.php');

    session_start();
    if ((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
        redirect('dashbord.php');
    }



    ?>

    <style>
        div.login-from {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;

        }

        .bg-gold {
            background-color: gold;
        }

        .login-from :hover {
            border-color: gold !important;
        }

        .login-from :hover .bg-gold {
            border-color: black !important;

        }

        ;
    </style>

    <title>admin login panel</title>
</head>

<body class="bg-light">




    <div class="login-from shadow rounded border border-4 pt-0 p-3">
        <form method="post">
            <div>
                <h3 class="bg-gold p-2 text-center border-top rounded h-font border-3">Admin panel </h3>
                <div class="form-group mb-3">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="admin_name" class="form-control" id="admin-name" aria-describedby="emailHelp" placeholder="admin name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="admin_password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                </div>
                <button type="submit" name="admin_login" class="btn btn-primary m-auto">Login</button>


            </div>
        </form>

    </div>




    <?php

    if (isset($_POST['admin_login'])) {

        $frm_data = filterdata($_POST);

        $quer = "SELECT * FROM `admin` WHERE `admin_name`=? AND `admin_password`=?";
        $values = [$frm_data['admin_name'], $frm_data['admin_password']];


        $res = select($quer, $values, 'ss');
        if ($res->num_rows == 1) {

            $row = mysqli_fetch_assoc($res);

            $_SESSION['adminLogin'] = true;
            $_SESSION['admimnId'] = $row['sr_no'];
            redirect('dashbord.php');
        } else {
            alerts('error', 'Invalid Credentials...!');
        }
    };

    ?>



    <?php
    require('inc/scripts.php')
    ?>
</body>

</html>