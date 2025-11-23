<?php
include "../model/pdo.php";
include "../model/taikhoan.php";
include "../global.php";




if (isset($_POST['dangky'])) {
  $flag =1 ;
  $full_name = $_POST['full_name'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];

  $sql = checkemail($email);
  $check = checktrung($username);
  if ($sql > 0 ) {
    $flag = 0;
    echo '<script>alert("Email đã tồn tại")</script>';
    echo '<script>window.location.href="../index.php"</script>';
    // header('location:../index.php');
  }
  if ($check > 0 ) {
    $flag = 0;
    echo '<script>alert("Username đã tồn tại")</script>';
    echo '<script>window.location.href="../index.php"</script>';
    // header('location:../index.php');
  }
  if($flag == 1){
    insert_taikhoan($full_name, $username, $password, $email, $address, $phone);
    echo '<script>alert("Bạn đã đăng ký thành công")</script>';
    echo '<script>window.location.href="../index.php"</script>';
  }
  // insert_taikhoan($full_name, $username, $password, $email, $address, $phone);
  // echo '<script>alert("Bạn đã đăng ký thành công")</script>';

}
// header('location:../index.php');
