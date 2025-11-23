<?php
session_start();
ob_start();
// test commit
require "./global.php";
require ".$MODEL_URL/pdo.php";
require ".$MODEL_URL/product.php";
require ".$MODEL_URL/banner.php";
require ".$MODEL_URL/taikhoan.php";
require ".$MODEL_URL/category.php";
require ".$MODEL_URL/comment.php";
require ".$MODEL_URL/timkiemsp.php";
require ".$MODEL_URL/orders.php";
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
// echo $action;
switch ($action) {
  case 'test': 
    require ".$VIEW_URL/test.php";
    break;
  case 'index';
  // echo $action;
    require ".$VIEW_URL/main.php";
    break;
  case 'orders_history': 
    require ".$VIEW_URL/orders_history.php";
  break;
    // ----------San Pham---------------
  case 'male-fashion':
    require ".$VIEW_URL/male-fashion.php";
    break;
  case 'product_detail':
    require ".$VIEW_URL/product_detail.php";
    break;
  case 'female-fashion':
    require ".$VIEW_URL/female-fashion.php";
    break;
  case 'news-fashion':
    require ".$VIEW_URL/news-fashion.php";
    break;
   case 'sale-fashion':
    require ".$VIEW_URL/sale-fashion.php";
    break;
  // Bổ sung product DETAIL và chức năng add vào cart
  case "order_purchased": 
    require ".$VIEW_URL/orders.php";
    break;
  case 'check-quanity':
    require ".$CONTROLLER_URL/check_product_quantity.php";
    break;
  case 'add_to_cart':
    require ".$CONTROLLER_URL/add_to_cart.php";
    break;
   case 'product_add_quantity_to_cart':
    require ".$CONTROLLER_URL/product_add_quantity_to_cart.php";
    break;
  case 'get_product_info':
    require ".$CONTROLLER_URL/get_product_info.php";
    break;
  // ------------- Bình Luận --------------
   case 'delete_bl':
    require ".$CONTROLLER_URL/delete_bl.php";
    break;
  case 'update_bl':
    require ".$CONTROLLER_URL/update_bl.php";
    break;

    // ------------Tài Khoản---------------
    case 'login':
    if (isset($_POST['login'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];

      $checkuser = checkuser($username, $password);
      if (is_array($checkuser)) {
        $_SESSION['username'] = $checkuser;

        echo '<script>alert("Đăng nhập thành công")</script>';
      } else {
        echo '<script>alert("Tài khoản hoặc mật khẩu không tồn tại")</script>';
      }
    }

    require ".$VIEW_URL/main.php";
    break;
  case 'quenmk':
    if (isset($_POST['btnsubmit'])) {
      $email  = $_POST['email'];
      $checkemail = checkemail($email);
      if (is_array($checkemail)) {
        echo "<script>
          alert('Mật khẩu của bạn là:"
          . $checkemail['password'] .
          "');
          </script>";
      } else {
        echo '<script>alert("Email không khớp với email đã đăng ký!")</script>';
      }
    }

    require ".$VIEW_URL/main.php";
    break;
  case 'myaccount':
    if (isset($_POST['thaydoi']) && ($_POST['thaydoi'])) {
      $id = $_POST['id'];
      $full_name = $_POST['full_name'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      update_taikhoan_home($full_name, $username, $password, $email, $address, $phone, $id);
      $_SESSION['username'] = checkuser($username, $password);
      echo '<script>alert("Bạn đã cập nhật thông tin thành công")</script>';
    }
    $listtaikhoan = loadall_taikhoan();
    require ".$VIEW_URL/myaccount.php";
    break;

  case 'updatetk':

    if (isset($_POST['thaydoi']) && ($_POST['thaydoi'])) {
      $id = $_POST['id'];
      $full_name = $_POST['full_name'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      $full_name = $_POST['full_name'];
      $role = $_POST['role'];
      update_taikhoan($id, $full_name, $username, $password, $email, $address, $phone, $role);
      $_SESSION['username'] = checkuser($username, $password);
      echo '<script>alert("Bạn đã cập nhật thông tin thành công")</script>';
      // header('location: index.php?act=myaccount');
      // $thongbao = "Bạn đã cập nhật thông tin thành công";
    }
    require ".$VIEW_URL/myaccount.php";
    break;
  case 'thoat':
    session_unset();
    header('Location: index.php');
    break;
  case 'timkiem':
    if (isset($_POST['timkiem'])) {
      $tukhoa = $_POST['tukhoa'];
    }
    require ".$VIEW_URL/timkiem.php";
    break;





     // ------------Bộ lọc----------
  case 'ao_new':
    require ".$VIEW_URL/boloc/ao-new.php";
    break;
  case 'vay_new':
    require ".$VIEW_URL/boloc/vay-new.php";
    break;
  case 'quan_new':
    require ".$VIEW_URL/boloc/quan-new.php";
    break;
  case 'ao_sale':
    require ".$VIEW_URL/boloc/ao-sale.php";
    break;
  case 'vay_sale':
    require ".$VIEW_URL/boloc/vay-sale.php";
    break;
  case 'quan_sale':
    require ".$VIEW_URL/boloc/quan-sale.php";
    break;
  case 'aosomi':
    require ".$VIEW_URL/boloc/ao-so-mi.php";
    break;
  case 'aothun':
    require ".$VIEW_URL/boloc/ao-thun.php";
    break;
  case 'hoodie':
    require ".$VIEW_URL/boloc/hoodie.php";
    break;
  case 'quannam':
    require ".$VIEW_URL/boloc/quannam.php";
    break;
  case 'aonam':
    require ".$VIEW_URL/boloc/ao-nam.php";
    break;
  case 'polo':
    require ".$VIEW_URL/boloc/polo.php";
    break;
  case 'aonu':
    require ".$VIEW_URL/boloc/ao-nu.php";
    break;
  case 'quannu':
    require ".$VIEW_URL/boloc/quan-nu.php";
    break;
  case 'vaynu':
    require ".$VIEW_URL/boloc/vay-nu.php";
    break;
  case 'price_filter':
    require ".$VIEW_URL/boloc/loc-giatien-all.php";
    break;
  case 'price_filter_new':
    require ".$VIEW_URL/boloc/loc-giatien-new.php";
    break;
  case 'price_filter_sale':
    require ".$VIEW_URL/boloc/loc-giatien-sale.php";
    break;
  case 'price_filter_nam':
    require ".$VIEW_URL/boloc/loc-giatien-nam.php";
    break;
  case 'price_filter_nu':
    require ".$VIEW_URL/boloc/loc-giatien-nu.php";
    break;
  case 'size_filter':
    require ".$VIEW_URL/boloc/loc-size-all.php";
    break;
  case 'size_filter_sale':
    require ".$VIEW_URL/boloc/loc-size-sale.php";
    break;
  case 'size_filter_new':
    require ".$VIEW_URL/boloc/loc-size-new.php";
    break;
  case 'size_filter_nam':
    require ".$VIEW_URL/boloc/loc-size-nam.php";
    break;
  case 'size_filter_nu':
    require ".$VIEW_URL/boloc/loc-size-nu.php";
    break;
  case 'color_filter_nam':
    require ".$VIEW_URL/boloc/mau-sac-nam.php";
    break;
  case 'color_filter_nu':
    require ".$VIEW_URL/boloc/mau-sac-nu.php";
    break;
  case 'color_filter':
    require ".$VIEW_URL/boloc/mau-sac-all.php";
    break;
  case 'color_filter_new':
    require ".$VIEW_URL/boloc/mau-sac-new.php";
    break;
  case 'color_filter_sale':
    require ".$VIEW_URL/boloc/mau-sac-sale.php";
    break;
  
   // -----------Product detail and cart--------------
  case 'check-quanity':
    require ".$CONTROLLER_URL/check_product_quantity.php";
    break;
  case 'add_to_cart':
    require ".$CONTROLLER_URL/add_to_cart.php";
    break;
  case 'reload_cart':
    require ".$INCLUDES_URL/cart_modal.php";
    break;
  case 'update_quantity_product':
    require ".$CONTROLLER_URL/update_quantity_in_cart.php";
    break;
  case 'order-detail':
    require ".$VIEW_URL/order_detail.php";
    break;
  case 'view-cart':
    require ".$VIEW_URL/view-cart.php";
    break;
  case 'load_cart':
    require ".$CONTROLLER_URL/return_data_cart.php";
    break;
  case 'product_add_quantity_to_cart':
    require ".$CONTROLLER_URL/product_add_quantity_to_cart.php";
    break;
  case 'product_delete_quantity_to_cart':
    require ".$CONTROLLER_URL/delete_product_in_cart.php";
    break;
  case 'show_quantity_in_cart':
    require ".$CONTROLLER_URL/return_cart_quantity.php";
    break;
  case 'get_customer_info':
    require ".$CONTROLLER_URL/get_customer_info.php";
    break;
  case 'order_handle':
    require ".$CONTROLLER_URL/progress_order.php";
    break;
  case 'get_product_info':
    require ".$CONTROLLER_URL/get_product_info.php";
    break;
  case 'order_details_infomation':
    require ".$VIEW_URL/order_details_infomation_load.php";
    break;
  case 'get_anomyous_customer_info':
    require ".$CONTROLLER_URL/get_anomyous_customer_info.php";
    break;
  case 'cancel_order':
    require ".$CONTROLLER_URL/cancel_order.php";
    break;
  case 'thanks':
    require ".$VIEW_URL/thanks.php";
    break;
  case 'receive':
    require ".$CONTROLLER_URL/receive.php";
    break;

  default:
    echo 'Đang làm thêm trang 404';
    break;
}

