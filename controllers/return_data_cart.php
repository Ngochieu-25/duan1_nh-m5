<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
$result = [];
$total_cart_price = 0;
$total_quantity = 0;
$total_cart_discount_price = 0;
if(isset($_SESSION['cart'])){
    foreach ($_SESSION['cart'] as $each) {
        $total_cart_price += $each['product_price'] * $each['quantity'];
        $cart_discount_price = $each['product_price'] - ($each['product_price'] * $each['discount'] / 100);
        $total_cart_discount_price += $cart_discount_price * $each['quantity'];
    }
    
    $result['total_cart']['new_price'] = $total_cart_discount_price;
    $result['total_cart']['old_price'] = $total_cart_price;
    $result['cart'] = $_SESSION['cart'];
    echo json_encode($result);
}else {
    $result['total_cart']['new_price'] = "";
    $result['total_cart']['old_price'] = "";
    $result['cart'] = "";
    echo json_encode($result);
}

