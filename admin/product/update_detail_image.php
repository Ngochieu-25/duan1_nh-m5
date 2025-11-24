<?php
require "../../global.php";
require "../..$MODEL_URL/pdo.php";
require "../..$MODEL_URL/product.php";
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $color_name_id = $_POST['update_color_name'];
    $image_result = select_all_image_by_id($product_id);
    $old_image_length = count($image_result);

    $image_update = restructureFilesArray($_FILES['product_detail_image']);
    $new_image_length = count($image_update);

    for ($i = 0; $i < $old_image_length; $i++) {
        unlink('../..' . $image_result[$i]['image_url']);
        delete_images($image_result[$i]['image_id']);
    }
    for ($i = 0; $i < $new_image_length; $i++) {
        $save_img = add_image($image_update[$i], $image_update[$i]['tmp_name'], $ASSET_URL);
        add_images_product($save_img, $color_name_id, $product_id);
    }

    header("location: ../index.php?act=detail_image&product_id=$product_id");
    setcookie('notification', "Thêm ảnh thành công", time() + 1, "/");
}
