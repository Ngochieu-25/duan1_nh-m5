<?php
$product_id = $_POST['productId'];
$colorNameId = $_POST['colorNameId'];
$sizeId = $_POST['sizeId'];
$quantity = (int)$_POST['quantity'];
$color_name_result = select_one_color_name_by_color_name_id($colorNameId);
$color_type_result = select_one_color_type_by_id($color_name_result['color_type_id']);
$size_result = select_one_size_by_size_id($sizeId);
$result_array = [
    'color_name' => $color_name_result['color_name'],
    'color_image' => $color_name_result['color_image'],
    'color_name_id' => $color_name_result['color_name_id'],
    'color_type_name' => $color_type_result['color_type_name'],
    'color_type_id' => $color_type_result['color_type_id'],
    'size_id' => $size_result['size_id'],
    'size_name' => $size_result['size_name'],
    'quantity' => $quantity,
];
echo json_encode($result_array);





