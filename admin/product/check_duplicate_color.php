<?php
if (isset($_POST['colorName'])) {
    $color_name = $_POST['colorName'];
    $color_name_reuslt = select_all_color_name_by_name($color_name);
    $array = [];
    $now = date("Y-m-d H:i:s");
    foreach ($color_name_reuslt as $key => $value) {
        $product_result = select_product_by_color_name_id($value['color_name_id']);
        //    if($product_result != ""){
        $array[$key]['product_name'] = $product_result['product_name'] == null ? "Chưa được liên kết " . $now: $product_result['product_name'];
        $array[$key]['color_name_id'] = $value['color_name_id'];
        $array[$key]['color_name'] = $value['color_name'];
        //    }
    }
    echo json_encode($array);
}