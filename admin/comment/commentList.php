<?php require "./header.php" ?>

<div class="main">
    <div class="main-content dashboard">
        <form action="./index.php?act=listbl" method="post">
            <table class=" table">
                <tr class="table-primary">
                    <th>ID BÌNH LUẬN</th>
                    <th>TÊN ĐĂNG NHẬP</th>
                    <th>MỘI DUNG</th>
                    <th>MÃ SẢN PHẨM</th>
                    <th>NGÀY BÌNH LUẬN</th>
                    <th></th>
                </tr>
                <?php $comment_result = loadall_comment(false); ?>
                <?php foreach ($comment_result as $value) : ?>
                    <?php $username_comment_result = getUserName($value['id']); 
                        extract($username_comment_result);
                    ?>
                    <tr class="table-success">
                    <td><?= $value['comment_id']; ?></td>
                    <td><?= $username; ?></td>
                    <td><?= $value['content']; ?></td>
                    <td><?= $value['product_id']; ?></td>
                    <td><?= $value['comment_time']; ?></td>
                    <td>
                        <a onclick="return confirm(' Bạn có chắc chắn muốn xóa sản phẩm này')" href="./index.php?act=delete_comment&comment_id=<?= $value['comment_id']; ?>"><input class="btn btn-danger" type="button" name="delete" value="Xóa" /></a>
                    </td>
                    </tr>
                <?php endforeach ?>

            </table>
        </form>
    </div>
</div>
<?php require_once "./footer.php" ?> 