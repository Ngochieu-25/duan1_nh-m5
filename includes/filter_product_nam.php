<style>
    *{
    text-decoration: none;
    color: inherit
  }
</style>
<div class="filter-sidebar">
        <div class="filter-block">
          <div class="filter-category active">
            <ul>
              DANH MỤC
            </ul>
            <i class="fa-solid fa-chevron-down filter-dropdown"></i>
          </div>
          <div class="filter-list">
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manShirt">
              </label>
              <a href="/du_an1/male-fashion">Nam</a>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manPants"></label>
              <a href="female-fashion">Nữ</a>
            </li>
          </div>
        </div>

        <div class="filter-block">
          <div class="filter-category">
            <ul>
              NHÓM SẢN PHẨM
            </ul>
            <i class="fa-solid fa-chevron-down filter-dropdown"></i>
          </div>
          <div class="filter-list">
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manShirt">
              </label>
              <a href="aonam">Áo Nam</a>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manPants"></label>
              <a href="quannam">Quần Nam</a>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manPants"></label>
              <a href="aosomi">Áo Sơ Mi Nam</a>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manPants"></label>
              <a href="polo">Áo Polo Nam</a>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manPants"></label>
              <a href="hoodie">Áo Hoodie Nam</a>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manPants"></label>
              <a href="aothun">Áo Thun Nam</a>
            </li>
          </div>
        </div>
    
        <div class="filter-block">
          <div class="filter-category">
            <ul>
              SIZE
            </ul>
            <i class="fa-solid fa-chevron-down filter-dropdown"></i>
          </div>
          <div class="filter-list flex-col-4">
               <a href="../du_an1/index.php?action=size_filter_nam&size_id=7" class="filter-list-size">28</a>
               <a href="../du_an1/index.php?action=size_filter_nam&size_id=8" class="filter-list-size">29</a>
               <a href="../du_an1/index.php?action=size_filter_nam&size_id=9" class="filter-list-size" >30</a>
               <a href="../du_an1/index.php?action=size_filter_nam&size_id=10" class="filter-list-size" >31</a>
               <a href="../du_an1/index.php?action=size_filter_nam&size_id=11" class="filter-list-size" >32</a>
               <a href="../du_an1/index.php?action=size_filter_nam&size_id=12" class="filter-list-size" >33</a>
               <a href="../du_an1/index.php?action=size_filter_nam&size_id=13" class="filter-list-size" >34</a>
               <a href="../du_an1/index.php?action=size_filter_nam&size_id=null" class="filter-list-size">35</a>
               <a href="../du_an1/index.php?action=size_filter_nam&size_id=14" class="filter-list-size">36</a>
               <a href="../du_an1/index.php?action=size_filter_nam&size_id=15" class="filter-list-size">M</a>
               <a href="../du_an1/index.php?action=size_filter_nam&size_id=16" class="filter-list-size">S</a>
               <a href="../du_an1/index.php?action=size_filter_nam&size_id=17" class="filter-list-size">L</a>
               <a href="../du_an1/index.php?action=size_filter_nam&size_id=18" class="filter-list-size">XL</a>
               <a href="../du_an1/index.php?action=size_filter_nam&size_id=19" class="filter-list-size">XXL</a>
            <div class="filter_type_size" filter_type_size="0">
                
            </div>
          </div>
        </div>

        <div class="filter-block">
          <div class="filter-category">
            <ul>
              MÀU SẮC
            </ul>
            <i class="fa-solid fa-chevron-down filter-dropdown"></i>
          </div>
          <div class="filter-list row-filter-col-2">
            <!-- <?php
            // Lấy danh sách tất cả các màu từ cơ sở dữ liệu
            $colors = select_all_color(); // Gọi hàm select_all_color() để lấy danh sách màu
            ?>
            <?php foreach ($colors as $color) { ?>
              <li class="filter-category-name">
                <input type="checkbox" name="color_checkbox_<?php echo $color['color_type_name']; ?>" id="filter-checkbox-<?php echo $color['color_type_name']; ?>" class="filter-checkbox" />
                <label class="filter-newCheckbox" for="filter-checkbox-<?php echo $color['color_type_name']; ?>"></label>
                <a href="../../du_an1/index.php?action=color_filter&color_type_id=<?php echo $color['color_type_id'] ?>"><?php echo $color['color_type_name']; ?></a>
              </li>
            <?php } ?> -->
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manShirt">
              </label>
              <a href="../du_an1/index.php?action=color_filter_nam&color_type_id=1">Đen</a>
              <div class="filter-list-color" style="background-image: url('../<?= $ROOT_URL ?>/asset/images/black.png')"></div>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manShirt">
              </label>
              <a href="../du_an1/index.php?action=color_filter_nam&color_type_id=2">Trắng</a>
              <div class="filter-list-color" style="background-image: url('../<?= $ROOT_URL ?>/asset/images/white.png')"></div>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manShirt">
              </label>
              <a href="../du_an1/index.php?action=color_filter_nam&color_type_id=3">Be</a>
              <div class="filter-list-color" style="background-image: url('../<?= $ROOT_URL ?>/asset/images/be.png')"></div>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manShirt">
              </label>
              <a href="../du_an1/index.php?action=color_filter_nam&color_type_id=4">Xám/Bạc</a>
              <div class="filter-list-color" style="background-image: url('../<?= $ROOT_URL ?>/asset/images/xam_bac.png')"></div>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manShirt">
              </label>
              <a href="../du_an1/index.php?action=color_filter_nam&color_type_id=5">Xanh Da Trời</a>
              <div class="filter-list-color" style="background-image: url('../<?= $ROOT_URL ?>/asset/images/xanh_da_tr_i.png')"></div>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manShirt">
              </label>
              <a href="../du_an1/index.php?action=color_filter_nam&color_type_id=6">Xanh Navy</a>
              <div class="filter-list-color" style="background-image: url('../<?= $ROOT_URL ?>/asset/images/xanh_navy.png')"></div>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manShirt">
              </label>
              <a href="../du_an1/index.php?action=color_filter_nam&color_type_id=7">Xanh lá</a>
              <div class="filter-list-color" style="background-image: url('../<?= $ROOT_URL ?>/asset/images/xanh_l_.png')"></div>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manShirt">
              </label>
              <a href="../du_an1/index.php?action=color_filter_nam&color_type_id=8">Xanh Olive</a>
              <div class="filter-list-color" style="background-image: url('../<?= $ROOT_URL ?>/asset/images/xanh_olive.png')"></div>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manShirt">
              </label>
              <a href="../du_an1/index.php?action=color_filter_nam&color_type_id=9">Nâu</a>
              <div class="filter-list-color" style="background-image: url('../<?= $ROOT_URL ?>/asset/images/nau.png')"></div>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manShirt">
              </label>
              <a href="../du_an1/index.php?action=color_filter_nam&color_type_id=10">Đỏ</a>
              <div class="filter-list-color" style="background-image: url('../<?= $ROOT_URL ?>/asset/images/do.png')"></div>
            </li>
          </div>
        </div>
        <div class="filter-block">
          <div class="filter-category">
            <ul>
              GIÁ TIỀN
            </ul>
            <i class="fa-solid fa-chevron-down filter-dropdown"></i>
          </div>
          <div class="filter-list">
            <div class="filter_type" filter_type="0">
                
            </div>
            <div id="multi-range-slider" class="filter-price"></div>
            <div class="filter-price-control">
              <div>
                <span>₫</span><span id="start-value" class="filter-price-min">0đ</span>
              </div>
              <div>
                <span>₫</span><span id="end-value" class="filter-price-max">1375000đ</span>
              </div>
            </div>
            <a href=""></a>
            <!-- <p id="price_show">2000 - 1375000</p> -->
          </div>
        </div>
      </div>