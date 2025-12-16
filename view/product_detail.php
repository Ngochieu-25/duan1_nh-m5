<?php require "./includes/header.php" ?>
<div id="register-modal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span id="close-button" class="close">&times;</span>
    <h2>Đăng ký</h2>
    <?php
    if (isset($_GET['error'])) {
      echo $_GET['error'];
    }
    ?>
    <form action="../../du_an1/view/progess-signup.php" method="POST" id="register-form">
      <div class="form-group">
        <label for="full_name">Full Name*</label>
        <input type="text" name="full_name" id="full_name" plac eholder="Full name" required />
      </div>
      <div class="form-group">
        <label for="username">UserName*</label>
        <input type="text" name="username" id="full_name" placeholder="Username" required />
      </div>
      <div class="form-group">
        <label for="email">Email *</label>
        <input type="email" name="email" id="email" placeholder="Your email" required />
      </div>

      <div class="form-group">
        <label for="password">Password *</label>
        <input type="password" name="password" id="password" placeholder="Enter a password" required />
      </div>
      <div class="form-group">
        <label for="address">Address *</label>
        <input type="text" name="address" id="address" placeholder="Your address" required />
      </div>
      <div class="form-group">
        <label for="phone">Phone *</label>
        <input type="text" name="phone" id="phone" placeholder="Your phone" required />
      </div>

      <button type="submit" class="buttonregister" name="dangky">Đăng ký</button>
    </form>
  </div>
</div>
<div id="quen-modal" class="modal">
  <div class="modal-content">
    <span class="close" id="close_quen">&times;</span>
    <h2>Quên mật khẩu</h2>
    <form id="forgotPasswordForm" method="post" action="index.php?action=quenmk">
      <div class="form-group">
        <label for="email">Email *</label>
        <input type="email" name="email" id="email" placeholder="Your email" required />
      </div>
      <button type="submit" class="buttonregister" name="btnsubmit">Gửi</button>
    </form>
  </div>
</div>
<!-- ĐĂNG NHẬP -->

<div id="my-modal" class="modal1">
  <div class="modal-content">
    <span class="sign-in-close">&times;</span>
    <h2 style="text-align: center">Đăng nhập</h2>
    <form action="../../du_an1/view/progess-login.php" method="POST">
      <div class="form-group">
        <label for="username">Tài khoản:</label>
        <input type="text" id="username" name="username" required />
      </div>
      <div class="form-group">
        <label for="password">Mật khẩu:</label>
        <input type="password" id="password3" name="password" required />
        <a href=""><span class="quenmk">Quên mật khẩu?</span></a>
      </div>
      <br />
      <button type="submit" class="buttonregister" name="login" id="submit-btn">
        Đăng nhập <style></style>
      </button>

      <br />

    </form>
    <p id="message"></p>
  </div>
</div>


<?php require ".$INCLUDES_URL/favorite_product.php" ?>

<?php require ".$INCLUDES_URL/cart_modal.php" ?>

<?php require ".$INCLUDES_URL/delete_cart_confirm.php" ?>

<?php require ".$INCLUDES_URL/loading.php" ?>

<?php require ".$INCLUDES_URL/header_nav.php" ?>
<div class="wrapper">
  <main id="main-content">
    <div class="main-colums">
      <?php if (isset($_GET['action']) && !empty($_GET['product_id'])) : ?>
        <!-- block filter -->
        <div class="container">
          <!-- Chi tiết 1 sản phẩm -->
          <?php

          $product_id = $_GET['product_id'];
          $first_color_name_id = select_first_product_color_by_product_id($product_id);
          $color_name_id = $first_color_name_id['color_name_id'];
          $product_result = select_product_by_id($product_id);
          $category_id = $product_result['category_id'];
          inc_view($product_id);
          ?>

          <ul class="breadcrumbs">
            <li>Trang chủ /</li>
            <li><?= $product_result['product_name'] . " - " . $product_result['product_code'] ?></li>
            <!-- <li id="test2">Click Me</li> -->
          </ul>
          <div class="product-content col-2">
            <!-- Show images -->
            <div id="show_slider" class="product-content-left">
              <?php $image_result = select_image_by_color_name_id_and_product_id($color_name_id, $product_id); ?>
              <div id="main-slider" class="slider-for main-image-slider">
                <?php foreach ($image_result as $key => $value) : ?>
                  <img src="../..<?= $ROOT_URL . $value['image_url'] ?>" alt="Ảnh sản phẩm">
                <?php endforeach ?>
              </div>
              <div id="second-slider" class="slider-nav second-image-slider">
                <?php foreach ($image_result as $key => $value) : ?>
                  <img src="../..<?= $ROOT_URL .  $value['image_url'] ?>" alt="">
                <?php endforeach ?>
              </div>
            </div>
            <!-- end show -->

            <div class="product-content-right">
              <!--Show Product Name -->
              <h1 class="product_detail_name"><?= $product_result['product_name'] . "-" . $product_result['product_code'] ?></h1>
              <!-- End -->
              <!-- format money -->
              <?php
              $locale = 'vi_VN';
              $currency = $product_result['product_price'];
              $discount = $currency - ($currency * $product_result['discount'] / 100);
              $formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);
              $product_vn_price = $formatter->format($currency);
              $discount_price = $formatter->format($discount);
              ?>
              <span class="product_detail_price"><?= $discount_price ?></span>
              <del class="product_detail_price-old"><?= $product_vn_price ?></del>
              <!-- end -->
              <?php $product_color_result = select_product_color($product_result['product_code']);
              $color_name_result = select_color_by_product_id($product_id);
              ?>
              <!-- Box chứa data-id -->
              <div class="data-id-container" color_name_id="<?= $color_name_id ?>"></div>
              <span class="product_detail_choose_color">Chọn màu sắc: <strong id="product_detail_color"><?= $color_name_result['color_name']; ?></strong></span>
              <?php foreach ($product_color_result as $key => $value) : ?>
                <span class="product_detail_image" product_id="<?= $value['product_id']; ?>" color_name_id="<?= $value['color_name_id']; ?>" color-name="<?= $value['color_name']; ?>" style="background-image: url('..<?= $ROOT_URL ?><?= $value['color_image'] ?>');">
                </span>
                <!-- Chỉ active lần phần tử đầu tiên -->
              <?php endforeach ?>
              <!-- box color  -->
              <!-- value="//<?php //$color_name_result['color_name_id'] 
                            ?>" -->
              <!-- <input type="text" class="box-color-name-id" > -->
              <!-- end box -->
              <span class="product_detail_choose_size">Chọn size: <strong id="product_detail_size" style="padding-left: 8px;"></strong></span>
              <div class="product-detail-list-size">
                <!-- <span class="product-detail-size size-empty">m</span> -->
                <?php $select_all_size = select_all_size_by_product_id_and_color_name_id($color_name_id, $_GET['product_id']);
                ?>
                <?php foreach ($select_all_size as $key => $size) : ?>
                  <?php $size_result = select_size_by_id($size['size_id']); ?>
                  <span class="product-detail-size submitSize" product_id="<?= $_GET['product_id']; ?>" size-id="<?= $size['size_id'] ?>"><?= $size_result['size_name'] ?></span>
                <?php endforeach ?>
                <!-- <span class="product-detail-size">XL</span> -->
              </div>
              <!-- box size -->
              <input type="hidden" class="box-size-id">
              <!-- end box size -->
              <!-- Hiện thị số lượng sản phẩm đang chọn -->
              <span class="product_detail_choose_quantity">Bạn có thể chỉnh số lượng sản phẩm trong giỏ hàng</span>
          
              <div class="product-detail-toCart-field">
                <!-- box số lượng sản phẩm còn lại -->
                <input type="hidden" disabled value="2" id="product_detail_contain_quantity">
                <!-- end -->
                <div class="product-detail-inc">
                  <i class="fa-solid fa-minus product-detail-inc-minus" id="product-detail-inc-minus"></i>
                  <input type="number" disabled value="1" id="product-detail-inc-quantity" class="product-detail-inc-quantity" />
                  <i class="fa-solid fa-plus product-detail-inc-plus" id="product-detail-inc-plus " class="cartModal-inc-plus"></i>
                </div>
                <button type="button" id="addToCart" class="product-detail-toCart">Mua Ngay</button>
                <i class="fa-regular fa-heart product-detail-favorite"></i>
              </div>
              <span id="quantity_product"></span>
                <div style="margin-top: 25px; display: flex; flex-wrap: wrap; justify-content: center; align-items: center;  padding: 55px 25px; background-color: #f7f7f7;">
                  <div style="display: flex; width: 221px; height: 82px; align-items: center; gap: 10px;">
                    <img src="https://routine.vn/static/version1710843685/frontend/Magenest/routine/vi_VN/images/ghn.png" alt="">
                    <div style="display: flex; flex-direction: column">
                      <span style="font-size: 15px;">Giao hàng nhanh</span>
                      <span style="font-size: 12px; color: #737373;">Từ 2 - 5 ngày</span>
                    </div>
                  </div>
                  <div style="display: flex;  width: 221px; height: 82px; align-items: center; gap: 10px;">
                    <img src="https://routine.vn/static/version1710843685/frontend/Magenest/routine/vi_VN/images/free.png" alt="">
                    <div style="display: flex; flex-direction: column">
                      <span style="font-size: 15px;">Miễn phí vận chuyển</span>
                      <span style="font-size: 12px; color: #737373;">Đơn hàng từ 399K</span>
                    </div>
                  </div>
                  <div style="display: flex;  width: 221px; height: 82px; align-items: center; gap: 15px;">
                    <img src="https://routine.vn/static/version1710843685/frontend/Magenest/routine/vi_VN/images/pay.png" alt="">
                    <div style="display: flex; flex-direction: column">
                      <span style="font-size: 15px;">Thanh toán dễ dàng</span>
                      <span style="font-size: 12px; color: #737373;">Với ví điện tử momo</span>
                    </div>
                  </div>
                      <div style="display: flex;  width: 221px; height: 82px; align-items: center; gap: 15px;">
                    <img src="https://routine.vn/static/version1710843685/frontend/Magenest/routine/vi_VN/images/hotline.png" width="45" alt="">
                    <div style="display: flex; flex-direction: column">
                      <span style="font-size: 15px;">Hotline hỗ trợ</span>
                      <span style="font-size: 12px; color: #737373;">0383144530</span>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <h2>Bình Luận</h2>
          <div class="product-content col-2" style="width: 100%; height: 320px; overflow-y: auto;">
            <div class="box-content2  binhluan" style="width: 50%; font-size: 16px;">
              <?php
              $product_id = $_REQUEST['product_id'];
              $dsbl = loadall_comment($product_id);
              foreach ($dsbl as $bl) {
                extract($bl);
                $username_comment_result = getUserName($id);
                extract($username_comment_result);
              ?>
                <div class="main_noidung_binhluan">
                  <div class="anh_user" style="width: 120px; height: 100px;">
                    <img src="../../du_an1/asset/images/facebook-cap-nhat-avatar-doi-voi-tai-khoan-khong-su-dung-anh-dai-dien-e4abd14d.jpg" alt="" width="100%" style="border-radius: 15px;">
                  </div>
                  <div class="noidung">
                    <div class="noidung_name">
                      <h4><?php echo $username; ?></h4>
                      <h5 style="padding: 0px 50px; font-weight: 300;"><?php echo $content; ?></h5>
                      <h4><?php echo $comment_time; ?></h4>
                    </div>
                    <?php if (isset($_SESSION['username'])) { ?>
                      <a href="../du_an1/index.php?action=product_detail&product_id=<?= $product_id ?>&comment_id=<?= $comment_id ?>&comment_manager=update_bl">Update</a>
                      <a href="../du_an1/index.php?action=delete_bl&product_id=<?= $product_id ?>&comment_id=<?= $comment_id ?>">Delete</a>
                    <?php } ?>
                    <?php if (isset($_GET['comment_manager']) && $_GET['comment_manager'] == 'update_bl' && $_GET['comment_id'] == $comment_id) : ?>
                      <form action="./du_an1/controllers/update_bl.php" method="post" class="update_comment">
                        <input type="hidden" value="<?= $_GET['comment_id'] ?>" name="comment_id">
                        <input type="hidden" value="<?= $product_id ?>" name="product_id">
                        <textarea id="" cols="10" name="comment_content" rows="4" placeholder="Viết gì đó...."></textarea>
                      </form>
                    <?php endif ?>
                  </div>
                </div>
              <?php
              }
              ?>
            </div>
            <div class="btn_comment" style="width: 50%; margin-left: 20px;">
              <?php if (isset($_SESSION['username'])) {
              ?>
                <div class="wrapper">
                  <h3 style="font-size: 20px;">ĐÁNH GIÁ SẢN PHẨM</h3>
                  <form action="../../du_an1/controllers/add_bl.php" method="post">
                    <input type="hidden" name="product_id" value="<?= $product_id ?>">
                    <textarea name="content" cols="30" rows="5" placeholder="Viết đánh giá..."></textarea>
                    <div class="btn-group">
                      <button type="submit" class="btn submit" name="guibinhluan">Submit</button>
                      <button class="btn cancel">Cancel</button>
                    </div>
                  </form>
                </div>
              <?php
              } else { ?>
                <strong>
                  <p class="thongbao" style="display: flex; justify-content: center; font-size: 16px; background-color: #e3b386; padding: 10px; color: white; width: 300px;">
                    Vui lòng đăng nhập để bình luận</p>
                </strong>
              <?php }
              ?>
            </div>
          </div>

          <div class="product-suggest">
            <h3 class="product-suggest-title" style="color: red;">
              SẢN PHẨM ROUTINE GỢI Ý RIÊNG CHO BẠN
            </h3>
            <div class="my-slickSilder">
              <?php $product_result = select_home_top10_product(true, $category_id); ?>
              <?php foreach ($product_result as $key => $value) : ?>
                <!-- start item -->
                <div class="product-item" id="product-list">
                  <a href="./index.php?action=product_detail&product_id=<?= $value['product_id'] ?>" class="product-image-item">
                    <img src="../<?= $ROOT_URL ?><?= $value['main_image_url'] ?>" alt="" class="product-image" />
                  </a>
                  <div class="product-title">
                    <a href="./index.php?action=product_detail&product_id=<?= $value['product_id'] ?>" class="product-name">
                      <?= $value['product_name'] ?>
                    </a>
                  </div>
                  <div class="product-price">
                    <?php
                    $locale = 'vi_VN';
                    $currency = $value['product_price'];
                    $discount = $currency - ($currency * $value['discount'] / 100);
                    $formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);
                    $product_vn_price = $formatter->format($currency);
                    $discount_price = $formatter->format($discount);
                    ?>
                    <span class="product-newPrice"><?= $discount_price ?></span>
                    <span class="product-oldPrice"><?= $product_vn_price ?></span>
                    <span class="product-discount"> -<?= $value['discount']; ?>% </span>
                  </div>
                  <?php $product_color_result = select_product_color($value['product_code']); ?>

                  <div class="product-color-list">
                    <?php foreach ($product_color_result as $value) : ?>
                      <a href="#" class="product-color">
                        <div class="product-color-child">
                          <img src="../<?= $ROOT_URL ?><?= $value['color_image'] ?>" alt="" class="product-color-img" />
                        </div>
                      </a>
                    <?php endforeach ?>
                  </div>
                </div>
              <?php endforeach ?>
            </div>
          </div>
        <?php endif ?>
        <?php require "./includes/footer.php" ?>