
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
              <a href="male-fashion">Nam</a>
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
              <a href="ao_sale">Áo</a>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manPants"></label>
              <a href="quan_sale">Quần</a>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manPants"></label>
              <a href="vay_sale">Váy</a>
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
         
          <?php
            // Lấy danh sách tất cả các kích thước từ cơ sở dữ liệu
            $sizes = select_all_size(); // Gọi hàm select_all_size() để lấy danh sách

            foreach ($sizes as $size) {
              echo '<span class="filter-list-size" data-size-id="' . $size['size_id'] . '">' . $size['size_name'] . '</span>';
            }
            ?>
            <div class="filter_type_size" filter_type_size="" product_status="2">
                
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
              <a href="../du_an1/index.php?action=color_filter_sale&color_type_id=1">Đen</a>
              <div class="filter-list-color" style="background-image: url('../<?= $ROOT_URL ?>/asset/images/black.png')"></div>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manShirt">
              </label>
              <a href="../du_an1/index.php?action=color_filter_sale&color_type_id=2">Trắng</a>
              <div class="filter-list-color" style="background-image: url('../<?= $ROOT_URL ?>/asset/images/white.png')"></div>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manShirt">
              </label>
              <a href="../du_an1/index.php?action=color_filter_sale&color_type_id=3">Be</a>
              <div class="filter-list-color" style="background-image: url('../<?= $ROOT_URL ?>/asset/images/be.png')"></div>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manShirt">
              </label>
              <a href="../du_an1/index.php?action=color_filter_sale&color_type_id=4">Xám/Bạc</a>
              <div class="filter-list-color" style="background-image: url('../<?= $ROOT_URL ?>/asset/images/xam_bac.png')"></div>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manShirt">
              </label>
              <a href="../du_an1/index.php?action=color_filter_sale&color_type_id=5">Xanh Da Trời</a>
              <div class="filter-list-color" style="background-image: url('../<?= $ROOT_URL ?>/asset/images/xanh_da_tr_i.png')"></div>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manShirt">
              </label>
              <a href="../du_an1/index.php?action=color_filter_sale&color_type_id=6">Xanh Navy</a>
              <div class="filter-list-color" style="background-image: url('../<?= $ROOT_URL ?>/asset/images/xanh_navy.png')"></div>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manShirt">
              </label>
              <a href="../du_an1/index.php?action=color_filter_sale&color_type_id=7">Xanh lá</a>
              <div class="filter-list-color" style="background-image: url('../<?= $ROOT_URL ?>/asset/images/xanh_l_.png')"></div>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manShirt">
              </label>
              <a href="../du_an1/index.php?action=color_filter_sale&color_type_id=8">Xanh Olive</a>
              <div class="filter-list-color" style="background-image: url('../<?= $ROOT_URL ?>/asset/images/xanh_olive.png')"></div>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manShirt">
              </label>
              <a href="../du_an1/index.php?action=color_filter_sale&color_type_id=9">Nâu</a>
              <div class="filter-list-color" style="background-image: url('../<?= $ROOT_URL ?>/asset/images/nau.png')"></div>
            </li>
            <li class="filter-category-name">
              <label class="filter-newCheckbox" for="filter-checkbox-manShirt">
              </label>
              <a href="../du_an1/index.php?action=color_filter_sale&color_type_id=10">Đỏ</a>
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
            <div class="filter_type" filter_type="" product_status ="2">
            </div>
            <div id="multi-range-slider" class="filter-price"></div>
            <div class="filter-price-control">
              <div>
                <span>₫</span><span id="start-value" class="filter-price-min">75000đ</span>
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