<?php require "./includes/header.php" ?>
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
    <div class="wrapper">
      <main id="main-content">
        <div class="main-colums">
          <!-- block filter -->

          <div class="filter-sidebar">



          </div>
        </div>
        <div class="container">

          <div class="colums row-col-2" style="margin: 70px 0px;">
          
            <div class="sidebar-main">
              <div class="title_taikhoan">
                <i class="fa-regular fa-user header-content-user"></i>
                <span>Tài khoản của bạn</span>
              </div>
              <div class="nav_items">


                <div class="nav_title">
                  <strong><?php if (isset($_SESSION['username'])) echo $_SESSION['username']['full_name'] ?></strong>
                  <span>NEW</span>
                </div>
                <hr>
                <ul><br>
                  <li class="nav_item"><a href="">Thông tin tài khoản</a></li><br>
                  <li class="nav_item"><a href="../../du_an1/view/diachi.php">Địa chỉ giao hàng</a></li><br>
                  <li class="nav_item"><a href="./order_details_infomation?id=4">Lịch sử mua hàng</a></li><br>
                  <li class="nav_item"><a href="">Sản phẩm yêu thích</a></li><br>
                  <br>
                  <hr>
                  <br>
                  <li class="nav_item"><a href="index.php?action=thoat">Đăng xuất</a></li>

                </ul>

              </div>

            </div>

            <div class="colums_main">
              <div class="page-title">
                <h2>Thông tin tài khoản</h2>
                <span>Bạn có thể cập nhật thông tin của mình ở trang này</span>
              </div>
              <hr>
              <div class="account-information row-col-2">
                <?php
                $user_id = 0;
                if (isset($_SESSION['username'])&&(is_array($_SESSION['username']))) {
                  extract($_SESSION['username']);
                  $user_id = $_SESSION['username']['id'];
                }else{
                  echo '';
                }
                ?>
                <div class="info">
                  <h3>Thông tin đăng nhập</h3>
                  <p>
                    <span>Email:</span>
                    <strong><?php if(isset($_SESSION['username'])) echo $_SESSION['username']['email'] ?></strong>
                  </p>
                  <p>
                    <span>Phone:</span>
                    <strong><?php if(isset($_SESSION['username'])) echo $_SESSION['username']['phone'] ?></strong>
                  </p>

                </div>
                <form action="index.php?action=updatetk" method="POST" id="profile-form" enctype="multipart/form-data">
                  <div class="thkn">
                    <h3>Thông tin cá nhân</h3>
                    <div class="" style="font-size: 20px; " >
                      
                      

                      <div class="col-lg-6">
                        <div class="checkout__input">
                          <p>Username <span>*</span></p>
                          <input type="text" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;" id="username" name='username' value="<?php if(isset($username)) echo $username  ?>" placeholder="username" required>
                        </div>
                      </div>
                      <div class="row-col-6">

                        <div class="checkout__input">
                          <p>Họ và tên <span>*</span></p>
                          <input type="text" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;" id="fullname" name='full_name' value="<?php if(isset($full_name)) echo $full_name  ?>" placeholder="Họ và tên" required>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="checkout__input">
                          <p>Email <span>*</span></p>
                          <input type="email" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;" id="email" name='email' value="<?php if(isset($email)) echo $email ?>" placeholder="Your email" required>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="checkout__input">
                          <p>Số điện thoại <span>*</span></p>
                          <input type="tel" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;" value="<?php if(isset($phone)) echo $phone ?>" id="Number" name='phone' required>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="checkout__input">
                          <p>Địa chỉ <span>*</span></p>
                          <input type="text" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;" value="<?php if(isset($address)) echo $address ?>" id="address" name='address' required>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="checkout__input">
                          <p>Password <span>*</span></p>
                          <input type="password" name='password' id="password" value="<?php if(isset($password)) echo $password ?>" placeholder="Enter a password" required>
                        </div>
                      </div>
                    </div>
                    <style>
                      .thkn a {
                        text-decoration: none;
                        color: white;

                      }
                    </style>
                    <div class="submit">
                      <input type="hidden" name="id" value="<?= $user_id ?>">
                      <input type="submit" name="thaydoi" id="updatetk" value="Lưu thay đổi" style="color: white;">
                    </div>

                    <?php
                    if (isset($thongbao) && ($thongbao) != "") {
                      echo $thongbao;
                    }
                    ?>
                  </div>

                </form>
              </div>


            </div>

          </div>
        </div>
        <?php require "./includes/footer.php" ?>
  </body>

  </html>

  <script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      let i;
      let slides = document.getElementsByClassName("mySlides");
      if (n > slides.length) {
        slideIndex = 1
      }
      if (n < 1) {
        slideIndex = slides.length
      }
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      slides[slideIndex - 1].style.display = "block";
    }
  </script>

  <!-- -----js img--------- -->

  <script>
    var ProductImg = document.getElementById("ProductImg");
    var SmallImg = document.getElementsByClassName("small-img")

    SmallImg[0].onclick = function() {
      ProductImg.src = SmallImg[0].src;
    }

    SmallImg[1].onclick = function() {
      ProductImg.src = SmallImg[1].src;
    }

    SmallImg[2].onclick = function() {
      ProductImg.src = SmallImg[2].src;
    }

    SmallImg[3].onclick = function() {
      ProductImg.src = SmallImg[3].src;
    }
  </script>
