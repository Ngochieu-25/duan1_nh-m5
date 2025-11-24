<?php
    include "../model/pdo.php";
    include "../model/product.php";
    include "../model/comment.php";
    include "../model/taikhoan.php";
    $product_id = $_GET['product_id'];
    $comment_id = $_GET['comment_id'];
    delete_comment($comment_id);
    header("location:../du_an1/index.php?action=product_detail&product_id=".$product_id);
?>
