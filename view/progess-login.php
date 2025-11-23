
<?php 
include "../model/pdo.php";
include "../model/taikhoan.php";
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $checkuser = checkuser($username, $password);

    if (is_array($checkuser)) {
        if ($checkuser['isActive']) {
            $_SESSION['username'] = $checkuser;
            echo '<script>alert("Đăng nhập thành công"); window.location="../index.php";</script>';
        } else {
            echo '<script>alert("Tài khoản của bạn đã bị vô hiệu hóa"); window.location="../index.php";</script>';
        }
    } else {
        echo '<script>alert("Tài khoản hoặc mật khẩu không tồn tại"); window.location="../index.php";</script>';
    }


}