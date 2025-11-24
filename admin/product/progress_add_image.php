<?php
require "../../global.php";
require "../..$MODEL_URL/pdo.php";
require "../..$MODEL_URL/product.php";
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $color_name_id = $_POST['color_name'];
    $product_detail_img = $_FILES['product_image'];
    $image_after_sorting = restructureFilesArray($product_detail_img);
    // dd($image_after_sorting);
    // echo $color_name_id;
    foreach ($image_after_sorting as $key => $image) {
        $save_img = add_image($image, $image['tmp_name'], $ASSET_URL);
        if ($save_img != "") {
            add_images_product($save_img, $color_name_id, $product_id);
        } else {
            header("location: ../index.php?act=add_image");
            setcookie('notification', "Không đúng định dạng ảnh", time() + 1, "/");
        }
    }
    header("location: ../index.php?act=add_image&product_id=$product_id");
    setcookie('notification', "Thêm ảnh thành công", time() + 1, "/");
}
