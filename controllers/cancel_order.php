<?php
if (isset($_POST['orderId'])) {
    $status_id = $_POST['statusId'];
    $order_id = $_POST['orderId'];
    orders_update($status_id,$order_id);
    echo 0; 
}
