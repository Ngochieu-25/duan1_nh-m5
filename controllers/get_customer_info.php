<?php
$customer_id = $_POST['customerId'];
if(!empty($customer_id)){
    $customer_result = loadone_taikhoan($customer_id);
}
echo json_encode($customer_result);