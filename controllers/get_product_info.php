<?php
if (isset($_POST['productId'])) {
    $product_id = $_POST['productId'];
    $color_name_id = $_POST['colorNameId'];
    $color_name_result = select_color_name_by_id($color_name_id);
    $image_result = select_image_by_color_name_id_and_product_id($color_name_id, $product_id);
    $size_result = select_all_size_by_product_id_and_color_name_id($color_name_id, $product_id);
    $result_array = [];
    $firstElement = 0;
    $secondElement = 1;
    $thirdElement = 2;
    $fourthElement = 3;
    $count = 0;
    $coutSizeName = 0;
    foreach ($image_result as $key => $image) {
        $result_array[$firstElement][$key] = $image['image_url'];
    }
    foreach ($size_result as $key => $size) {
        $result_array[$thirdElement][$count]['quantity_id'] = $size['quantity_id'];
        $result_array[$thirdElement][$count]['product_id'] = $size['product_id'];
        $result_array[$thirdElement][$count]['color_name_id'] = $size['color_name_id'];
        $result_array[$thirdElement][$count]['size_id'] = $size['size_id'];
        $result_array[$thirdElement][$count]['quantity'] = $size['quantity'];
        $count++;
        $size_name = select_size_by_id($size['size_id']);
        $result_array[$fourthElement][$coutSizeName]['size_name'] = $size_name['size_name'];
        $coutSizeName++;
    }
    $result_array[$secondElement][$firstElement] = $color_name_result['color_name'];

    echo json_encode($result_array);
}
