<?php require "./header.php" ?>

<div class="main">
    <div class="main-content dashboard">
        <a href="./index.php?act=view_image" class="mb-4">
            <button class="btn btn-primary">Danh sách</button>
        </a>
        <span class="<?= isset($_COOKIE['notification']) ? "noti-success" : "" ?> "><?= $notification = isset($_COOKIE['notification']) ? $_COOKIE['notification'] : ""; ?></span>
        <div id="showProduct">
            <?php
            $product_id = $_GET['product_id'];
            $product_result = select_product_by_id($product_id); ?>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Mã sản phẩm</th>
                        <th>Màu sắc</th>
                        <th>Thêm ảnh</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="..<?= $ADMIN_URL . $PRODUCT_URL; ?>/progress_add_image.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="product_id" value="<?= $product_id ?>">
                        <tr>
                            <td><?= $product_result['product_name'] ?></td>
                            <td><img src="../..<?= $ROOT_URL . $product_result['main_image_url'] ?>" alt="" height="100"></td>
                            <td><?= $product_result['product_code'] ?></td>
                            <td>
                                <?php $color_name_result = select_all_color_name_by_product_id($product_result['product_id']) ?>
                                <select name="color_name" id="">
                                    <?php foreach ($color_name_result as $color) : ?>
                                        <option value="<?= $color['color_name_id'] ?>"><?= $color['color_name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </td>
                            <td>
                                <input type="file" name="product_image[]" multiple>
                            </td>
                            <td><button type="submit" class="btn btn-success">Tạo</button></td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>
    </div>

    <div class="overlay"></div>
    <?php require "./footer.php" ?>