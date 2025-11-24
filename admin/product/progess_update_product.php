<?php
require "../../global.php";
require "../..$MODEL_URL/pdo.php";
require "../..$MODEL_URL/product.php";

$firtsRecord = 0;
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_discount = $_POST['product_discount'];
$product_desc = $_POST['product_desc'];
$product_cat_id = $_POST['product_cat_id'];
$product_image = $_FILES['product_main_image'];
$product_code = $_POST['product_code'];
$product_second_image = $_FILES['product_hover_main_image'];
$product_old_main_img = $_POST['old_main_image'];
$product_old_second_image = $_POST['old_second_image'];
$tmp_image = $product_image['tmp_name'];
$tmp_second_image = $product_second_image['tmp_name'];

$save_main_img = "";
$save_second_img = "";

// check main image
if ($product_image['size'] > 0) {
    $save_main_img = add_image($product_image, $tmp_image, $ASSET_URL);
    if (!$save_main_img) {
        header("location: ../index.php?act=update_product");
        setcookie('notification', "Không đúng định dạng ảnh", time() + 1, "/");
    }
} else {
    $save_main_img = $product_old_main_img;
}
// check second image
if ($product_second_image['size'] > 0) {
    $save_second_img = add_image($product_second_image, $tmp_second_image, $ASSET_URL);
    if (!$save_second_img) {
        header("location: ../index.php?act=update_product");
        setcookie('notification', "Không đúng định dạng ảnh", time() + 1, "/");
    }
} else {
    $save_second_img = $product_old_second_image;
}
product_update($product_name, $product_price, $save_main_img, $save_second_img, $product_discount, $product_code, $product_desc, $product_cat_id, $product_id);

// if ($product_color_image['size'] > 0) {
//     $save_color_img = add_image($product_color_image, $product_color_image['tmp_name'], $ASSET_URL);
// } else {
//     $save_color_img = $old_color_image;
// }
// update_product_color($product_color_type,$product_id);
// $color_id_result = select_product_color_by_product_id($product_id);
// update_color_name($product_color_name, $save_color_img, $color_id_result['color_name_id']);
// if ($product_detail_image['size'][$firtsRecord] > 0) {
//     $detail_image = restructureFilesArray($product_detail_image);
//     $image_result = select_images_by_id($product_id);
//     $detail_image_length = count($detail_image);
//     echo $detail_image_length;
//     // die();
//     foreach ($image_result as $key => $value) {
//         echo $value['image_url'] . "<br>";
//         $file_name = '../..' . $value['image_url'];
//         if(file_exists($file_name)){
//             unlink('../..' . $value['image_url']);
//         }
//     }
//     for ($i = 0; $i < $detail_image_length; $i++) {
//         $save_detail_img = add_image($detail_image[$i], $detail_image[$i]['tmp_name'], $ASSET_URL);
//         $detail_image_id = update_detail_image($save_detail_img, $image_result[$i]['image_id']);
//         // getProductImages($product_id, $detail_image_id, $color_id);
//     }
// } else {
//     $image_result = select_images_by_id($product_id);
//     foreach ($old_detail_image as $key => $value) {
//         update_images($value, $image_result[$key]['image_id']);
//     }
// }
// update_size($product_size, $product_id);
header("location: ../index.php?act=update_product&product_id=" . $product_id);
setcookie('notification', "Cập nhật thành công", time() + 1, "/");