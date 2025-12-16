<?php

function insertCategory($name_category){
    $sql="INSERT INTO `categories`(`name_category`) VALUES ('$name_category')";
    pdo_execute($sql);
}

function listCategory(){
    $sql="SELECT * FROM `categories` order by id_category desc";
    $list = pdo_query($sql);
    return $list;
}

function select_one_category($id_category)
{
    $sql = "SELECT * FROM `categories` WHERE id_category = $id_category";
    $list_one =pdo_query_one($sql);
    return $list_one;
}

function update_category($name_category,$id_category)
{
    $sql = "UPDATE `categories` SET `name_category` = '$name_category' WHERE `categories`.`id_category` = $id_category";
    pdo_execute($sql);
}

function delete($id_category)
{
    $sql = "DELETE FROM categories WHERE `categories`.`id_category` = $id_category";
    pdo_execute($sql);
}
function getSizesByCategory($category_id) {
    $sql = "SELECT DISTINCT size.* FROM size 
            JOIN product_size ON size.size_id = product_size.size_id 
            JOIN products ON product_size.product_id = products.product_id 
            WHERE products.category_id = ?";
    return pdo_query($sql, $category_id);
}
?>