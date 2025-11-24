
<?php require "./includes/header-cart.php" ?>
<div id="register-modal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <span id="close-button" class="close">&times;</span>
      <h2>Đăng ký</h2>
      <?php 
          if(isset($_GET['error'])){
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
  <!-- Nav -->
  <div></div>
      <!-- Nav -->
      <!-- end sign-up -->
      <!--  favoriteProduct-->
      <?php require "./includes/favorite_product.php" ?>
      <!-- end -->
      <!-- Start Cart -->
      <?php require "./includes/cart_modal.php" ?>
      <!-- sign in -->
      
      <!-- Nav -->
      <!-- end sign in -->

      <?php require "./includes/header_nav.php" ?> 
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Sản Phẩm</th>
                                    <th>Giá Tiền</th>
                                    <th>Số Lượng</th>
                                    <th>Thành Tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="../../du_an1/asset/images/ao-thun-nam-10s23tss003c_black_1__1_1.jpg" alt="" width="100px">
                                        <h5>Vegetable’s Package</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        100.000 Đ
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="number" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        100.000 Đ
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="icon_close"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="../../du_an1/asset/images/ao-thun-nam-10s23tss002c_black_beauty_4__4_1.jpg" alt="" width="100px">
                                        <h5>Fresh Garden Vegetable</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        200.000 Đ
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="number" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        200.000 Đ
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="icon_close"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="../../du_an1/asset/images/ao-thun-nam-10s23tss003c_black_4__1_1.jpg" alt="" width="100px">
                                        <h5>Organic Bananas</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        300.000 Đ
                                    </td>

                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="number" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        300.000 Đ
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="icon_close"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">Tiếp tục mua hàng</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Thành Tiền</h5>
                        <ul>
                            <li>Subtotal <span>300.000 Đ</span></li>
                            <li>Total <span>300.000 Đ</span></li>
                        </ul>
                        <a href="" class="primary-btn">ĐI đến thanh toán</a>
                    </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    


    <?php require "./includes/footer.php" ?>