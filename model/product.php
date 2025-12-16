<?php

function add_product($product_name, $product_price, $product_main_image, $product_hover_main_image, $product_discount, $gender, $product_code, $product_description, $category_id)
{
    $sql = "INSERT INTO products(product_name,product_price,main_image_url,hover_main_image_url,discount,gender,product_code,product_desc,category_id) VALUES(?,?,?,?,?,?,?,?,?)";
    return pdo_execute_return_lastInsertId($sql, $product_name, $product_price, $product_main_image, $product_hover_main_image, $product_discount, $gender, $product_code, $product_description, $category_id);
}

function add_images_product($images, $color_name_id, $product_id)
{
    $sql = "INSERT INTO images(image_url,color_name_id,product_id) VALUES(?,?,?)";
    pdo_execute($sql, $images, $color_name_id, $product_id);
}
function selectAll_product($sortDescending, $product_status)
{
    $sql = "SELECT * FROM products WHERE product_status = ? ORDER BY product_id " . ($sortDescending ? "DESC" : "ASC");
    return pdo_query($sql, $product_status);
}
function select_product_color_by_id($product_id)
{
    $sql = "SELECT product_color.* FROM products JOIN product_color ON products.product_id = product_color.product_id 
    WHERE products.product_id = ?";
    return pdo_query($sql, $product_id);
}
function select_product_images_by_id($product_id)
{
    $sql = "SELECT product_images.* FROM products JOIN product_images ON products.product_id = product_images.product_id 
    WHERE products.product_id = ?";
    return pdo_query($sql, $product_id);
}
function select_images_by_id($product_id)
{
    $sql = "SELECT * FROM images WHERE product_id = ?";
    return pdo_query($sql, $product_id);
}
function select_images_by_color_name_id($color_name_id)
{
    $sql = "SELECT * FROM images WHERE color_name_id = ?";
    return pdo_query($sql, $color_name_id);
}
function select_product_size_by_id($product_id)
{
    $sql = "SELECT product_size.* FROM products JOIN product_size ON products.product_id = product_size.product_id 
    WHERE products.product_id = ?";
    return pdo_query($sql, $product_id);
}
function select_all_size()
{
    $sql = "SELECT * FROM size ORDER BY size_id ";
    return pdo_query($sql);
}
function select_all_size_by_product_id($product_id)
{
    $sql = "SELECT quantities.* FROM products JOIN quantities ON products.product_id = quantities.product_id WHERE quantities.product_id = ? ORDER BY size_id ASC";
    return pdo_query($sql, $product_id);
}
function select_all_size_by_product_id_and_color_name_id($color_name_id, $product_id)
{
    $sql = "SELECT quantities.* FROM products JOIN quantities ON products.product_id = quantities.product_id WHERE quantities.color_name_id = ? 
    AND quantities.product_id = ? 
    AND quantities.quantity > 0 ORDER BY size_id ASC";
    return pdo_query($sql, $color_name_id, $product_id);
}
function select_all_color()
{
    $sql = "SELECT * FROM color_type ORDER BY color_type_id ";
    return pdo_query($sql);
}
function select_product_color($product_code)
{
    $sql = "SELECT color_name.*,product_color.* FROM products JOIN product_color ON products.product_id = product_color.product_id 
        JOIN color_name ON product_color.color_name_id = color_name.color_name_id WHERE products.product_code = ?";
    return pdo_query($sql, $product_code);
}
function select_color_by_product_id($product_id)
{
    $sql = "SELECT color_name.* FROM products JOIN product_color ON products.product_id = product_color.product_id 
        JOIN color_name ON product_color.color_name_id = color_name.color_name_id WHERE products.product_id = ?";
    return pdo_query_one($sql, $product_id);
}
function select_color_by_id($product_id)
{
    $sql = "SELECT color_type.* FROM products JOIN product_color ON products.product_id = product_color.product_id 
     JOIN color_type ON product_color.color_type_id = color_type.color_type_id WHERE products.product_id = ?";
    return pdo_query_one($sql, $product_id);
}
function select_all_color_by_product_id($product_id)
{
    $sql = "SELECT color_name.* FROM products JOIN product_color ON products.product_id = product_color.product_id 
    JOIN color_name ON product_color.color_name_id = color_name.color_name_id WHERE products.product_id = ?";
    return pdo_query($sql, $product_id);
}
function select_size_by_id($size_Id)
{
    $sql = "SELECT * FROM size WHERE size_id = ?";
    return pdo_query_one($sql, $size_Id);
}
// 
// function select_color_name_by_id($color_name_id)
// {
//     $sql = "SELECT * FROM color_name WHERE color_name_id = ?";
//     return pdo_query_one($sql, $color_name_id);
// }


function select_home_product($sortDescending, $category_id)
{
    $sql = "SELECT * FROM products WHERE category_id = ? ORDER BY product_id " . ($sortDescending ? "DESC" : "ASC") . " LIMIT 8";
    return pdo_query($sql, $category_id);
}
function select_home_top10_product($sortDescending, $category_id)
{
    $sql = "SELECT * FROM products WHERE view > 1 AND category_id = ? ORDER BY product_id " . ($sortDescending ? "DESC" : "ASC") . " LIMIT 10";
    return pdo_query($sql, $category_id);
}
function count_home_product($category_id)
{
    $sql = "SELECT SUM(quantity) FROM products WHERE category_id = ?";
    return pdo_query_value($sql, $category_id);
}
function select_product_by_id($product_id)
{
    $sql = "SELECT * FROM products WHERE product_id = ? ";
    return pdo_query_one($sql, $product_id);
}
function product_delete($product_id)
{
    $sql = "DELETE FROM products WHERE product_id = ?";
    pdo_execute($sql, $product_id);
}

function product_update($product_name, $product_price, $product_main_image, $product_hover_main_image, $product_discount, $product_code, $product_description, $category_id, $product_id)
{
    $sql = "UPDATE products SET product_name = ?, product_price = ?,main_image_url = ?,hover_main_image_url = ?,discount = ?,product_code = ?,product_desc = ?,category_id = ? 
    WHERE product_id = ?";
    pdo_execute($sql, $product_name, $product_price, $product_main_image, $product_hover_main_image, $product_discount, $product_code, $product_description, $category_id, $product_id);
}
function select_all_product_by_category($product_id)
{
    $sql = "SELECT * FROM products WHERE product_id = ?";
    return pdo_query($sql, $product_id);
}
function add_image($product_image, $tmp_image, $folder_root)
{
    $checkTail = ['png', 'jpg', 'webp', 'jfif', 'gif', 'jepg'];
    $file_info = pathinfo($product_image['name']);
    $save_img = "";

    if (in_array($file_info['extension'], $checkTail)) {
        $folder_name = "../../$folder_root/images/";
        $file_name = uniqid() . $product_image['name'];
        if (move_uploaded_file($tmp_image, $folder_name . $file_name)) {
            $folder_name = "$folder_root/images/";
            $save_img = $folder_name . $file_name;
        };
        return $save_img;
    } else {
        return "";
    }
}
function add_image_js_version($product_image, $tmp_image, $folder_root)
{
    $checkTail = ['png', 'jpg', 'webp', 'jfif', 'gif', 'jepg'];
    $file_info = pathinfo($product_image['name']);
    $save_img = "";

    if (in_array($file_info['extension'], $checkTail)) {
        $folder_name = "../../du_an1/$folder_root/images/";
        $file_name = uniqid() . $product_image['name'];
        if (move_uploaded_file($tmp_image, $folder_name . $file_name)) {
            $folder_name = "$folder_root/images/";
            $save_img = $folder_name . $file_name;
        };
        return $save_img;
    } else {
        return "";
    }
}
function update_images($image_url, $image_id)
{
    $sql = "UPDATE images SET image_url = ? WHERE image_id = ?";
    pdo_execute($sql, $image_url, $image_id);
}
function select_image_url($image_id)
{
    $sql = "SELECT image_url FROM images WHERE image_id = ?";
    return pdo_query_one($sql, $image_id);
}
function select_image_by_color_name_id($color_name_id)
{
    $sql = "SELECT image_url FROM images WHERE color_name_id = ?";
    return pdo_query($sql, $color_name_id);
}
function select_image_by_color_name_id_and_product_id($color_name_id, $product_id)
{
    $sql = "SELECT image_url FROM images WHERE color_name_id = ? AND product_id = ?";
    return pdo_query($sql, $color_name_id, $product_id);
}
function delete_images($image_id)
{
    $sql = "DELETE FROM images WHERE image_id  = ?";
    pdo_execute($sql, $image_id);
}
function delete_images_by_color_name_id($color_name_id)
{
    $sql = "DELETE FROM images WHERE color_name_id  = ?";
    pdo_execute($sql, $color_name_id);
}
function select_all_image_by_id($product_id)
{
    $sql = "SELECT * FROM images WHERE product_id = ? ORDER BY image_id ASC ";
    return pdo_query($sql, $product_id);
}
function add_color_name($color_name, $color_image, $color_type_id)
{
    $sql = "INSERT INTO color_name(color_name,color_image,color_type_id) VALUES(?,?,?)";
    return pdo_execute_return_lastInsertId($sql, $color_name, $color_image, $color_type_id);
}
function select_product_color_by_product_id($product_id)
{
    $sql = "SELECT * FROM product_color WHERE product_id = ?";
    return pdo_query($sql, $product_id);
}
function select_first_product_color_by_product_id($product_id)
{
    $sql = "SELECT * FROM product_color WHERE product_id = ?";
    return pdo_query_one($sql, $product_id);
}
function update_color_name($color_name, $color_image, $color_type_id, $color_name_id)
{
    $sql = "UPDATE color_name SET color_name = ?,color_image = ?,color_type_id = ? WHERE color_name_id = ?";
    pdo_execute($sql, $color_name, $color_image, $color_type_id, $color_name_id,);
}
function select_color_name_by_id($color_name_id)
{
    $sql = "SELECT * FROM color_name WHERE color_name_id = ?";
    return pdo_query_one($sql, $color_name_id);
}
function select_all_color_name_by_id($color_name_id)
{
    $sql = "SELECT * FROM color_name WHERE color_name_id = ?";
    return pdo_query($sql, $color_name_id);
}
function select_all_color_name_by_product_id($product_id)
{
    $sql = "SELECT color_name.* FROM products JOIN product_color ON products.product_id = product_color.product_id 
    JOIN color_name ON product_color.color_name_id = color_name.color_name_id  WHERE products.product_id = ?";
    return pdo_query($sql, $product_id);
}
function update_product_color($color_type_id, $product_id)
{
    $sql = "UPDATE product_color SET color_type_id = ? WHERE product_id = ?";
    pdo_execute($sql, $color_type_id, $product_id);
}
function delete_color($color_id)
{
    $sql = "DELETE FROM color_name WHERE color_name_id = ?";
    pdo_execute($sql, $color_id);
}
function delete_product_color($product_id)
{
    $sql = "DELETE FROM product_color WHERE product_id  = ?";
    pdo_execute($sql, $product_id);
}
function handle_delete_color($product_id_param)
{
    // $fist_record = 0;
    $color_id_array = [];
    $result = select_product_color_by_id($product_id_param);
    // $color_id = $result[$fist_record]['color_name_id'];
    foreach ($result as $key => $value) {
        $color_id_array[$key] = $value['color_name_id'];
    }
    delete_product_color($product_id_param);

    return $color_id_array;
}

function handle_delete_size($product_id_param)
{
    // $fist_record = 0;
    // $result = select_product_size_by_id($product_id_param);
    // $size_id = $result[$fist_record]['size_id'];
    delete_product_size($product_id_param);
    // return $size_id;
}
function add_detail_image($image_url)
{
    $sql = "INSERT INTO images(image_url) VALUES(?)";
    return pdo_execute_return_lastInsertId($sql, $image_url);
}
function update_detail_image($image_url, $image_id)
{
    $sql = "UPDATE images SET image_url = ? WHERE image_id = ?";
    return pdo_execute_return_lastInsertId($sql, $image_url, $image_id);
}
function delete_images_by_product_id($product_id)
{
    $sql = "DELETE FROM images WHERE product_id = ?";
    pdo_execute($sql, $product_id);
}
function add_product_size($product_id, $size_id)
{
    $sql = "INSERT INTO product_size(product_id,size_id) VALUES(?,?)";
    return pdo_execute($sql, $product_id, $size_id);
}
function add_product_color($product_id, $color_name_id)
{
    $sql = "INSERT INTO product_color(product_id,color_name_id) VALUES(?,?)";
    pdo_execute($sql, $product_id, $color_name_id);
}
function add_quantities($product_id, $color_name_id, $size_id, $quantity)
{
    $sql = "INSERT INTO quantities(product_id,color_name_id,size_id,quantity) VALUES(?,?,?,?)";
    pdo_execute($sql, $product_id, $color_name_id, $size_id, $quantity);
}
function update_size($size_id, $product_id)
{
    $sql = "UPDATE product_size SET size_id= ? WHERE product_id = ?";
    pdo_execute($sql, $size_id, $product_id);
}
function update_size_by_size_id($new_size_id, $size_id, $product_id)
{
    $sql = "UPDATE product_size SET size_id= ? WHERE size_id = ? and product_id = ?";
    pdo_execute($sql, $new_size_id, $size_id, $product_id);
}
function delete_product_size($product_id)
{
    $sql = "DELETE FROM product_size WHERE product_id = ?";
    pdo_execute($sql, $product_id);
}
function delete_quantities($product_id)
{
    $sql = "DELETE FROM quantities WHERE product_id = ?";
    pdo_execute($sql, $product_id);
}
function delete_size($size_id)
{
    $sql = "DELETE FROM size WHERE size_id = ?";
    pdo_execute($sql, $size_id);
}
// function select_all_size_by_id($product_id)
// {
//     $sql = "SELECT size.* FROM products JOIN product_size ON products.product_id = product_size.product_id 
//         JOIN size ON product_size.size_id = size.size_id WHERE products.product_id = ?";
//     return pdo_query($sql, $product_id);
// }

function select_all_product_admin($query = '')
{
    if (!empty($query)) {
        $search = "%" . $query . "%";
        $sql = "SELECT * FROM products WHERE product_name LIKE ?";
        return pdo_query($sql, $search);
    } else {
        $sql = "SELECT * FROM products";
        return pdo_query($sql);
    }
}
function select_quantity_by_size($size_id, $color_name_id, $product_id)
{
    $sql = "SELECT quantities.* FROM products JOIN quantities 
    ON products.product_id = quantities.product_id 
    WHERE quantities.size_id = ? AND quantities.color_name_id = ?
    AND quantities.product_id = ?";
    return pdo_query_one($sql, $size_id, $color_name_id, $product_id);
}
function select_quantity_by_product_id_color_name_id_and_size_id($size_id, $color_name_id, $product_id)
{
    $sql = "SELECT quantities.* FROM products JOIN quantities 
    ON products.product_id = quantities.product_id 
    WHERE quantities.size_id = ? AND quantities.color_name_id = ?
    AND quantities.product_id = ? ";
    return pdo_query_one($sql, $size_id, $color_name_id, $product_id);
}

function restructureFilesArray($files)
{
    $output = [];
    foreach ($files as $attrName => $valuesArray) {
        foreach ($valuesArray as $key => $value) {
            $output[$key][$attrName] = $value;
        }
    }
    return $output;
}
function check_product_exist($product_code)
{
    $sql = "SELECT COUNT(*) FROM products WHERE product_code = ?";
    return pdo_query_value($sql, $product_code);
}
// function phantrang_product(){
//     $sql = "SELECT product_id,COUNT(product_id) AS number FROM products";
//     return pdo_query($sql);
// }
// function phantrang_product($itemsPerPage) {
//     $totalProducts = pdo_query_value("SELECT COUNT(*) FROM products");
//     $totalPages = ceil($totalProducts / $itemsPerPage);

//     return $totalPages;
// }

function count_all_products($category_id)
{
    $sql = "SELECT COUNT(*) FROM products WHERE category_id = ?";
    return pdo_query_value($sql, $category_id);
}
function count_allnews_products($product_status)
{
    $sql = "SELECT COUNT(*) FROM products WHERE product_status = ?";
    return pdo_query_value($sql, $product_status);
}

function selectAll_product_phantrang($category_id, $sortDescending, $start, $limit)
{
    $sql = "SELECT * FROM products WHERE category_id = ? ORDER BY product_id " . ($sortDescending ? "DESC" : "ASC") . " LIMIT $start, $limit";
    return pdo_query($sql, $category_id);
}
function selectAll_news_product_phantrang($sortDescending, $start, $limit, $product_status)
{
    $sql = "SELECT * FROM products WHERE product_status = ? ORDER BY product_id " . ($sortDescending ? "DESC" : "ASC") . " LIMIT $start, $limit";
    return pdo_query($sql, $product_status);
}
function check_color_name_exist($color_name)
{
    $sql = "SELECT COUNT(*) 
    FROM color_name 
    WHERE LOWER(color_name) = LOWER(?)";
    return pdo_query_value($sql, $color_name);
}
function select_color_name_by_name($color_name)
{
    $sql = "SELECT * FROM color_name WHERE color_name = ?";
    return pdo_query_one($sql, $color_name);
}
function select_all_color_name_by_name($color_name)
{
    $sql = "SELECT * FROM color_name WHERE color_name = ?";
    return pdo_query($sql, $color_name);
}
function select_product_by_color_name_id($color_name_id)
{
    $sql = "SELECT products.*,color_name.* FROM color_name 
    LEFT JOIN product_color 
    ON color_name.color_name_id = product_color.color_name_id 
    LEFT JOIN products ON product_color.product_id = products.product_id 
    WHERE color_name.color_name_id = ? ";
    return pdo_query_one($sql, $color_name_id);
}
function dd($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    die;
}
function formatMoney($money)
{
    $locale = 'vi_VN';
    $currency = $money;
    $formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);
    return $formatter->format($currency);
}

function select_product_by_product_code($product_code)
{
    $sql = "SELECT * FROM products WHERE product_code = ?";
    return pdo_query_one($sql, $product_code);
}
function check_product_color_exist($color_name_id, $product_id)
{
    $sql = "SELECT COUNT(*) FROM product_color WHERE color_name_id = ? AND product_id = ?";
    return pdo_query_value($sql, $color_name_id, $product_id);
}
function check_product_size_exist($size_id, $product_id)
{
    $sql = "SELECT COUNT(*) FROM product_size WHERE size_id = ? AND product_id = ?";
    return pdo_query_value($sql, $size_id, $product_id);
}
function select_all_color_name()
{
    $sql = "SELECT * FROM color_name";
    return pdo_query($sql);
}
function select_one_color_name_by_color_name_id($color_name_id)
{
    $sql = "SELECT * FROM color_name WHERE color_name_id = ?";
    return pdo_query_one($sql, $color_name_id);
}
function select_product_size_by_product_id($product_id)
{
    $sql = "SELECT * FROM product_size WHERE product_id = ?";
    return pdo_query($sql, $product_id);
}
function select_quantities_by_product_id($product_id)
{
    $sql = "SELECT * FROM quantities WHERE product_id = ?";
    return pdo_query($sql, $product_id);
}
function select_size_unduplicate($product_id)
{
    $sql = "SELECT size_id FROM quantities WHERE product_id = ? GROUP BY size_id";
    return pdo_query($sql, $product_id);
}
function select_color_type_by_id($size_id)
{
    $sql = "SELECT * FROM size WHERE size_id = ?";
    return pdo_query_one($sql, $size_id);
}
function select_one_color_type_by_id($color_type_id)
{
    $sql = "SELECT * FROM color_type WHERE color_type_id = ?";
    return pdo_query_one($sql, $color_type_id);
}
function select_one_size_by_size_id($size_id)
{
    $sql = "SELECT * FROM size WHERE size_id = ?";
    return pdo_query_one($sql, $size_id);
}
function check_product_quantites_exist($product_id, $color_name_id, $size_id)
{
    $sql = "SELECT COUNT(*) FROM quantities WHERE product_id = ? AND color_name_id = ? AND size_id = ?";
    return pdo_query_value($sql, $product_id, $color_name_id, $size_id);
}
function quantity_update($quantity, $product_id, $color_name_id, $size_id)
{
    $sql = "UPDATE quantities SET quantity = quantity + ? WHERE product_id = ? AND color_name_id = ? AND size_id = ?";
    pdo_execute($sql, $quantity, $product_id, $color_name_id, $size_id);
}
function quantity_decrease($quantity, $product_id, $color_name_id, $size_id)
{
    $sql = "UPDATE quantities SET quantity = quantity - ? WHERE product_id = ? AND color_name_id = ? AND size_id = ?";
    pdo_execute($sql, $quantity, $product_id, $color_name_id, $size_id);
}
function quantities_update($quantity, $new_size_id, $product_id, $color_name_id, $old_size_id)
{
    $sql = "UPDATE quantities SET quantities = quantities + ?,size_id = ? WHERE product_id = ? AND color_name_id = ? AND size_id = ?";
    pdo_execute($sql, $quantity, $new_size_id, $product_id, $color_name_id, $old_size_id);
}
function quantities_update_size_quantity($quantity, $new_size_id, $product_id, $quantity_id)
{
    $sql = "UPDATE quantities SET quantity = ?,size_id = ? WHERE product_id = ? AND quantity_id = ?";
    pdo_execute($sql, $quantity, $new_size_id, $product_id, $quantity_id);
}
function inc_view($product_id)
{
    $sql = "UPDATE products SET view = view + 1 WHERE product_id = ?";
    pdo_execute($sql, $product_id);
}
