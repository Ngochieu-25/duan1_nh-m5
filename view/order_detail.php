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
<!--  favoriteProduct-->
<?php require ".$INCLUDES_URL/favorite_product.php" ?>
<!-- end -->
<?php require ".$INCLUDES_URL/cart_modal.php" ?>
<?php require ".$INCLUDES_URL/delete_cart_confirm.php" ?>
<?php require ".$INCLUDES_URL/header_nav.php" ?>

<ul class="breadcrumbs">
  <li>Trang chủ /</li>
  <li>Giỏ hàng</li>
</ul>
<section class="checkout spad">
  <div class="container">
    <h4 class="oder-detail-title">
      <i class="fa-solid fa-cart-shopping" style="margin-right:16px"></i>
      GIỎ HÀNG
    </h4>
    <div class="checkout__form">
      <form action="" method="post">
        <div class="row-col-2 order">
          <div class="order-info-left">
            <div class="show-cart-products">
              <?php //unset($_SESSION['cart']);
              $count_cart = 0;
              $total_price = 0;
              $total_new_price = 0;
              $cart_quantity = 0;
              $locale = 'vi_VN';
              $formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);
              //unset($_SESSION['count_cart']);
              ?>
              <?php if (isset($_SESSION['cart'])) :  //var_dump($_SESSION['cart']);
              ?>
                <?php foreach ($_SESSION['cart'] as $key => $value) : ?>
                  <?php $quantity_result = select_quantity_by_product_id_color_name_id_and_size_id($value['sizeId'], $value['colorNameId'], $value['product_id']);
                  $cart_quantity += $value['quantity'] ?>
                  <div class="favoriteProduct-info order">
                    <a href="/du_an1/product_detail&product_id=<?= $value['product_id'] ?>" class="favoriteProduct-img">
                      <div class="favoriteProduct-img-first">
                        <img src="..<?= $ROOT_URL . $value['main_image_url'] ?>" alt="" />
                      </div>
                    </a>
                    <div class="favoriteProduct-details">
                      <a href="/du_an1/product_detail&product_id=<?= $value['product_id'] ?>" class="favoriteProduct-link"><?= $value['product_name'] ?></a>
                      <div class="favoriteProduct-option">
                        <div class="favoriteProduct-choose">
                          <div class="favoriteProduct-choose-color cart">
                            MÀU:
                            <span>
                              <?= $value['color_name'] ?>
                            </span>
                          </div>
                          <div class="favoriteProduct-choose-size">
                            SIZE:
                            <?php $get_size = select_size_by_id($value['sizeId']); ?>
                            <span><?= $get_size['size_name'] ?></span>
                          </div>
                        </div>
                        <div class="favoriteProduct-inc">
                          <span id="cart_product_id" color_name_id="<?= $value['colorNameId'] ?>" size_id="<?= $value['sizeId'] ?>" product_id="<?= $value['product_id'] ?>"></span>
                          <i class="fa-solid fa-minus cartModal-inc-minus" id="cartModal-inc-minus"></i>
                          <input type="number" disabled value="<?= $value['quantity'] ?>" class="favoriteProduct-inc-quantity" idcz="<?= "i" . $value['product_id'] . "C" . $value['colorNameId'] . "Z" . $value['sizeId'] ?>" />
                          <i class="fa-solid fa-plus cartModal-inc-plus" id="cartModal-inc-plus"></i>
                          <input type="hidden" value="<?= $quantity_result['quantity'] ?>" class="cart_product_quantity">
                        </div>
                        <?php
                        $currency = $value['product_price'];
                        $total_currency = $value['product_price'] * $value['quantity'];
                        $discount = $currency - ($currency * $value['discount'] / 100);
                        $total_discount = $total_currency - ($total_currency * $value['discount'] / 100);
                        $product_vn_price = $formatter->format($currency);
                        $discount_price = $formatter->format($discount);
                        $total_price += $total_currency;
                        $total_new_price += $total_discount;
                        ?>
                        <span class="favoriteProduct-price"><?= $discount_price ?></span>
                        <del class="favoriteProduct-price-old"><?= $product_vn_price ?></del>
                      </div>
                    </div>
                    <div class="delete-from-cart favoriteProduct-close" idcz="<?= $key ?>">
                      <i class="fa-solid fa-xmark"></i>
                    </div>
                  </div>
                <?php endforeach ?>
              <?php endif ?>
            </div>
            <button type="button" id="auto__fill__btn" <?= !isset($_SESSION['username']) ? 'hidden' : ''; ?>>Tự động điền</button>
            <input type="hidden" id="customer_id" value="<?= isset($_SESSION['username']) ? $_SESSION['username']['id'] : '' ?>">
            <div class="row-col-2 order-info">
              <div class="checkout__input">
                <div class="checkout__tittle">
                  <span>Họ Tên</span> <span>*</span>
                </div>
                <input type="text" id="customerFirstAndLastName">
                <span class="order-notifi_name"></span>
              </div>
              <div class="checkout__input">
                <div class="checkout__tittle">
                  <span>Địa chỉ</span> <span>*</span>
                </div>
                <input type="text" class="checkout__input__add" id="customerAddress">
                <span class="order-notifi_address"></span>
              </div>
              <div class="checkout__input">
                <div class="checkout__tittle">
                  <span>Số điện thoại</span> <span>*</span>
                </div>
                <input type="number" id="customerNumberPhone">
                <span class="order-notifi_phone_number"></span>

              </div>
              <div class="checkout__input">
                <div class="checkout__tittle">
                  <span>Email</span><span>*</span>
                </div>
                <input type="email" id="customerEmail">
                <span class="order-notifi_email"></span>
              </div>
            </div>
            <div class="checkout__input">
              <div class="checkout__tittle">
                <span>Ghi chú</span><span>*</span>
              </div>
              <textarea name="" id="customerNote" cols="30" rows="8" placeholder="Ghi chú về đơn đặt hàng của bạn" style="width:100%;resize: none;border:1px solid  #ebebeb"></textarea>
            </div>
          </div>
          <div class="order-bill">
            <div class="checkout__order">
              <div class="checkout__order__products">
                <h4 class="checkout__oder__title">TẠM TÍNH</h4>
                <div class="checkout__oder__quantity">
                  <span>Số lượng</span>
                  <span class="checkout__oder__quantity_value"><?= $cart_quantity ?></span>
                </div>
                <div class="checkout__order__price">
                  <?php $total_new_price = $formatter->format($total_new_price); ?>
                  <span>Tạm tính</span>
                  <span class="checkout__order__provisional__rice__value"><?= $total_new_price ?></span>
                </div>
                <div class="checkout__order__list">
                  <span>Phí vận chuyển:</span>
                  <span><?= isset($_SESSION['username']) ? 0 : formatMoney(10000) ?></span>
                </div>
                <div class="checkout__order__total__price">
                  <span>Tổng cộng</span>
                  <span class="checkout__order__total__price_value total-price">
                    <?= $total_new_price ?>
                  </span>
                </div>
              </div>
              <div class="payment-methods">
                <div class="payment_method_title">
                  <svg class="payment_method_title_icon" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.088 13.8568C17.9418 13.8568 17.8016 13.932 17.6982 14.066C17.5948 14.2 17.5367 14.3816 17.5367 14.5711V19.5712H2.10245V10.9996H8.16592C8.31212 10.9996 8.45232 10.9243 8.5557 10.7904C8.65907 10.6564 8.71715 10.4747 8.71715 10.2853C8.71715 10.0958 8.65907 9.91414 8.5557 9.78019C8.45232 9.64623 8.31212 9.57097 8.16592 9.57097H2.10245V6.71376H8.16592C8.31212 6.71376 8.45232 6.6385 8.5557 6.50455C8.65907 6.37059 8.71715 6.1889 8.71715 5.99946C8.71715 5.81001 8.65907 5.62833 8.5557 5.49437C8.45232 5.36041 8.31212 5.28516 8.16592 5.28516H2.10245C1.81006 5.28516 1.52965 5.43567 1.3229 5.70359C1.11615 5.9715 1 6.33487 1 6.71376L1 19.5712C1 19.9501 1.11615 20.3135 1.3229 20.5814C1.52965 20.8493 1.81006 20.9998 2.10245 20.9998H17.5367C17.8291 20.9998 18.1095 20.8493 18.3163 20.5814C18.523 20.3135 18.6392 19.9501 18.6392 19.5712V14.5711C18.6392 14.3816 18.5811 14.2 18.4777 14.066C18.3744 13.932 18.2342 13.8568 18.088 13.8568Z" fill="#464646" stroke="#464646" stroke-width="0.5"></path>
                    <path d="M5.9612 13.8574H3.7563C3.61011 13.8574 3.4699 13.9327 3.36653 14.0666C3.26315 14.2006 3.20508 14.3823 3.20508 14.5717C3.20508 14.7612 3.26315 14.9429 3.36653 15.0768C3.4699 15.2108 3.61011 15.286 3.7563 15.286H5.9612C6.1074 15.286 6.2476 15.2108 6.35098 15.0768C6.45435 14.9429 6.51243 14.7612 6.51243 14.5717C6.51243 14.3823 6.45435 14.2006 6.35098 14.0666C6.2476 13.9327 6.1074 13.8574 5.9612 13.8574Z" fill="#464646" stroke="#464646" stroke-width="0.5"></path>
                    <path d="M22.5832 3.19983L17.7707 1.05693C17.6847 1.01935 17.5924 1 17.4991 1C17.4059 1 17.3135 1.01935 17.2276 1.05693L12.4151 3.19983C12.2916 3.25519 12.1865 3.34695 12.1127 3.46376C12.0389 3.58056 11.9998 3.71728 12 3.85699V6.7142C12 10.6429 13.3982 12.9411 17.1563 15.1912C17.2605 15.2534 17.3785 15.2861 17.4987 15.2861C17.6189 15.2861 17.737 15.2534 17.8412 15.1912C21.6018 12.9469 23 10.65 23 6.7142V3.85699C23.0001 3.71708 22.9607 3.58022 22.8866 3.46339C22.8125 3.34657 22.707 3.25492 22.5832 3.19983ZM21.625 6.7142C21.625 10.0125 20.5744 11.8286 17.5 13.7429C14.4256 11.8232 13.375 10.0085 13.375 6.7142V4.32843L17.5 2.49089L21.625 4.32843V6.7142Z" fill="#464646" stroke="#464646" stroke-width="0.5"></path>
                    <path d="M16.2271 5.44091C16.1125 5.32367 15.9669 5.26964 15.8219 5.29053C15.6768 5.31142 15.5439 5.40555 15.452 5.55252L13.719 8.36106L13.0331 7.03246C12.9941 6.95117 12.9429 6.88086 12.8826 6.8257C12.8222 6.77055 12.7539 6.73167 12.6818 6.71138C12.6096 6.69109 12.535 6.6898 12.4624 6.70759C12.3899 6.72538 12.3208 6.76188 12.2593 6.81493C12.1979 6.86799 12.1452 6.9365 12.1046 7.01642C12.064 7.09633 12.0361 7.18601 12.0228 7.28014C12.0094 7.37426 12.0108 7.4709 12.0268 7.56433C12.0428 7.65776 12.0731 7.74606 12.116 7.824L13.2185 9.9669C13.2669 10.0605 13.3315 10.1381 13.4073 10.1935C13.483 10.2489 13.5677 10.2804 13.6546 10.2857H13.6777C13.7604 10.2858 13.8422 10.2618 13.9168 10.2154C13.9914 10.169 14.057 10.1015 14.1087 10.0178L16.3136 6.44629C16.359 6.37297 16.3927 6.28877 16.4129 6.19852C16.4331 6.10827 16.4394 6.01374 16.4314 5.92034C16.4233 5.82695 16.4012 5.73652 16.3661 5.65425C16.3311 5.57198 16.2838 5.49948 16.2271 5.44091Z" fill="#464646" stroke="#464646" stroke-width="0.5"></path>
                  </svg>
                  <h4 class="checkout__order__title">
                    PHƯƠNG THỨC THANH TOÁN
                  </h4>
                </div>

                <div class="form-check payment-check">
                  <input class="form-check-input" type="radio" value="1" name="payment" id="flexRadioDefault1" checked>
                  <label class="form-check-label flexRadioDefault" for="flexRadioDefault1">
                    Thanh toán khi nhận hàng
                  </label>
                </div>
                <!-- <div class="form-check payment-check">
                  <input class="form-check-input" type="radio" value="2" name="pttt" id="flexRadioDefault2">
                  <label class="form-check-label flexRadioDefault" for="flexRadioDefault2">
                    Thanh toán bằng chuyển khoản
                  </label>
                </div> -->
                
              </div>
              <?php if (isset($_SESSION['cart'])) : ?>
                <button type="button" class="site-btn" id="btn-pay">Thanh toán <span class="btn-pay"><?= $total_new_price ?></span></button>
              <?php endif ?>
            </div>
          </div>
        </div>
    </div>
  </div>
  </form>
  </div>
  </div>
</section>
<?php require "./includes/footer.php" ?>