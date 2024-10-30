<?php

//for font-end

define("Show_Imgae_path", "http://127.0.0.1/Hotel/img/");

define("Abot_image_path", Show_Imgae_path . "about/");
define("CARUSEL_IMAGE_PATH", Show_Imgae_path . "carosel/");
define("FACILITES_IMAGE_PATH", Show_Imgae_path . "facilites/");
define("ROOM_IMG_PATH", Show_Imgae_path . "Room/");



//for backecd
define("UPLOAD_IMAGE_PATH", $_SERVER['DOCUMENT_ROOT'] . '/Hotel/img/');
define("ABOUT_FOLDER", 'about/');
define("CAROSEL_FOLDER", 'carosel/');
define("FACILITES_FOLDER", 'facilites/');
define("ROOM_FOLDER", 'Room/');
define("USER_FOODER", 'Users/');


function adminLogin()
{
  session_start();
  if (!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
    echo "<script>window.location.href='index.php';</script>";
  };
  session_regenerate_id(true);
}


function alerts($typee, $msg)
{
  $bts_cls = ($typee == 'success') ? 'alert-success' : 'alert-danger';

  echo <<<alert


<div class="alert $bts_cls alert-dismissible fade show aler_css" role="alert">
  <strong>$msg</strong> 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>



alert;
}


function redirect($url)
{
  echo "<script>window.location.href='$url';</script>";
}


// Upload Image

function upload_Img($Image, $Folder)
{

  $mime_types = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
  $img_mime = $Image['type'];

  if (!in_array($img_mime, $mime_types)) {
    return "inv_img"; //invalid image type
    exit;
  } else if ($Image['size'] / (1024 * 124) > 2) {
    return "size_img"; //invalid image size
  } else {
    $ext = pathinfo($Image['name'], PATHINFO_EXTENSION);
    $img_NAme = "IMG" . random_int(111111111, 999999999) . ".$ext";

    $img_path = UPLOAD_IMAGE_PATH . $Folder . $img_NAme;
    if (move_uploaded_file($Image['tmp_name'], $img_path)) {
      return $img_NAme;
    } else {
      return 'img_upd_Fail';
    }
  }
}

// delete img

function delete_Image($Image, $Folder)
{

  if (unlink(UPLOAD_IMAGE_PATH . $Folder . $Image)) {
    return true;
  } else {
    return false;
  }
}



// Upload Image

function upload_SVG_IMG($Image, $Folder)
{

  $mime_types = ['image/svg+xml'];
  $img_mime = $Image['type'];

  if (!in_array($img_mime, $mime_types)) {
    return "inv_img"; //invalid image type
    exit;
  } else if ($Image['size'] / (1024 * 124) > 1) {
    return "size_img"; //invalid image size
  } else {
    $ext = pathinfo($Image['name'], PATHINFO_EXTENSION);
    $img_NAme = "IMG" . random_int(111111111, 999999999) . ".$ext";

    $img_path = UPLOAD_IMAGE_PATH . $Folder . $img_NAme;
    if (move_uploaded_file($Image['tmp_name'], $img_path)) {
      return $img_NAme;
    } else {
      return 'img_upd_Fail';
    }
  }
}



// upload User img
function Upload_USER_IMG($Image)
{

  $mime_types = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
  $img_mime = $Image['type'];

  if (!in_array($img_mime, $mime_types)) {
    return "inv_img"; //invalid image type
    exit;
  } else {
    $ext = pathinfo($Image['name'], PATHINFO_EXTENSION);
    $img_NAme = "IMG" . random_int(111111111, 999999999) . ".jpeg";

    $img_path = UPLOAD_IMAGE_PATH . USER_FOODER  . $img_NAme;

    if ($ext == 'png' || 'PNG') {
      $img = imagecreatefrompng($Image['tmp_name']);
    } else if ($ext == 'webp' || "WEBP") {
      $img = imagecreatefromwebp($Image['tmp_name']);
    } else {
      $img = imagecreatefromjpeg($Image['tmp_name']);
    }
    if (imagejpeg($img, $img_path, 75)) {
      return $img_NAme;
    } else {
      return 'img_upd_Fail';
    }
  }
}
