<?php require "./header.php" ?>


<!--   Phần content -->
<div class="main">
  <div class="main-content dashboard">
    <a href="./index.php?act=add_product" class="mb-4">
      <button class="btn btn-primary">Thêm</button>
    </a>
    <span class="<?= isset($_COOKIE['notification']) ? "noti-success" : "" ?> ">
      <?= $notification = isset($_COOKIE['notification']) ? $_COOKIE['notification'] : ""; ?>
    </span>
    <form method="GET" action="index.php" class="d-flex mb-3" role="search">
      <div class="my-2">
        <input type="hidden" name="act" value="view_product">
        <input
          class="form-control me-2"
          type="search"
          placeholder="Tìm kiếm sản phẩm..."
          name="q"
          value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
      </div>
    </form>
    <form action="./index.php" method="post">
      <table id="example" class="table table-bordered table-hover" style="width:100%">
        <thead>
          <!-- <tr class="table-primary"> -->
          <tr>
            <th>Tên sản phẩm</th>
            <th>Ảnh</th>
            <th>Giá</th>
            <th>Giảm giá</th>
            <th>Số lượng</th>
            <!-- <th>Mô tả</th> -->
            <th>Kích cỡ</th>
            <th>Color Name</th>
            <!-- <th>Color Type</th> -->
            <th>Sửa</th>
          </tr>
        </thead>
        <tbody>
          <?php $product_result = select_all_product_admin(empty($_GET['q']) ? "" : $_GET['q']); ?>
          <?php foreach ($product_result as $value) : ?>
            <!-- <tr class="table-success"> -->
            <tr>
              <td><?= $value['product_name']; ?></td>
              <td><img src="../..<?= $ROOT_URL ?><?= $value['main_image_url'] ?>" width="100px" alt=""></td>
              <td><?= formatMoney($value['product_price']); ?></td>
              <td><?= $value['discount']; ?>%</td>
              <td>
                <?php $quantity_result = select_quantities_by_product_id($value['product_id']);
                $total_quantity = 0;
                $product_id = $value['product_id'];
                $size_unduplicate_result = select_size_unduplicate($product_id);
                ?>
                <?php foreach ($quantity_result as $quantity) {
                  $total_quantity += $quantity['quantity'];
                } ?>
                <?= $total_quantity; ?>
              </td>
              <td>
                <?php foreach ($size_unduplicate_result as $quantity) : ?>
                  <?php $size_result = select_one_size_by_size_id($quantity['size_id']); ?>
                  <span><?= $size_result['size_name']; ?>,</span>
                <?php endforeach ?>
              </td>
              <td>
                <?php $color_result = select_all_color_name_by_product_id($value['product_id']); ?>
                <?php foreach ($color_result as $color) : ?>
                  <span><?= $color['color_name']; ?>,</span>
                <?php endforeach ?>
              </td>
              <td>
                <a href="./index.php?act=update_product&product_id=<?= $value['product_id']; ?>"><input class="btn btn-success" type="button" name="sua" value="Sửa" /></a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </form>
    <script>
      $('#example').DataTable();
    </script>
  </div>
</div>

<div class="overlay"></div>
<?php require "./footer.php" ?>