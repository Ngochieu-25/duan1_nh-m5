<?php
if(isset($_POST['productId'])){
    $size_id = $_POST['sizeId'];
    $product_id = $_POST['productId'];
    $color_name_id = $_POST['colorNameId'];
    $product_quantity = select_quantity_by_size($size_id,$color_name_id,$product_id);
    $size_name = select_size_by_id($product_quantity['size_id']);
    $array = [
        [
            'quantity' => $product_quantity['quantity']
        ],
    ];
    echo $product_quantity['quantity'];
}
