<?php
require "../../global.php";
require "../../model/pdo.php";
require "../../model/product.php";

$product_id = $_GET['product_id'];

if (isset($product_id)) {

    $color_id_result = handle_delete_color($product_id);
    handle_delete_size($product_id);
    delete_quantities($product_id);
    // $images_id = handle_delete_images($product_id);
    foreach ($color_id_result as $key => $color_name_id) {
        // echo $color_name_id . " ";
        $color_name = select_color_name_by_id($color_name_id);
        unlink("../../" . $color_name['color_image']);

        delete_color($color_name_id);
    }
    product_delete($product_id);
    $images_result = select_images_by_id($product_id);
    foreach ($images_result as $key => $image) {
        $file_name = '../..' . $ROOT_URL . $image['image_url'];
        if (file_exists($file_name)) {
            unlink('../..' . $ROOT_URL . $image['image_url']);
        }
    }
    delete_images_by_product_id($product_id);
    header("location: ../index.php?act=view_product");
    setcookie('notification', "Xóa thành công", time() + 1, "/");

    //     for ($i = 0; $i < count($images_id); $i++) {
    //         $select_image_url = select_image_url($images_id[$i]);
    //         $file_name = '../..' . $select_image_url['image_url'];
    //         if(file_exists($file_name)){
    //             unlink('../..' . $select_image_url['image_url']);
    //         }
    //         delete_images($images_id[$i]);
    //     }
    //     // delete_size($size_id);
    //     $product_result = select_product_by_id($product_id);
    //     if('../..' . $product_result['main_image_url']){
    //         unlink('../..' . $product_result['main_image_url']);
    //     }
    //     if('../..' . $product_result['hover_main_image_url']){
    //         unlink('../..' . $product_result['hover_main_image_url']);
    //     }
    //     product_delete($product_id);

    //     header("location: ../index.php?act=view_product");
    //     setcookie('notification', "Xóa thành công", time() + 1, "/");
    // } else {
    //     // header("location: ../index.php?act=view_product");
    //     setcookie('notification', "Xóa Thất bại", time() + 1, "/");
} else {
    header("location: ../index.php?act=view_product");
    setcookie('notification', "Không có product id nào hợp lệ", time() + 1, "/");
}
exit();