<header class="header nav-active" style="justify-content: space-between;">
  <div class="header-menu-sidebar">
    <ul class="header-menu-top-title">
      <li><a href="/du_an1/male-fashion" class="menu-sidebar-active">NAM</a></li>
      <li><a href="/du_an1/female-fashion">NỮ</a></li>
      <li><a href="#">BỘ SƯU TẬP</a></li>
    </ul>

    <ul class="header-menu-middle">
      <li><a href="#">XEM TẤT CẢ</a></li>
      <li><a href="#">NEW ARRIVALS</a></li>
      <li><a href="#">BEST SELLERS</a></li>
      <li>
        <a href="#">ÁO NAM </a>
        <i class="fa-solid fa-plus header-menu-middle-plus"></i>
        <i class="fa-solid fa-minus header-menu-middle-minus"></i>
      </li>
      <li>
        <a href="#">QUẦN NAM</a>
        <i class="fa-solid fa-plus header-menu-middle-plus"></i>
        <i class="fa-solid fa-minus header-menu-middle-minus"></i>
      </li>
      <li><a href="#">ĐỒ BƠI - ĐỒ ĐI BIỂN</a></li>
      <li>
        <a href="#">PHỤ KIỆN </a>
        <i class="fa-solid fa-plus header-menu-middle-plus"></i>
        <i class="fa-solid fa-minus header-menu-middle-minus"></i>
      </li>
      <li>
        <a href="#">ƯU ĐÃI </a>
        <span class="sale">Sale</span>
        <i class="fa-solid fa-plus header-menu-middle-plus"></i>
        <i class="fa-solid fa-minus header-menu-middle-minus"></i>
      </li>
      <li><a href="#">TIN THỜI TRANG</a></li>
    </ul>
    <ul class="header-menu-bottom">
      <i class="fa-regular fa-user header-menu-icon-user"></i>
      <?php if (!isset($_SESSION['username'])) : ?>
        <li id="open-modal-btn">ĐĂNG NHẬP</li>
        <li id="register-button">ĐĂNG KÝ</li>
        <li id="quenpass">QUÊN MẬT KHẨU</li>
      <?php else : ?>
        <?php if (isset($_SESSION['username']) && $_SESSION['username']['role'] == 1) : ?>
          <li id="open-modal-btn"> <a style="color: #000; text-decoration: none;" href="../../du_an1/admin/index.php">ADMIN</a> </li>
          <li id="open-modal-btn"> <a style="color: #000; text-decoration: none;" href="../../du_an1/index.php?action=thoat">ĐĂNG XUẤT</a> </li>
          <li id="open-modal-btn"> <a style="color: #000; text-decoration: none;" href="../../du_an1/index.php?action=myaccount">MY ACCOUNT</a> </li>
        <?php else : ?>
          <li id="open-modal-btn"> <a style="color: #000; text-decoration: none;" href="../../du_an1/index.php?action=thoat">ĐĂNG XUẤT</a> </li>
          <li id="open-modal-btn"> <a style="color: #000; text-decoration: none;" href="../../du_an1/index.php?action=myaccount">MY ACCOUNT</a> </li>
        <?php endif; ?>
      <?php endif; ?> 
    </ul>
  </div>
  <!-- Hidden when scoll -->
  <div class="header-bar">
    <img src="../<?= $ROOT_URL ?>/asset/images/menu.png" alt="" class="header-menu-bar" />
  </div>
  <div class="overlay"></div>
  <div class="header-logo">
    <a href="./index.php">
      <img src="../<?= $ROOT_URL ?>/asset/images/routine_log.png" alt="" class="header-logo-img" />
    </a>
  </div>
  <!-- end -->
  <!-- second header -->
  <ul class="header-nav">
    <div class="header-second-logo">
      <a href="./index.php">
        <img src="../<?= $ROOT_URL ?>/asset/images/routine_log.png" alt="" class="header-logo-img" />
      </a>
    </div>
    <?php if(isset($_SESSION['username']) && ($_SESSION['username']['role'] == 1)) : ?>
      <li class="header-nav-item">
      <a class="header-nav-link" href="/du_an1/admin">Quản trị</a>
    </li>
    <?php endif ?>
    <li class="header-nav-item">
      <a class="header-nav-link" href="/du_an1/male-fashion?page=1">NAM</a>
    </li>
    <li class="header-nav-item">
      <a class="header-nav-link" href="/du_an1/female-fashion?page=1">NỮ</a>
    </li>
    <li class="header-nav-item">
      <a class="header-nav-link" href="/du_an1/news-fashion?page=1">NEW</a>
    </li>
    <li class="header-nav-item">
      <a class="header-nav-link" href="/du_an1/sale-fashion?page=1">SALE</a>
    </li>
    
  </ul>
  <div class="header-content-right">
    <div class="header-search-bar">
      <div>
        <i class="fa-solid fa-magnifying-glass header-search-icon"></i>
      </div>
      <form action="/du_an1/timkiem" method="get">
        <input type="text" name="tukhoa" placeholder="Tìm kiếm" class="header-search-content" />
      </form>
    </div>
    <div class="header-content-tool">
      <div class="action showCustomer" style="margin-right: <?= isset($_SESSION['username']) ? '8px' : '' ?>">
        <!-- <i class="fa-regular fa-user "></i> -->
        <svg xmlns:xlink="http://www.w3.org/1999/xlink" class="header-content-user" width="30" height="30" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M18.36 13.6832C17.3672 12.2923 15.9872 11.2216 14.3906 10.6034C15.2631 9.73531 15.8576 8.62882 16.0989 7.42395C16.3401 6.21908 16.2172 4.96998 15.7458 3.83471C15.2744 2.69944 14.4756 1.72902 13.4505 1.04624C12.4254 0.363469 11.22 -0.000976563 9.98698 -0.000976562C8.75394 -0.000976563 7.54861 0.363469 6.5235 1.04624C5.49839 1.72902 4.69958 2.69944 4.22815 3.83471C3.75672 4.96998 3.63385 6.21908 3.87509 7.42395C4.11633 8.62882 4.71084 9.73531 5.58339 10.6034C3.93899 11.2492 2.52736 12.3726 1.53173 13.8277C0.536095 15.2829 0.00243009 17.0027 0 18.7639C0 19.0915 0.130619 19.4057 0.363121 19.6374C0.595623 19.869 0.910966 19.9992 1.23977 19.9992C1.56858 19.9992 1.88392 19.869 2.11643 19.6374C2.34893 19.4057 2.47955 19.0915 2.47955 18.7639C2.48115 17.0901 3.14914 15.4853 4.33692 14.3016C5.5247 13.118 7.13524 12.4523 8.81508 12.4506H11.1858C12.8654 12.4528 14.4756 13.1187 15.6631 14.3022C16.8507 15.4858 17.5186 17.0903 17.5204 18.7639C17.5204 19.0915 17.6511 19.4057 17.8836 19.6374C18.1161 19.869 18.4314 19.9992 18.7602 19.9992C19.089 19.9992 19.4044 19.869 19.6369 19.6374C19.8694 19.4057 20 19.0915 20 18.7639C19.9983 16.9413 19.4249 15.1649 18.36 13.6832ZM13.7193 6.24204C13.7193 7.10254 13.4199 7.93643 12.872 8.60162C12.3242 9.2668 11.5618 9.72213 10.7148 9.89002C9.8678 10.0579 8.98857 9.92797 8.22693 9.52235C7.4653 9.11672 6.86838 8.4605 6.53788 7.6655C6.20738 6.87051 6.16375 5.98592 6.41443 5.16246C6.66511 4.33901 7.19459 3.62764 7.91264 3.14956C8.6307 2.67148 9.4929 2.45627 10.3523 2.54061C11.2118 2.62494 12.0153 3.0036 12.626 3.61206C12.9737 3.9566 13.2494 4.36646 13.4371 4.8179C13.6248 5.26935 13.7207 5.7534 13.7193 6.24204Z" fill="#464646"></path>
        </svg>
        <div class="modal_user">
          <div class="user_modal_container">
            <div class="btn_link_user"></div>
            <?php if (!isset($_SESSION['username'])) : ?>
              <button id="dangnhap_user">ĐĂNG NHẬP</button>
              <button id="dangki_user" style="background: #fff;color: #000;">ĐĂNG KÝ</button>
              <div class="a_link_user">
                <a href="/du_an1/order_details_infomation">Theo dõi đơn hàng</a>
                <a href="">Khách hàng thành viên</a>
                <a href="">Danh sách cửa hàng</a>
              </div>
            <?php else : ?>
              <a href="../../du_an1/index.php?action=myaccount" class="ten_user">Chào <?php if (isset($_SESSION['username'])) echo $_SESSION['username']['full_name'] ?></a>
              <p class="new_user">NEW</p>
              <div class="a_link_user">
                <?php
                $order_id = isset($_COOKIE['order_details_infomation']) ? $_COOKIE['order_details_infomation'] : null;
                ?>
                <a href="/du_an1/order_details_infomation?id=1">Thông tin đơn hàng</a>
                <a href="">Khách hàng thành viên</a>
                <a href="">Danh sách cửa hàng</a>
              </div>
              <a href="../../du_an1/index.php?action=thoat" class="dangxuat_user">Đăng xuất</a>
            <?php endif ?>
          </div>
        </div>
        <span style="<?php if (!isset($_SESSION['username'])) {
                        echo "display:none;";
                      } ?>">
          Hi
        </span>
      </div>
      <div>
        <i id="header-content-heart" class="fa-regular fa-heart header-content-heart"></i>
      </div>
      <div>
        <i class="fa-solid fa-heart header-content-heart" style="display: none"></i>
      </div>
      <div id="header-content-cart">
        <i class="fa-solid fa-cart-shopping header-content-cart">
          <span class="product-quantity" style="display:<?= empty($_SESSION['count_cart']) ? "none" : ""; ?>"><?php if (!empty($_SESSION['count_cart'])) echo $_SESSION['count_cart']; ?></span>
        </i>
      </div>
    </div>
  </div>
</header>