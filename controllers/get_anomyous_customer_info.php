<?php
if(isset($_POST['receiver_email'])){
  $email =  $_POST['receiver_email'];
  $number_phone = $_POST['receiver_number_phone'];
  if(count_email_and_phone_number($email,$number_phone) >= 1){
    $result = select_email_and_number_phone($email,$number_phone);
    $_SESSION['anonymous_customer']['receiver_email'] = $result['receiver_email'];
    $_SESSION['anonymous_customer']['receiver_number_phone'] = $result['receiver_number_phone'];
    header("location: /du_an1/order_details_infomation");
  }else{
    header("location: /du_an1/order_details_infomation");
    setcookie('notification', "Không tìm thấy đơn hàng", time() + 1, "/");

  }
}