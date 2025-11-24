<?php
if (isset($_POST['type'])) {
    $type = $_POST['type'];
    $product_id = !empty($_POST['productId']) ? $_POST['productId'] : null;
    $sizeId = !empty($_POST['sizeId']) ? $_POST['sizeId'] : null;
    $colorNameId = !empty($_POST['colorNameId']) ? $_POST['colorNameId'] : null;
    $remainingAmount = $_POST['remainingAmount'];
    $remainingAmount = (int)$remainingAmount;
    $currentQuantity = $_POST['currentQuantity'];
    $currentQuantity = (int) $currentQuantity;
    $result = [];
    $total_cart_price = 0;
    $total_quantity = 0;
    $total_cart_discount_price = 0;

    $variantKey = "i" . $product_id . "c" . $colorNameId . "z" . $sizeId;

    if ($type == 'increase') {
        if ($currentQuantity < $remainingAmount) {
            $currentQuantity++;
            if (isset($variantKey)) {
                $_SESSION['cart'][$variantKey]['quantity']++;
            }
        }
    } else {
        if ($currentQuantity > 1) {
            $currentQuantity--;
            if (isset($variantKey)) {
                $_SESSION['cart'][$variantKey]['quantity']--;
            }
        }
    }
    foreach ($_SESSION['cart'] as $each) {
        $total_cart_price += $each['product_price'] * $each['quantity'];
        $cart_discount_price = $each['product_price'] - ($each['product_price'] * $each['discount'] / 100);
        $total_cart_discount_price += $cart_discount_price * $each['quantity'];
        $total_quantity += $each['quantity'];
    }

    $result['new_price'] = $total_cart_discount_price;
    $result['old_price'] = $total_cart_price;
    $result['currentQuantity'] = $currentQuantity;
    $result['total_quantity'] = $total_quantity;
    echo json_encode($result);
}
