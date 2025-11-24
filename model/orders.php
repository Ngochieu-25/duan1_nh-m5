<?php
function add_order($customer_id, $receiver_name, $receiver_address, $receiver_number_phone, $receiver_email, $receiver_note, $status_id, $pay_methods, $total_price, $delivery_charges)
{
    $sql = "INSERT INTO orders(customer_id, receiver_name, receiver_address, receiver_number_phone, receiver_email, receiver_note, status_id,pay_methods ,total_price,delivery_charges) 
    VALUES(?,?,?,?,?,?,?,?,?,?) ";
    pdo_execute($sql, $customer_id, $receiver_name, $receiver_address, $receiver_number_phone, $receiver_email, $receiver_note, $status_id, $pay_methods, $total_price, $delivery_charges);
}
function select_max_order_id($customer_id)
{
    $sql = "SELECT MAX(order_id) FROM orders WHERE customer_id = ?";
    return pdo_query_value($sql, $customer_id);
}
function select_max_order()
{
    $sql = "SELECT MAX(order_id) FROM orders";
    return pdo_query_value($sql);
}
// function select_info_max_orders()
// {
//     $sql = "SELECT * FROM orders WHERE email";
//     return pdo_query_value($sql);
// }
function add_order_product($order_id, $product_id, $size_id, $color_name_id, $quantity)
{
    $sql = "INSERT INTO order_product(order_id,product_id,size_id,color_name_id,quantity) VALUES(?,?,?,?,?)";
    pdo_execute($sql, $order_id, $product_id, $size_id, $color_name_id, $quantity);
}
function select_all_orders($receiver_name = '', $from_date = '', $to_date = '', $status_id = '')
{
    $sql = "SELECT orders.* FROM orders WHERE 1=1";  
    $params = [];  

    if ($receiver_name !== '') {
        $sql .= " AND receiver_name LIKE ?";
        $params[] = '%' . $receiver_name . '%';
    }

    if ($from_date !== '') {
        $sql .= " AND created_at >= ?";
        $params[] = $from_date;
    }

    if ($to_date !== '') {
        $sql .= " AND created_at <= ?";
        $params[] = $to_date;
    }

    if ($status_id !== '') {
        $sql .= " AND status_id = ?";
        $params[] = $status_id;
    }

    $sql .= " ORDER BY created_at DESC";  

    return pdo_query($sql, ...$params);
}



function select_all_order_product_admin_by_id($order_id)
{
    $sql = "SELECT orders.*,order_product.*,products.* FROM orders 
    JOIN order_product ON orders.order_id = order_product.order_id 
    JOIN products ON products.product_id = order_product.product_id 
    WHERE orders.order_id = ?";
    return pdo_query($sql, $order_id);
}
function select_status_by_id($status_id)
{
    $sql = "SELECT * FROM status WHERE status_id = ?";
    return pdo_query_one($sql, $status_id);
}
function select_all_status()
{
    $sql = "SELECT * FROM status";
    return pdo_query($sql);
}
function select_order_product_by_id($order_id)
{
    $sql = "SELECT * FROM order_product WHERE order_id = ?";
    return pdo_query_one($sql, $order_id);
}
function select_order_by_id($order_id)
{
    $sql = "SELECT * FROM orders WHERE order_id = ?";
    return pdo_query_one($sql, $order_id);
}
function orders_update($status_id, $order_id)
{
    $sql = "UPDATE orders SET status_id = ? WHERE order_id = ?";
    pdo_execute($sql, $status_id, $order_id);
}
function select_all_order_product_by_order_id($order_id)
{
    $sql = "SELECT * FROM order_product WHERE order_id = ?";
    return pdo_query($sql, $order_id);
}
function select_all_order_product_by_id($order_id)
{
    $sql = "SELECT orders.*,order_product.*,products.* FROM orders 
    JOIN order_product ON orders.order_id = order_product.order_id 
    JOIN products ON products.product_id = order_product.product_id 
    WHERE orders.order_id = ?";
    return pdo_query($sql, $order_id);
}
function select_orders_product_by_id($order_id)
{
    $sql = "SELECT orders.*,order_product.*,products.* FROM orders 
    JOIN order_product ON orders.order_id = order_product.order_id 
    WHERE orders.order_id = ?";
    return pdo_query_one($sql, $order_id);
}
function select_all_order_product_by_email_and_phone_number($email, $phone_number)
{
    $sql = "SELECT orders.*,order_product.*,products.* FROM orders 
    JOIN order_product ON orders.order_id = order_product.order_id 
    JOIN products ON products.product_id = order_product.product_id 
    WHERE orders.receiver_email = ? AND orders.receiver_number_phone = ?";
    return pdo_query($sql, $email, $phone_number);
}
function select_all_order_product_by_email_and_phone_number_status($email, $phone_number, $status)
{
    $sql = "SELECT orders.*,order_product.*,products.* FROM orders 
    JOIN order_product ON orders.order_id = order_product.order_id 
    JOIN products ON products.product_id = order_product.product_id 
    WHERE orders.receiver_email = ? AND orders.receiver_number_phone = ? AND orders.status_id = ?";
    return pdo_query($sql, $email, $phone_number,  $status);
}
function count_email_and_phone_number($email, $phone_number)
{
    $sql = "SELECT COUNT(*) FROM orders WHERE receiver_email = ? AND receiver_number_phone = ?";
    return pdo_query_value($sql, $email, $phone_number);
}
function select_orders_by_email_and_phone_number($email, $phone_number)
{
    $sql = "SELECT * FROM orders 
    WHERE orders.receiver_email = ? AND orders.receiver_number_phone = ?  ORDER BY orders.created_at DESC";
    return pdo_query($sql, $email, $phone_number);
}
function select_orders_by_email_and_phone_number_status($email, $phone_number, $status)
{
    $sql = "SELECT * FROM orders 
    WHERE orders.receiver_email = ? AND orders.receiver_number_phone = ? AND orders.status_id = ?  ORDER BY orders.created_at DESC";
    return pdo_query($sql, $email, $phone_number, $status);
}

function select_email_and_number_phone($email, $phone_number)
{
    $sql = "SELECT * FROM orders 
    WHERE orders.receiver_email = ? AND orders.receiver_number_phone = ?";
    return pdo_query_one($sql, $email, $phone_number);
}
function select_quantity_order_product($order_id)
{
    $sql = "SELECT SUM(quantity) FROM orders 
    JOIN order_product ON orders.order_id = order_product.order_id 
    WHERE orders.order_id = ? ";
    return pdo_query_value($sql, $order_id);
}
function select_product_order_product($order_id)
{
    $sql = "SELECT products.*, order_product.* 
        FROM orders
        JOIN order_product ON orders.order_id = order_product.order_id 
        JOIN products ON products.product_id = order_product.product_id 
        WHERE orders.order_id = ?
        ORDER BY orders.created_at DESC";
    return pdo_query($sql, $order_id);
}
function delete_order_product_by_order_id($order_id)
{
    $sql = "DELETE FROM order_product WHERE order_id = ?";
    pdo_execute($sql, $order_id);
}
function delete_orders_by_order_id($order_id)
{
    $sql = "DELETE FROM orders WHERE order_id = ?";
    pdo_execute($sql, $order_id);
}
function update_completed($time, $order_id)
{
    $sql = "UPDATE orders SET completed_at = ? WHERE order_id = ?";
    pdo_execute($sql, $time, $order_id);
}
function add_purchased_orders($customer_id, $product_id, $size_id, $color_name_id, $quantity, $created_at, $completed_at, $customer_email, $customer_phone_number, $total_price)
{
    $sql = "INSERT INTO purchased_orders(customer_id, product_id, size_id, color_name_id,quantity, created_at, completed_at, customer_email, customer_phone_number, total_price) 
    VALUES (?,?,?,?,?,?,?,?,?,?)";
    pdo_execute($sql, $customer_id, $product_id, $size_id, $color_name_id, $quantity, $created_at, $completed_at, $customer_email, $customer_phone_number, $total_price);
}

function select_all_product_by_d($product_id)
{
    $sql = "SELECT * FROM products where product_id=$product_id";
    return pdo_query_one($sql);
}


function sum_product_quantities()
{
    $sql = "SELECT SUM(quantity) as soluongton, product_id FROM quantities GROUP BY product_id";
    return pdo_query($sql);
}

function sum_product_quantities_by_id($product_id)
{
    $sql = "SELECT SUM(quantity) as soluongton, product_id FROM quantities where product_id=$product_id GROUP BY product_id";
    return pdo_query_one($sql);
}
function total()
{
    $sql = 'SELECT SUBSTR(created_at, 6, 2) as thang,SUBSTR(created_at, 9, 2) as ngay, SUM(total_price) as tong, created_at FROM `purchased_orders`';
    return pdo_query_one($sql);
}

function doanhthu_ngay()
{
    $sql = "
    SELECT 
        SUBSTR(created_at, 1, 4) AS nam,
        SUBSTR(created_at, 6, 2) AS thang,
        SUBSTR(created_at, 9, 2) AS ngay,
        SUM(total_price) AS doanhthungay,
        COUNT(purchased_order_id) AS soluongdonhang
    FROM purchased_orders
    GROUP BY 
        SUBSTR(created_at, 1, 4), 
        SUBSTR(created_at, 6, 2), 
        SUBSTR(created_at, 9, 2)
    ";
    return pdo_query($sql);
}


function doanhthu_thang()
{
    $sql = 'SELECT SUBSTR(created_at, 1, 4) AS nam, SUBSTR(created_at, 6, 2)  as thang,SUBSTR(created_at, 9, 2) 
    as ngay,total_price,purchased_order_id,sum(total_price) 
    as doanhthuthang,
    COUNT(purchased_order_id) AS soluongdonhang
    FROM `purchased_orders` 
    group by SUBSTR(created_at, 6, 2)';
    return pdo_query($sql);
}


function sum_product_order($product_id)
{
    $sql = "SELECT SUM(quantity) as soluongban, product_id FROM `purchased_orders` WHERE product_id = $product_id GROUP BY product_id;";
    return pdo_query_one($sql);
}




// history ORDERS


/*
function doi_chieu($email, $phone_number)
{
    $sql = "SELECT orders.*,order_product.*,products.* FROM orders 
    JOIN order_product ON orders.order_id = order_product.order_id 
    JOIN products ON products.product_id = order_product.product_id 
    WHERE orders.receiver_email = ? AND orders.receiver_number_phone = ?";
    return pdo_query($sql, $email, $phone_number);
}
*/