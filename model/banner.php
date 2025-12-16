<?php
function selectAll_banner()
{
    $sql = "SELECT * FROM banner ORDER BY banner_id";   
    return pdo_query($sql);
}
function add_banner($banner_name,$banner_image)
{
    $sql = "INSERT INTO banner(banner_name,banner_image) 
    VALUES(?,?)";
    pdo_execute($sql,$banner_name,$banner_image);
}
function select_banner_by_id($banner_id)
{
    $sql = "SELECT * FROM banner WHERE banner_id = ? ";
    return pdo_query_one($sql,$banner_id);
}

function delete_banner($banner_id){
    $sql = "DELETE FROM banner WHERE banner_id = ?";
    pdo_execute($sql,$banner_id);
}
function banner_update($banner_name,$banner_main_image,$banner_id)
{
    $sql = "UPDATE banner SET banner_name = ?,banner_image = ?
    WHERE banner_id = ?";
    pdo_execute($sql,$banner_name,$banner_main_image,$banner_id);
}
?>


