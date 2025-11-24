<?php
require "../../global.php";
require "../..$MODEL_URL/pdo.php";
require "../../$MODEL_URL/banner.php";
$banner_id = $_POST['banner_id'];
$banner_name = $_POST['banner_name'];
$banner_image = $_FILES['banner_main_image'];
$banner_old_main_img = $_POST['old_main_image'];
$tmp_image = $banner_image['tmp_name'];
$file_info = pathinfo($banner_image['name']);
$checkTail = ['png', 'jpg', 'webp', 'jfif', 'gif', 'jepg'];

$save_main_img = "";

if ($banner_image['size'] > 0) {
    if (in_array($file_info['extension'], $checkTail)) {
        $folder_name = "../..$ASSET_URL/images/";
        $file_name = uniqid() . $banner_image['name'];
        if (move_uploaded_file($tmp_image, $folder_name . $file_name)) {
            $folder_name = "$ASSET_URL/images/";
            $save_main_img = $folder_name . $file_name;
        };
    } else {
        header("location: ../index.php?act=update_banner");
        setcookie('notification', "Không đúng định dạng ảnh", time() + 1, "/");
    }
} else {
    $save_main_img = $banner_old_main_img;
}
banner_update($banner_name,$save_main_img,$banner_id);
header("location: ../index.php?act=update_banner&banner_id=" . $banner_id);
setcookie('notification', "Cập nhật thành công", time() + 1, "/");