<?php
function timkiem($tukhoa){
    $sql = "SELECT *
    FROM products
    WHERE product_name LIKE '%$tukhoa%'
    GROUP BY product_code;";
    $a = pdo_query($sql);
    return $a;
}
function ao($product_status){
    $sql = "SELECT *
    FROM products
    WHERE product_name like '%ao%' AND product_status = ?
    GROUP BY product_code;";
    return pdo_query($sql,$product_status);
}
function vay($product_status){
    $sql = "SELECT *
    FROM products
    WHERE product_name like '%vay%' AND product_status = ?
    GROUP BY product_code;";
    return pdo_query($sql,$product_status);
}
function quan($product_status){
    $sql = "SELECT *
    FROM products
    WHERE product_name like '%quan%' AND product_status = ?
    GROUP BY product_code;";
    return pdo_query($sql,$product_status);
}
function ao_nam(){
    $sql = "SELECT *
    FROM products
    WHERE product_name like '%ao % nam%'
    GROUP BY product_code;";
    $a = pdo_query($sql);
    return $a;
}
function quan_nam(){
    $sql = "SELECT *
    FROM products
    WHERE product_name like '%quan % nam%'
    GROUP BY product_code;";
    $a = pdo_query($sql);
    return $a;
}
function ao_so_mi(){
    $sql = "SELECT *
    FROM products
    WHERE product_name like '%ao so mi nam%'
    GROUP BY product_code;";
    $a = pdo_query($sql);
    return $a;
}
function ao_thun(){
    $sql = "SELECT *
    FROM products
    WHERE product_name LIKE '%ao thun nam%'
    GROUP BY product_code;";
    $a = pdo_query($sql);
    return $a;
}
function ao_hoodie(){
    $sql = "SELECT *
    FROM products
    WHERE product_name LIKE '%hoodie%'
    GROUP BY product_code;";
    $a = pdo_query($sql);
    return $a;
}
function ao_polo(){
    $sql = "SELECT *
    FROM products
    WHERE product_name LIKE '%polo nam%'
    GROUP BY product_code;";
    $a = pdo_query($sql);
    return $a;  
}
function quan_nu(){
    $sql = "SELECT *
    FROM products
    WHERE product_name like '%quan % nu%'
    GROUP BY product_code;";
    $a = pdo_query($sql);
    return $a;
}
function ao_nu(){
    $sql = "SELECT *
    FROM products
    WHERE product_name like '%ao % nu%'
    GROUP BY product_code;";
    $a = pdo_query($sql);
    return $a;
}
function vay_nu(){
    $sql = "SELECT *
    FROM products
    WHERE product_name like '%vay % nu%'
    GROUP BY product_code;";
    $a = pdo_query($sql);
    return $a;
}
function price_bo_loc($min,$max,$gender){
    $sql = "SELECT *
    FROM products
    WHERE product_price >= ? AND product_price <= ? AND gender = ?
    ORDER BY product_id DESC";
    return pdo_query($sql,$min,$max,$gender);
}
function price_bo_loc_status($min,$max,$product_status){
    $sql = "SELECT *
    FROM products
    WHERE product_price >= ? AND product_price <= ? AND product_status = ?
    ORDER BY product_id DESC";
    return pdo_query($sql,$min,$max,$product_status);
}
function price_bo_locAll($min,$max){
    $sql = "SELECT *
    FROM products
    WHERE product_price >= ? AND product_price <= ?
    ORDER BY product_id DESC";
    return pdo_query($sql,$min,$max);
}

function filterProductsBySize($size,$gender) {
    $sql = "SELECT * FROM products p 
            JOIN product_size ps ON p.product_id = ps.product_id
            WHERE ps.size_id = ? AND gender = ?";
    return pdo_query($sql,$size,$gender);
}
function filterProductsBySizeAll($size,$product_status) {
    $sql = "SELECT * FROM products p 
            JOIN product_size ps ON p.product_id = ps.product_id
            WHERE ps.size_id = ? AND product_status = ?";
    return pdo_query($sql,$size,$product_status);
}
function filterProductsBySizeAll_timkiem($size) {
    $sql = "SELECT * FROM products p 
            JOIN product_size ps ON p.product_id = ps.product_id
            WHERE ps.size_id = ?";
    return pdo_query($sql,$size);
}
function getProductsByColor($color_id,$gender) {
    $sql = "SELECT products.* FROM products 
    JOIN product_color ON products.product_id = product_color.product_id 
    JOIN color_name ON product_color.color_name_id = color_name.color_name_id
    WHERE color_name.color_type_id = ? AND gender = ?";
    return pdo_query($sql, $color_id,$gender);
}
function getProductsByColorAll($color_id) {
    $sql = "SELECT products.* FROM products 
    JOIN product_color ON products.product_id = product_color.product_id 
    JOIN color_name ON product_color.color_name_id = color_name.color_name_id
    WHERE color_name.color_type_id = ?";
    return pdo_query($sql,$color_id);
}
function getProductsByColorAll_status($color_id,$product_status) {
    $sql = "SELECT products.* FROM products 
    JOIN product_color ON products.product_id = product_color.product_id 
    JOIN color_name ON product_color.color_name_id = color_name.color_name_id
    WHERE color_name.color_type_id = ? AND product_status = ?";
    return pdo_query($sql,$color_id,$product_status);
}