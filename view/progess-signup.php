<?php
session_start();
include "../model/pdo.php";
include "../model/taikhoan.php";
include "../global.php";

if (isset($_POST['dangky'])) {
  $flag = 1;
  $full_name = $_POST['full_name'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  // $confirm_password = $_POST['confirm_password'] ?? '';
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];

  // Kiểm tra mật khẩu xác nhận
  // if ($password !== $confirm_password) {
  //   $flag = 0;
  //   echo '<script>alert("Mật khẩu xác nhận không khớp")</script>';
  //   echo '<script>window.location.href="../index.php?act=dangky"</script>';
  //   exit();
  // }

  // Kiểm tra email đã tồn tại
  $sql = checkemail($email);
  if ($sql) {
    $flag = 0;
    echo '<script>alert("Email đã tồn tại")</script>';
    echo '<script>window.location.href="../index.php?act=dangky"</script>';
    exit();
  }

  // Kiểm tra username đã tồn tại
  $check = checktrung($username);
  if ($check) {
    $flag = 0;
    echo '<script>alert("Username đã tồn tại")</script>';
    echo '<script>window.location.href="../index.php?act=dangky"</script>';
    exit();
  }

  if($flag == 1){
    
    // Gọi hàm insert (chỉ truyền 6 tham số)
    insert_taikhoan($full_name, $username, $password, $email, $address, $phone);
    
    echo '<script>alert("Bạn đã đăng ký thành công")</script>';
    echo '<script>window.location.href="../index.php"</script>';
    exit();
  }
}

// Nếu không phải POST request, chuyển hướng về trang chủ
header('Location: ../index.php');
exit();
?>