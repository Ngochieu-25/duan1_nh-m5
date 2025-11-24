<?php require "./header.php" ?>


<!--   Phần content -->

<!--   Phần content -->
<!--   Phần content -->
<div class="main">
  <div class="main-content dashboard">
    <a href="./index.php?act=add_banner" class="mb-4">
      <button class="btn btn-primary">Thêm</button>
    </a>
    <span class="<?= isset($_COOKIE['notification']) ? "noti-success" : "" ?> ">
      <?= $notification = isset($_COOKIE['notification']) ? $_COOKIE['notification'] : ""; ?>
    </span>
    <form action="./index.php" method="post">
      <table class="table table-bordered table-hover">
        <thead>
          <th></th>
          <th>Mã loại</th>
          <th>Tên banner</th>
          <th>Ảnh banner</th>

          <th>Sửa</th>
          <th>Xóa</th>

        </thead>
        <tbody>
          <?php $banner_result = selectAll_banner(false); ?>
          <?php foreach ($banner_result as $value) : ?>
            <tr>
              <th></th>
              <td><?= $value['banner_id']; ?></td>
              <td><?= $value['banner_name']; ?></td>
              <td><img src="../..<?= $ROOT_URL ?><?= $value['banner_image'] ?>" width="100px" alt=""></td>
              <td>
                <a href="./index.php?act=update_banner&banner_id=<?= $value['banner_id']; ?>"><input class="btn btn-success" type="button" name="sua" value="Sửa" /></a>
              </td>
              <td>
                <a onclick="return confirm(' Bạn có chắc chắn muốn xóa sản phẩm này')" href="./index.php?act=delete_banner&banner_id=<?= $value['banner_id']; ?>"><input class="btn btn-danger" type="button" name="delete" value="Xóa" /></a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </form>
  </div>
</div>


<?php require_once "./footer.php" ?>