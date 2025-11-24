<?php
include "../model/pdo.php";
include "../model/taikhoan.php";
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$checkuser = checkuser($username, $password);
// print_r($_SESSION['username']);
// session_unset();
if (!is_array($checkuser)) {
    $error = [
        [
            "status" => "error",
            "message" => "Tài khoản hoặc mật khẩu không chính xác"
        ]
    ];
    echo json_encode($error);
} else {
    $_SESSION['username'] = $checkuser;
    $success = [
        [
            "status" => "success",
        ]
    ];
    echo json_encode($success);
}
