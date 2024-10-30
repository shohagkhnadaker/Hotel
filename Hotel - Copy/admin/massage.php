<?php

require('inc/essentials.php');
require('inc/db_config.php');


adminLogin();






if (isset($_GET['seen'])) {


    $q = "UPDATE `massage` SET `seen`=? WHERE `sr_no`=?";
    $value = [1, $_GET['seen']];
    $res = update($q, $value, "ii");
    if ($res == 1) {
        alerts("success", "marked as seen");
    } else {
        alerts("error", "somthing worng...server down");
    }
}




if (isset($_GET['delete'])) {


    $q = "DELETE FROM `massage` WHERE `sr_no`=?";
    $value = [$_GET['delete']];
    $res = update($q, $value, "i");
    if ($res == 1) {
        alerts("success", "delete successfully");
    } else {
        alerts("error", "somthing worng...server down");
    }
}


if (isset($_GET['mark_all'])) {



    $sql = "UPDATE `massage` SET `seen`=1";

    if ($con->query($sql) === TRUE) {
        alerts("success", "All marked as seen successfully");
    } else {
        alerts("error", "somthing worng...server down");
    };
}



if (isset($_GET['delete_all'])) {



    $sql = "DELETE FROM massage";

    if ($con->query($sql) === TRUE) {
        alerts("success", "delete successfully");
    } else {
        alerts("error", "somthing worng...server down");
    };
}


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
                <div class="d-flex justify-content-between"></div>
                <div>
                    <h4 class="text-center">Massages</h4>

                </div>
                <div class="d-flex justify-content-end m-3">

                    <button class="btn btn-sm btn-primary mx-4"><a class="text-decoration-none text-white" href="?mark_all">Mark as read</a></button>
                    <button class="btn btn-sm btn-danger"><a class="text-decoration-none text-white" href="?delete_all">Delete All</a></button>
                </div>

                <!-- genarel  setting-->
                <div class="card shadow-sm">
                    <div class="card-body">


                        <div class="table-resposive-md " style="height: 300px; overflow-y:scroll;">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">subject</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Massage</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="">




                                    <?php
                                    $i = 1;


                                    $q = "SELECT * FROM `massage` ORDER BY  `sr_no` DESC";

                                    $res = mysqli_query($con, $q);

                                    while ($row = mysqli_fetch_assoc($res)) {

                                        $seen = '';

                                        if ($row['seen'] != 1) {
                                            $seen = "<a class='m-1 btn btn-sm btn-primary rounded-pill' href='?seen=$row[sr_no]'>mark as seen</a>";
                                        }
                                        $seen .= "<a class='btn btn-danger btn-sm rounded-pill' href='?delete=$row[sr_no]'>Delete</a>";

                                        $date = new DateTime($row["date"]);
                                        $formattedDate = $date->format('F j, Y');

                                        echo <<<data

                                                    <tr>
                                                    <td>$i</td>
                                                    <td>$row[name]</td>
                                                    <td>$row[email]</td>
                                                    <td>$row[subject]</td>
                                                    <td>$formattedDate</td>
                                                    <td style="width:400px;">$row[msg]</td>
                                                      <td >$seen</td>


                                                        </tr>



data;
                                        $i++;
                                    }

                                    ?>



                                </tbody>
                            </table>
                        </div>



                    </div>
                </div>



            </div>



        </div>


    </div>






    <?php


    ?>




</body>

</html>