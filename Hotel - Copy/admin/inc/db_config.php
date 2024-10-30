<?php
$localhost = 'localhost';
$user_name = 'root';
$pass = '';
$db = 'hotel';

$con = mysqli_connect($localhost, $user_name, $pass, $db);

if (!$con) {
    die('can`t connect to database');
};




function filterdata($data)
{

    foreach ($data as $key => $value) {

        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        $value = strip_tags($value);
        $data[$key] = $value;
    }

    return $data;
}



function select($qury, $values, $data_types)
{
    $con = $GLOBALS['con'];

    if ($stmt = mysqli_prepare($con, $qury)) {
        mysqli_stmt_bind_param($stmt, $data_types, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);

            return $res;
        } else {
            mysqli_stmt_close($stmt);

            die('Qury cant executed ....select');
        }
    } else {

        die('Qury cant prepare ....select');
    }
}





function update($qury, $values, $data_types)
{
    $con = $GLOBALS['con'];

    if ($stmts = mysqli_prepare($con, $qury)) {
        mysqli_stmt_bind_param($stmts, $data_types, ...$values);
        if (mysqli_stmt_execute($stmts)) {
            $res = mysqli_stmt_affected_rows($stmts);
            mysqli_stmt_close($stmts);
            return $res;
        } else {
            mysqli_stmt_close($stmts);

            die('Qury cant executed ....Update');
        }
    } else {

        die('Qury cant prepare ....Update');
    }
}
function delete($qury, $values, $data_types)
{
    $con = $GLOBALS['con'];

    if ($stmts = mysqli_prepare($con, $qury)) {
        mysqli_stmt_bind_param($stmts, $data_types, ...$values);
        if (mysqli_stmt_execute($stmts)) {
            $res = mysqli_stmt_affected_rows($stmts);
            mysqli_stmt_close($stmts);
            return $res;
        } else {
            mysqli_stmt_close($stmts);

            die('Qury cant executed ....Update');
        }
    } else {

        die('Qury cant prepare ....Update');
    }
}

function Insert($qury, $values, $data_types)
{
    $con = $GLOBALS['con'];

    if ($stmts = mysqli_prepare($con, $qury)) {
        mysqli_stmt_bind_param($stmts, $data_types, ...$values);
        if (mysqli_stmt_execute($stmts)) {
            $res1 = mysqli_stmt_affected_rows($stmts);
            return $res1;
            mysqli_stmt_close($stmts);
        } else {
            mysqli_stmt_close($stmts);

            die('Qury cant executed ....Insert..!');
        }
    } else {

        die('Qury cant prepare ....Insert..!');
    }
}


function selectAll($table)
{
    $con = $GLOBALS['con'];

    $res = mysqli_query($con, "SELECT * FROM $table");
    return $res;
}


function selectAllbyDESC($table)
{
    $con = $GLOBALS['con'];

    $res = mysqli_query($con, "SELECT * FROM $table ORDER BY 'sr_no' DESC");
    return $res;
}
