<?php require "./header.php" ?>
<div class="main">
    <div class="main-content dashboard">
        <a href="/du_an1/admin/view_bill" class="mb-4">
            <button class="btn btn-primary">Danh sách</button>
        </a>
        <span class="<?= isset($_COOKIE['notification']) ? "noti-success" : "" ?> ">
            <?= $notification = isset($_COOKIE['notification']) ? $_COOKIE['notification'] : ""; ?>
        </span>
        <?php
        $order_id = $_GET['order_id'];
        $order_info = select_all_order_product_admin_by_id($order_id); ?>
        <div class="order_detail_container">
            <div class="order_row">
                <?php foreach ($order_info as $key => $value) : ?>
                    <?php $color_result = select_color_name_by_id($value['color_name_id']); ?>
                    <?php $size_result = select_size_by_id($value['size_id']); ?>
                    <div class="order_item" style="display: flex;gap: 24px;border: 1px solid #dedede;padding: 14px; border-radius: 4px;margin-bottom: 12px;">
                        <div class="order_item__img">
                            <img src="../..<?= $ROOT_URL ?><?= $color_result['color_image'] ?>" alt="Ảnh sản phẩm" height="100">
                        </div>
                        <div>
                            <div class="order_item__name" style="font-size: 18px;">
                                <?= $value['product_name']; ?>
                            </div>
                            <div style="display: flex;gap: 16px;align-items: center;margin-bottom: 6px;margin-top: 4px;">
                                <div class="order_item__color" style="color: #696969;font-size: 1.1rem;">
                                    MÀU:
                                    <?= $color_result['color_name']; ?>
                                </div>
                                <div class="order_item__size" style="color: #696969;font-size: 1.1rem;">
                                    SIZE:
                                    <?= $size_result['size_name']; ?>
                                </div>
                            </div>
                            <div class="order_item__quantity" style="font-size:1.1rem">
                                Số lượng:
                                <strong> <?= $value['quantity']; ?></strong>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
                <?php $order_detail_result = select_order_by_id($order_id); ?>
                <div class="order_item__status">
                    <?php $status_name = select_status_by_id($order_detail_result['status_id']); ?>
                    Trạng thái:
                    <span class="status_name" style="font-weight: 600;color: <?= $order_detail_result['status_id'] == 1 || $order_detail_result['status_id'] == 6 ? "#e03033;" : "#26820b;"; ?>" status="<?= $order_detail_result['status_id']; ?>">
                        <?= $status_name['status']; ?>
                    </span>
                </div>
                <div class="order_total__price">
                    Tổng tiền đơn hàng: <strong><?= formatMoney($order_detail_result['total_price']); ?></strong>
                </div>
            </div>
            <?php if($order_detail_result['status_id'] != 4):?>
                <div class="order_status">
                <?php $status_result = select_all_status(); ?>
                <label for="order_status">Trạng thái:</label><br>
                <select id="order_status" style="cursor: pointer;">
                        <?php if($order_detail_result['status_id'] != 3) :?>
                            <option value="1">Chờ xử lý</option>
                            <option value="2">Đã được xử lý</option>
                        <?php endif ?>
                        <option value="3">Đang giao hàng</option>
                        <option value="4">Đã giao hàng</option>
                </select><br>
                <button type="button" id="status_update" order_id="<?= $order_id ?>" class="btn btn-primary my-3">Cập nhật trạng thái</button>
            </div>
            <?php else : ?>
                <a href="./index.php?act=view_bill" class="btn btn-primary my-3">Quay về danh sách</a>
            <?php endif ?>
        </div>
    </div>
</div>

<div class="overlay"></div>
<?php require "./footer.php" ?>