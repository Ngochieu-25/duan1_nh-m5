<?php

function insert_comment($content,$id,$product_id,$comment_time){
    $sql="insert into comment(content,id,product_id,comment_time) values('$content','$id','$product_id','$comment_time')";
    pdo_execute($sql);
}
function delete_comment($comment_id){
    $sql = "DELETE FROM comment WHERE comment_id = ?";
    pdo_execute($sql,$comment_id);
}
function getUserName($user_id) {
    $sql = "SELECT * FROM user WHERE id = $user_id";
    $result = pdo_query_one($sql);
    return $result;
}
function loadall_comment($product_id){
    $sql="select * from comment where 1";
    if($product_id>0) $sql.=" AND product_id='".$product_id."'";
    $sql.=" order by comment_id  desc";
    $listbl=pdo_query($sql);
    return $listbl;
}

function comment_select_by_id($comment_id){
    $sql = "SELECT * FROM comment
    WHERE comment_id = ?";   
    return pdo_query_one($sql,$comment_id);
}
function comment_update($content,$comment_id){
    $sql = "UPDATE comment SET content = ? WHERE comment_id = ?";
    pdo_execute($sql,$content,$comment_id);
 }
?>