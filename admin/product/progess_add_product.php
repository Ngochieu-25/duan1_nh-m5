<?php
require "../../global.php";
require "../..$MODEL_URL/pdo.php";
require "../..$MODEL_URL/product.php";

define("COLORNAMEIDINDEX", 0);
define("SIZEIDINDEX", 2);
define("QUANTITYINDEX", 4);

$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_discount = $_POST['product_discount'];
$product_desc = $_POST['product_desc'];
$product_gender = $_POST['product_gender'];
$product_cat_id = $_POST['product_cat_id'];
$product_image = $_FILES['product_main_image'];
$product_second_image = $_FILES['product_hover_main_image'];
$tmp_image = $product_image['tmp_name'];
$tmp_second_image = $product_second_image['tmp_name'];
$product_code = $_POST['product_code'];
$size_and_color_info = json_decode($_POST['colorAndSizeInfo']);

if (check_product_exist($product_code) >= 1) {
    $product_id_result = select_product_by_product_code($product_code);
    $product_id = $product_id_result['product_id'];
    foreach ($size_and_color_info as $key => $value) {
        $color_name_id = $value[COLORNAMEIDINDEX];
        $size_id = $value[SIZEIDINDEX];
        $quantity = $value[QUANTITYINDEX];
        if (check_product_color_exist($color_name_id,$product_id) < 1) {
            add_product_color($product_id, $color_name_id);
        }
        if (check_product_size_exist($size_id,$product_id) < 1) {
            add_product_size($product_id, $size_id);
        }
        if (check_product_quantites_exist($product_id, $color_name_id, $size_id) >= 1) {
            quantity_update($quantity, $product_id, $color_name_id, $size_id);
        } else {
            add_quantities($product_id, $color_name_id, $size_id, $quantity);
        }
    }
} else {
    $save_main_img = add_image($product_image, $tmp_image, $ASSET_URL);
    $save_second_img = add_image($product_second_image, $tmp_second_image, $ASSET_URL);

    if (!$save_main_img) {
        header("location: ../index.php?act=update_product");
        setcookie('notification', "Không đúng định dạng ảnh", time() + 1, "/");
    }
    if (!$save_second_img) {
        header("location: ../index.php?act=update_product");
        setcookie('notification', "Không đúng định dạng ảnh", time() + 1, "/");
    }
    $product_id_result = add_product($product_name, $product_price, $save_main_img, $save_second_img, $product_discount, $product_gender, $product_code, $product_desc, $product_cat_id);
    foreach ($size_and_color_info as $key => $value) {
        $color_name_id = $value[COLORNAMEIDINDEX];
        $size_id = $value[SIZEIDINDEX];
        $quantity = $value[QUANTITYINDEX];

        if (check_product_color_exist($color_name_id,$product_id_result) < 1) {
            add_product_color($product_id_result, $color_name_id);
        }
        if (check_product_size_exist($size_id,$product_id_result) < 1) {
            add_product_size($product_id_result, $size_id);
        }
        add_quantities($product_id_result, $color_name_id, $size_id, $quantity);
        // echo " --- " . $value[0] . " - " . $value[1] . " --- ";
    }
}
header("location: ../index.php?act=add_product");
setcookie('notification', "Thêm thành công", time() + 1, "/");
