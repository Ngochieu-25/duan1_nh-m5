<?php require "./header.php" ?>

<div class="main">
    <div class="main-content dashboard">
        <a href="./index.php?act=view_product" class="mb-4">
            <button class="btn btn-primary">Danh sách sản phẩm</button>
        </a>
        <span class="<?= isset($_COOKIE['notification']) ? "noti-success" : "" ?> "><?= $notification = isset($_COOKIE['notification']) ? $_COOKIE['notification'] : ""; ?></span>
        <div id="showProduct">
            <?php $product_result = select_all_product_admin(); ?>
            <?php $product_id = $_GET['product_id']; ?>
            
            <div id="show_detail_image">
                <!-- style="display: flex;justify-content: space-between;gap: 16px;flex-wrap: wrap;" -->
                <?php
                $image_result = select_all_image_by_id($product_id);
                $product_color = select_product_color_by_product_id($product_id);
                ?>
                <?php foreach ($product_color as $key => $color) : ?>
                    <!-- ;flex-basis: 23.33334%;display: flex;justify-content: space-around;align-items: center; -->
                    <?php $color_name_result = select_images_by_color_name_id($color['color_name_id']); ?>
                    <?php if (empty($color_name_result)) continue ?>
                    <div>
                        <?php foreach ($color_name_result as $each) : ?>
                            <div style="display:inline-block ;border: 1px solid #dedede;padding: 8px;border-radius: 4px">
                                <img src="../..<?= $ROOT_URL . $each['image_url'] ?>" alt="" product-id="<?= $product_id ?>" image-id="<?= $each['image_id'] ?>" height="70">
                            </div>
                        <?php endforeach ?>
                        <i class="fa-solid fa-pen update-image" style="color: #000000;font-size: 1.6rem;padding: 6px;cursor: pointer;user-select:none;"></i>
                        <input type="hidden" value="<?= $color['color_name_id']; ?>" delete-product-id="<?= $product_id ?>">
                        <i class="fa-solid fa-xmark delete-image" onclick="return confirm('Bạn chắc chứ!')" style="color: #000000;font-size: 1.8rem;padding: 6px;cursor: pointer;user-select:none;"></i>
                    </div>
                <?php endforeach ?>
            </div>
            <form action="..<?= $ADMIN_URL . $PRODUCT_URL; ?>/update_detail_image.php" method="POST" enctype="multipart/form-data" id="update_image" style="visibility: hidden;margin-top:16px;">
                <input type="hidden" name="product_id" value="<?= $product_id ?>">
                <?php $color_name_result = select_all_color_name_by_product_id($value['product_id']) ?>
                <select name="update_color_name" id="">
                    <?php foreach ($color_name_result as $color) : ?>
                        <option value="<?= $color['color_name_id'] ?>"><?= $color['color_name'] ?></option>
                    <?php endforeach ?>
                </select>
                <input type="file" name="product_detail_image[]" multiple>
                <button type="submit" onclick="return confirm('Bạn chắc chứ!')" class="btn btn-success">Sửa</button>
            </form>
        </div>
    </div>

    <div class="overlay"></div>
    <?php require "./footer.php" ?>