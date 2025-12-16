<?php require "./header.php" ?>

<div class="main">
    <div class="main-content dashboard">
        <a href="./index.php?act=view_product" class="mb-4">
            <button class="btn btn-primary">Danh sách sản phẩm</button>
        </a>
        <span class="<?= isset($_COOKIE['notification']) ? "noti-success" : "" ?> "><?= $notification = isset($_COOKIE['notification']) ? $_COOKIE['notification'] : ""; ?></span>
        <div id="showProduct">
            <?php $product_result = select_all_product_admin(); ?>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Mã sản phẩm</th>
                        <th>Màu sắc</th>
                        <th>Chi tiết</th>
                        <th>Thêm mới</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($product_result as $value) : ?>
                        <tr>
                            <td><?= $value['product_name'] ?></td>
                            <td><img src="../..<?= $ROOT_URL . $value['main_image_url'] ?>" alt="" height="100"></td>
                            <td><?= $value['product_code'] ?></td>
                            <td>
                                <?php $color_name_result = select_all_color_name_by_product_id($value['product_id']) ?>
                                <select name="" id="">
                                    <?php foreach ($color_name_result as $color) : ?>
                                        <option value="<?= $color['color_name_id'] ?>"><?= $color['color_name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </td>
                            <td>
                                <a href="./index.php?act=detail_image&product_id=<?= $value['product_id'] ?>">
                                    <button type="button" class="btn btn-info">Xem chi tiết</button>
                                </a>
                            </td>
                            <td>
                                <a href="./index.php?act=add_image&product_id=<?= $value['product_id'] ?>">
                                    <button type="button" class="btn btn-success">Thêm ảnh</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="overlay"></div>
    <?php require "./footer.php" ?>