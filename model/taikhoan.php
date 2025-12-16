<?php
// Thêm giá trị mặc định cho role
function insert_taikhoan($full_name, $username, $password, $email, $address, $phone, $role = 0){
    $sql = "INSERT INTO `user` (full_name, username, password, email, address, phone, role) VALUES (?, ?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $full_name, $username, $password, $email, $address, $phone, $role);
}

// Sửa tất cả hàm query sử dụng prepared statement
function checkuser($username, $password){
    $sql = "SELECT * FROM user WHERE username = ? AND password = ?";
    $sp = pdo_query_one($sql, $username, $password);
    return $sp;
}

function checkemail($email){
    $sql = "SELECT * FROM user WHERE email = ?";
    $sp = pdo_query_one($sql, $email);
    return $sp;
}

function checktrung($username){
    $sql = "SELECT * FROM user WHERE username = ?";
    $sp = pdo_query_one($sql, $username);
    return $sp;
}

function get_user_by_id($id){
    $sql = "SELECT * FROM user WHERE id = ?";
    $sp = pdo_query_one($sql, $id);
    return $sp;
}

function loadall_taikhoan(){
    $sql = "SELECT * FROM user ORDER BY id DESC";
    $listtaikhoan = pdo_query($sql);
    return $listtaikhoan;
}

function delete_taikhoan($id){
    $sql = "UPDATE user SET isActive = 0 WHERE id = ?";
    pdo_execute($sql, $id);
}

function enable_taikhoan($id){
    $sql = "UPDATE user SET isActive = 1 WHERE id = ?";
    pdo_execute($sql, $id);
}

function loadone_taikhoan($id){
    $sql = "SELECT * FROM user WHERE id = ?";
    $tk = pdo_query_one($sql, $id);
    return $tk;
}

// Sửa lỗi: bỏ dấu phẩy thừa trước WHERE
function update_taikhoan_home($full_name, $username, $password, $email, $address, $phone, $id){
    $sql = "UPDATE `user` SET `full_name` = ?, `username` = ?, `password` = ?, `email` = ?, `address` = ?, `phone` = ? WHERE `id` = ?";
    pdo_execute($sql, $full_name, $username, $password, $email, $address, $phone, $id);
}

function update_taikhoan($id, $full_name, $username, $password, $email, $address, $phone, $role){
    $sql = "UPDATE user SET full_name = ?, username = ?, password = ?, email = ?, address = ?, phone = ?, role = ? WHERE id = ?";
    pdo_execute($sql, $full_name, $username, $password, $email, $address, $phone, $role, $id);
}
?>