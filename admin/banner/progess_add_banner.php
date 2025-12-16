<?php
require "../../global.php";
require "../..$MODEL_URL/pdo.php";
require "../../$MODEL_URL/banner.php";
$banner_name = $_POST['banner_name'];
$banner_image = $_FILES['banner_image'];
$tmp_image = $banner_image['tmp_name'];
$file_info = pathinfo($banner_image['name']);
$checkTail = ['png', 'jpg', 'webp', 'jfif', 'gif', 'jepg'];


if (in_array($file_info['extension'], $checkTail)) {
    $folder_name = "../..$ASSET_URL/images/";
    $file_name = uniqid() . $banner_image['name'];
    if (move_uploaded_file($tmp_image, $folder_name . $file_name)) {
        $folder_name = "$ASSET_URL/images/";
        $save_main_img = $folder_name . $file_name;
    };
} else {
    header("location: ../index.php?act=add_banner");
    setcookie('notification', "Không đúng định dạng ảnh", time() + 1, "/");
}

add_banner($banner_name,$save_main_img);
header("location: ../index.php?act=add_banner");
setcookie('notification', "Thêm thành công", time() + 1, "/");