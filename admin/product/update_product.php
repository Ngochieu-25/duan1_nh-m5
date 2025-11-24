<?php require "./header.php" ?>

<div class="main">
    <div class="main-content dashboard">
        <span class="<?= isset($_COOKIE['notification']) ? "noti-success" : "" ?> ">
            <?= $notification = isset($_COOKIE['notification']) ? $_COOKIE['notification'] : ""; ?>
        </span>
        <!-- Select product by id -->
        <?php
        if (isset($_GET['product_id'])) {
            $product_id = $_GET['product_id'];
            $product_result = select_product_by_id($product_id);

        ?>
            <form action="..<?= $ADMIN_URL . $PRODUCT_URL; ?>/progess_update_product.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="product_id" value="<?= $product_id; ?>">
                <div class="form-group mb-3">
                    <label for="product_name">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="product_name" value="<?= $product_result['product_name'] ?>" id="product_name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="product_code">Mã sản phẩm</label>
                    <input type="text" class="form-control" name="product_code" value="<?= $product_result['product_code'] ?>" id="product_code" required>
                </div>
                <div class="form-group mb-3">
                    <label for="product_price">Giá sản phẩm</label>
                    <input type="number" class="form-control" name="product_price" value="<?= $product_result['product_price'] ?>" id="product_price" required>
                </div>
                <div class="form-group mb-3">
                    <label for="product_discount">Giảm giá</label>
                    <input type="number" class="form-control" name="product_discount" value="<?= $product_result['discount'] ?>" min="0" max="99" id="product_discount" required>
                </div>

                <!-- <div class="form-group mb-3"> -->
                <!-- <label>
                        Ảnh màu cũ
                    </label>
                    <div class="mb-3">
                        <img src="" width="100px" alt="">
                    </div> -->
                <!-- <label for="product_color_image">Ảnh màu</label>
                    <input type="file" class="form-control" name="product_color_image" id="product_color_image">
                    <input type="hidden" name="old_color_image"> -->
                <!-- </div> -->

                <?php $quantities_result = select_quantities_by_product_id($product_id); ?>
                <div id="container-color">
                    <?php foreach ($quantities_result as $quantity) : ?>
                        <div style="display: inline-block;border: 1px solid #dedede;padding: 12px;margin:12px;">
                            <?php $color_name_result = select_all_color_name_by_id($quantity['color_name_id']); ?>
                            <div>
                                <?php foreach ($color_name_result as $color_name) : ?>
                                    <div><img src="../..<?= $ROOT_URL ?><?= $color_name['color_image'] ?>" alt="Ảnh màu" height="70"></div>
                                    <span><?= $color_name['color_name'] ?></span>
                                <?php endforeach ?>
                            </div>
                            <?php $each_size = select_one_size_by_size_id($quantity['size_id']) ?>
                            <span>Size <?= $each_size['size_name'] ?></span>
                            <span>Số lượng <?= $quantity['quantity']; ?></span>
                            <span class="attr-container" hidden quantity-id="<?= $quantity['quantity_id']; ?>" product-id="<?= $product_id; ?>" size-id="<?= $quantity['size_id'];  ?>" color-name-id="<?= $quantity['color_name_id']; ?>" data-quantity="<?= $quantity['quantity'] ?>"></span>
                            <i class="fa-regular fa-pen-to-square update-color-and-size" style="font-size: 1.6rem;cursor: pointer;color: #000000;padding:6px;"></i>
                        </div>
                        <!-- <button type="button" class="btn btn-primary update-color-and-size">Sửa</button> -->
                    <?php endforeach ?>
                </div>
                <div id="show_color_and_size_update" class="color-update-hidden" style="display:none">
                    <!-- input lưu color name id  -->
                    <input type="hidden" id="color_name_id">
                    <div class="form-group mb-3">
                        <label for="product_color">Loại màu</label>
                        <?php $color_result = select_all_color(); ?>
                        <select class="form-control" id="color_type_update">
                            <option value="0" id="color_name_id_update">Lựa chọn màu</option>
                            <?php foreach ($color_result as $value) : ?>
                                <option value="<?= $value['color_type_id']; ?>"><?= $value['color_type_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="product_color_name">Tên màu</label>
                        <input type="text" class="form-control" id="color_name_update">
                        <label>
                            Ảnh màu cũ
                        </label>
                        <div class="mb-3">
                            <img src="" width="100px" alt="" id="old_image">
                        </div>
                        <label for="product_color_image">Ảnh màu mới</label>
                        <input type="file" class="form-control" id="new_color_image">
                        <input type="hidden" id="old_image_path">
                    </div>
                    <div class="form-group mb-3">
                        <label for="product_size">Kích cỡ</label>
                        <?php $size_result = select_all_size(); ?>
                        <select class="form-control" id="size">
                            <option value="0" id="size_id_update">Lựa chọn Size</option>
                            <?php foreach ($size_result as $value) : ?>
                                <option value="<?= $value['size_id']; ?>"><?= $value['size_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="product_quantity">Số lượng</label>
                        <input type="number" class="form-control" id="new_quantity">
                    </div>
                    <button type="button" id="updateProductCSQ" class="btn btn-success">Cập nhật</button>
                    <button type="button" id="QuantityRetype" class="btn btn-warning">Nhập lại</button>
                </div>
                <div class="form-group mb-3">
                    <label>
                        Ảnh chính cũ
                    </label>
                    <div class="mb-3">
                        <img src="../..<?= $ROOT_URL ?><?= $product_result['main_image_url'] ?>" width="100px" alt="">
                    </div>
                    <label for="product_main_image">Ảnh chính</label>
                    <input type="file" class="form-control" name="product_main_image" id="product_main_image" multiple>
                    <input type="hidden" name="old_main_image" value="<?= $product_result['main_image_url'] ?>">
                </div>
                <div class="form-group mb-3">
                    <label>
                        Ảnh phụ cũ
                    </label>
                    <div class="mb-3">
                        <img src="../..<?= $ROOT_URL ?><?= $product_result['hover_main_image_url'] ?>" width="100px" alt="">
                    </div>
                    <label for="product_hover_main_image">Ảnh phụ</label>
                    <input type="file" class="form-control" name="product_hover_main_image" id="product_hover_main_image" multiple>
                    <input type="hidden" name="old_second_image" value="<?= $product_result['hover_main_image_url'] ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="product_desc">Mô tả</label>
                    <textarea type="text" class="form-control" rows="6" name="product_desc" id="product_desc" required><?= $product_result['product_desc']; ?></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="product_cat_id">Loại sản phẩm</label>
                    <!-- Select product caregory id -->
                    <?php $categories_result = listCategory();
                    $categories_by_id = select_one_category($product_result['category_id']);
                    ?>
                    <select name="product_cat_id" id="product_cat_id" class="form-control">
                        <option value="<?= $product_result['category_id'] ?>"><?= $categories_by_id['name_category'] ?></option>
                        <?php foreach ($categories_result as $value) :
                            if ($value['id_category'] == $product_result['category_id']) continue
                        ?>
                            <option value="<?= $value['id_category'] ?>"><?= $value['name_category'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="mt-3">
                    <button type="submit" name='addProduct' class="btn btn-success">Sửa</button>
                    <button type="reset" class="btn btn-warning">Nhập lại</button>
                </div>
            </form>
        <?php } else { ?>
            <?= "Không có id" ?>
        <?php } ?>
    </div>
</div>

<div class="overlay"></div>
<?php require "./footer.php" ?>