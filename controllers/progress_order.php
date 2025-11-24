<?php
$customerId = $_POST['customerId'];
$customerfirstAndLastName = $_POST['customerfirstAndLastName'];
$customerAddress = $_POST['customerAddress'];
$customerNumberPhone = $_POST['customerNumberPhone'];
$customerEmail = $_POST['customerEmail'];
$customerNote = $_POST['customerNote'];
$pay_methods = $_POST['pay_methods'];
$order_pending = 1;
$total_cart_discount_price = 0;
$user = get_user_by_id($customerId);

if($user && $user['isActive'] == 0){
    echo json_encode('block');
}else{
    foreach ($_SESSION['cart'] as $each) {
        $price = $each['product_price'];
        $cart_discount_price = $price - ($price * $each['discount'] / 100);
        $total_cart_discount_price += $cart_discount_price * $each['quantity'];
    }
    if (empty($customerId)) {
        $customerId = null;
    }
    $delivery_charges = $customerId == null ? 10000 : 0;
    // if (count_email_and_phone_number($customerEmail, $customerNumberPhone) < 1) {
    add_order($customerId, $customerfirstAndLastName, $customerAddress, $customerNumberPhone, $customerEmail, $customerNote, $order_pending, $pay_methods, $total_cart_discount_price, $delivery_charges);
    // }
    $max_order_id_result = 0;
    
    if (empty($customerId)) {
        $max_order_id_result = select_max_order();
    } else {
        $max_order_id_result = select_max_order_id($customerId);
    }
    
    foreach ($_SESSION['cart'] as $each) {
        add_order_product($max_order_id_result, $each['product_id'], $each['sizeId'], $each['colorNameId'], $each['quantity']);
        quantity_decrease($each['quantity'], $each['product_id'], $each['colorNameId'], $each['sizeId']);
    }
    if ($customerId == null) {
        $order_result = select_all_order_product_by_id($max_order_id_result);
        $_SESSION['anonymous_customer']['receiver_email'] = $customerEmail;
        $_SESSION['anonymous_customer']['receiver_number_phone'] = $customerNumberPhone;
    }
    unset($_SESSION['cart']);
    unset($_SESSION['count_cart']);
    if ($pay_methods == "3") {
        echo json_encode($total_cart_discount_price);
    } else {
        echo json_encode("nothing");
    }
}
