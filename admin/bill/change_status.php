<?php
if(isset($_POST['orderId'])){
    $order_id = $_POST['orderId'];
    $status_id = $_POST['orderStatus'];
    orders_update($status_id,$order_id);
    $status_result = select_status_by_id($status_id);
    if($status_result['status_id'] == 4){
        $time = date('Y-m-d H:i:s');
        $order_product_result = select_all_order_product_by_id($order_id);
        foreach ($order_product_result as $key => $value) {
            add_purchased_orders(
                $value['customer_id'],
                $value['product_id'],
                $value['size_id'],
                $value['color_name_id'],
                $value['quantity'],
                $time,
                $value['completed_at'],
                $value['receiver_email'],
                $value['receiver_number_phone'],
                $value['total_price']
            );
        }
    }
    echo json_encode($status_result);
}