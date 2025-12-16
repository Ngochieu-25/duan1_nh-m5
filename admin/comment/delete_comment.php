<?php
$comment_id = $_GET['comment_id'];
if(isset($comment_id)){
    delete_comment($comment_id);
}
include "./comment/commentList.php";