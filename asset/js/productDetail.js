$(document).ready(function () {
  let isCheckClickSize = false;
  let isCheckClickColor = false;
  let thisIdcz = 0;
  // let isCheckChooseColor = false;
  function reloadSlick() {
    setTimeout(function () {
      $(".slider-for").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        asNavFor: ".slider-nav",
        infinite: true,
        nextArrow: '<i class="fa-solid fa-angle-right slick-next-list"></i>',
        prevArrow: '<i class="fa-solid fa-angle-left slick-prev-list"></i>',
      });
      $(".slider-nav").slick({
        accessibility: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        vertical: true,
        arrows: false,
        asNavFor: ".slider-for",
        infinite: true,
        centerMode: true,
        focusOnSelect: true,
        // autoplay: true,
        // autoplaySpeed: 1000,
      });
    }, 100);
  }
  $(".product_detail_image").on("click", function () {
    const that = this;
    let productId = $(that).attr("product_id");
    let colorNameId = $(that).attr("color_name_id");
    $(".box-color-name-id").val(colorNameId);
    $(".data-id-container").attr("color_name_id", colorNameId);
    $(".product_detail_image").removeClass("active");
    $(that).addClass("active");
    $(".loading-container").show();
    // đặt lại hiển thị số lượng thành rỗng
    resetShowInfo();
    $.ajax({
      type: "POST",
      url: "../../du_an1/index.php?action=get_product_info",
      data: {
        productId: productId,
        colorNameId: colorNameId,
      },
      dataType: "json",
      success: function (result) {
        // console.log(result);
        const COLORNAME = result[1][0];
        const IMAGELENGTH = result[0].length;
        const SIZELENGTH = result[2].length;
        // update color name
        $("#product_detail_color").text(COLORNAME);
        // progress load image
        let html = ` <div id="main-slider" class="slider-for main-image-slider">`;
        for (let i = 0; i < IMAGELENGTH; i++) {
          const element = result[0][i];
          html += `<img src="../../du_an1${element}" alt="Ảnh sản phẩm"></img>`;
        }
        html += `</div>`;
        html += ` <div id="second-slider" class="slider-nav second-image-slider">`;
        for (let i = 0; i < IMAGELENGTH; i++) {
          const element = result[0][i];
          html += `<img src="../../du_an1${element}" alt="Ảnh sản phẩm"></img>`;
        }
        html += `</div>`;
        $("#show_slider").html(html);
        // end load image
        // load size
        let sizeHtml = ``;
        const newColorNameId = result[2][0].color_name_id;
        // console.log(newColorNameId);
        for (let i = 0; i < SIZELENGTH; i++) {
          const element = result[2][i];
          const sizeName = result[3][i];
          sizeHtml += `<span class="product-detail-size submitSize" product_id="${element.product_id}" size-id="${element.size_id}">${sizeName.size_name}</span>`;
        }
        // update color_name_id;
        $(".data-id-container").attr("color_name_id", newColorNameId);

        // console.log(sizeHtml);
        $(".product-detail-list-size").html(sizeHtml);
        // end load size
        // query submitSize again
        submitSize();
        // click first size Element
        $(".submitSize").eq(0).click();
        // load all iamge slider
        $(".loading-container").hide();
        reloadSlick();
      },
      error: function (error) {
        $(".loading-container").hide();
        console.log(error);
      },
    });
  });
  function resetShowInfo() {
    $("#product_detail_quantity").text("");
    $("#product-detail-inc-quantity").val("1");
  }
  function submitSize() {
    $(".submitSize").click(function () {
      const that = this;
      let sizeId = $(that).attr("size-id");
      let productId = $(that).attr("product_id");
      let colorNameId = $(".data-id-container").attr("color_name_id");
      $(".submitSize").removeClass("active");

      $(that).addClass("active");

      $("#product_detail_size").text($(that).text());

      $(".box-size-id").val($(that).attr("size-id"));

      resetShowInfo();
      // console.log("OK");
      $.ajax({
        type: "POST",
        url: "../../du_an1/index.php?action=check-quanity",
        data: {
          sizeId: sizeId,
          productId: productId,
          colorNameId: colorNameId,
        },
        dataType: "json",
        success: function (result) {
          $("#product_detail_contain_quantity").val(result);
          $("#quantity_product").text(`Còn lại: ${result} sản phẩm`);
        },
        error: function (error) {
          console.log(error);
        },
      });
    });
  }
  submitSize();
  // Auto click when each pages loads
  if (!isCheckClickSize) {
    $(".submitSize").eq(0).click();
  }
  if (!isCheckClickColor) {
    $(".product_detail_image").eq(0).click();
  }
  // end

  $("#addToCart").click(function () {
    let productId = $(".submitSize").eq(0).attr("product_id");
    let colorNameId = $(".data-id-container").attr("color_name_id");
    let sizeId = $(".box-size-id").val();
    let quantity = $("#product-detail-inc-quantity").val();
    // console.log(productId);
    // console.log(colorNameId);
    // console.log(sizeId);
    $("#addToCart").text("Đang thêm");
    $("#addToCart").css("opacity", "0.7");
    $.ajax({
      type: "POST",
      url: "../../du_an1/index.php?action=add_to_cart",
      data: {
        colorId: colorNameId,
        sizeId: sizeId,
        quantity: quantity,
        productId: productId,
      },
      // dataType: "json",
      success: function () {
        $("#addToCart").text("Đã thêm");
        reloadCart(
          increaseProductInCart,
          decreaseQuantityInCart,
          handleDeleteProductInCart
        );
        openModalCart();
        setTimeout(function () {
          $("#addToCart").css("opacity", "1");
          $("#addToCart").text("Mua Ngay");
        }, 1000);
      },
      error: function (error) {
        $("#addToCart").css("opacity", "1");
        console.error("lỗi", error);
      },
    });
    // localStorage.setItem("openModal", true);
  });
  function decreaseQuantity(
    decrBtn,
    inputValue,
    productQuantityValue,
    showValue
  ) {
    $(document).on("click", `${decrBtn}`, function () {
      // let productId = $("#submitSize").attr("product_id");
      let currentQuantity = $(`${inputValue}`).val();
      let remainingAmount = $(`${productQuantityValue}`).val();

      $.ajax({
        type: "POST",
        url: "../../du_an1/index.php?action=product_add_quantity_to_cart",
        data: {
          type: "decrease",
          // productId: productId,
          currentQuantity: currentQuantity,
          remainingAmount: remainingAmount,
        },
        // dataType: "json",
        success: function (result) {
          // console.log(typeof result);
          let stringToNumberResult = Number(result);
          if (showValue) {
            $(`${showValue}`).text(result);
          }
          $(`${inputValue}`).val(stringToNumberResult);
        },
        error: function (error) {
          console.log(error);
        },
      });
    });
  }
  decreaseQuantity(
    ".product-detail-inc-minus",
    "#product-detail-inc-quantity",
    "#product_detail_contain_quantity",
    "#product_detail_quantity"
  );
  function increaseQuantity(
    decrBtn,
    inputValue,
    productQuantityValue,
    showValue
  ) {
    $(document).on("click", `${decrBtn}`, function () {
      // console.log("Cộng");
      // let productId = $("#submitSize").attr("product_id");
      let currentQuantity = $(`${inputValue}`).val();
      let remainingAmount = $(`${productQuantityValue}`).val();
      $.ajax({
        type: "POST",
        url: "../../du_an1/index.php?action=product_add_quantity_to_cart",
        data: {
          type: "increase",
          // productId: productId,
          currentQuantity: currentQuantity,
          remainingAmount: remainingAmount,
        },
        // dataType: "json",
        success: function (result) {
          // console.log(result);
          let stringToNumberResult = Number(result);
          if (showValue) {
            $(`${showValue}`).text(result);
          }
          $(`${inputValue}`).val(stringToNumberResult);
        },
      });
    });
  }
  increaseQuantity(
    ".product-detail-inc-plus",
    "#product-detail-inc-quantity",
    "#product_detail_contain_quantity",
    "#product_detail_quantity"
  );
  function decreaseQuantityInCart() {
    $(".cartModal-inc-minus").click(function () {
      // Xử lý sự kiện click
      let that = this;
      let productId = $(that).prev().attr("product_id");
      let sizeId = $(that).prev().attr("size_id");
      let colorNameId = $(that).prev().attr("color_name_id");
      let remainingAmount = $(that).siblings(".cart_product_quantity").val();
      let boxQuantityInput = $(that).next();
      let currentQuantity = $(that).next().val();
      const variantKey = `i${productId}C${colorNameId}Z${sizeId}`;
      let limitNumber = 2;
      // console.log(remainingAmount);
      // console.log(productId);
      // console.log(currentQuantity);
      if (Number(boxQuantityInput.val()) < limitNumber) {
        // console.log("Dừng");
        return false;
      }
      $.ajax({
        type: "POST",
        url: "../../du_an1/index.php?action=update_quantity_product",
        data: {
          type: "decrease",
          remainingAmount: remainingAmount,
          currentQuantity: currentQuantity,
          productId: productId,
          sizeId: sizeId,
          colorNameId: colorNameId,
        },
        dataType: "json",
        success: function (result) {
          // console.log(result);
          // console.log("ok");
          let stringToNumberResult = Number(result.currentQuantity);
          boxQuantityInput.val(stringToNumberResult);
          let allInputQuantity = $(".favoriteProduct-inc-quantity");
          for (let i = 0; i < allInputQuantity.length; i++) {
            const element = allInputQuantity[i];
            if (variantKey === element.getAttribute("idcz")) {
              element.value = stringToNumberResult;
            }
          }
          let newPrice = document.querySelector("#cart-total-new-price");
          let oldPrice = document.querySelector("#cart-total-old-price");
          // this is total price in cart detail
          let provisionalPrice = document.querySelector(
            ".checkout__order__provisional__rice__value"
          );
          let totalPrice = document.querySelector(
            ".checkout__order__total__price_value"
          );
          let totalQuantity = document.querySelector(
            ".checkout__oder__quantity_value"
          );
          let btnPay = document.querySelector(".btn-pay");

          // localStorage.setItem("newPrice",`${result.new_price}₫`);
          const newPriceFormatted = new Intl.NumberFormat("vi-VN", {
            style: "currency",
            currency: "VND",
          }).format(result.new_price);
          const oldPriceFormatted = new Intl.NumberFormat("vi-VN", {
            style: "currency",
            currency: "VND",
          }).format(result.old_price);
          newPrice.textContent = newPriceFormatted;
          oldPrice.textContent = oldPriceFormatted;
          if (totalPrice) {
            totalPrice.textContent = newPriceFormatted;
            provisionalPrice.textContent = newPriceFormatted;
            totalQuantity.textContent = result.total_quantity;
            btnPay.textContent = newPriceFormatted;
          }
        },
        error: function (error) {
          console.log(error);
        },
      });
    });
  }
  decreaseQuantityInCart();
  function increaseProductInCart() {
    $(".cartModal-inc-plus").click(function () {
      // Xử lý sự kiện click
      let that = this;
      // lấy productId thông qua phần tử ở sau thứ 3
      let productId = $(that).prev().prev().prev().attr("product_id");
      let sizeId = $(that).prev().prev().prev().attr("size_id");
      let colorNameId = $(that).prev().prev().prev().attr("color_name_id");
      let remainingAmount = $(that).siblings(".cart_product_quantity").val();
      let boxQuantityInput = $(that).prev();
      let currentQuantity = $(that).prev().val();
      const variantKey = `i${productId}C${colorNameId}Z${sizeId}`;
      // console.log(productId);
      // console.log(remainingAmount);
      // console.log(boxQuantityInput);
      // console.log(currentQuantity);
      if (Number(remainingAmount) === Number(currentQuantity)) {
        return false;
      }
      $.ajax({
        type: "POST",
        url: "../../du_an1/index.php?action=update_quantity_product",
        data: {
          type: "increase",
          remainingAmount: remainingAmount,
          currentQuantity: currentQuantity,
          productId: productId,
          sizeId: sizeId,
          colorNameId: colorNameId,
        },
        dataType: "json",
        success: function (result) {
          let stringToNumberResult = Number(result.currentQuantity);
          boxQuantityInput.val(stringToNumberResult);
          let allInputQuantity = $(".favoriteProduct-inc-quantity");
          for (let i = 0; i < allInputQuantity.length; i++) {
            const element = allInputQuantity[i];
            if (variantKey === element.getAttribute("idcz")) {
              element.value = stringToNumberResult;
            }
          }
          // console.log(element.getAttribute("product-cart"));
          // console.log(allInputQuantity.length);
          let newPrice = document.querySelector("#cart-total-new-price");
          let oldPrice = document.querySelector("#cart-total-old-price");
          // console.log(newPrice);
          // console.log(oldPrice);
          // this is total price in cart detail
          let provisionalPrice = document.querySelector(
            ".checkout__order__provisional__rice__value"
          );
          let totalPrice = document.querySelector(
            ".checkout__order__total__price_value"
          );
          // update quantity
          let totalQuantity = document.querySelector(
            ".checkout__oder__quantity_value"
          );
          let btnPay = document.querySelector(".btn-pay");

          const newPriceFormatted = new Intl.NumberFormat("vi-VN", {
            style: "currency",
            currency: "VND",
          }).format(result.new_price);
          const oldPriceFormatted = new Intl.NumberFormat("vi-VN", {
            style: "currency",
            currency: "VND",
          }).format(result.old_price);

          newPrice.textContent = newPriceFormatted;
          oldPrice.textContent = oldPriceFormatted;
          if (totalPrice) {
            totalPrice.textContent = newPriceFormatted;
            provisionalPrice.textContent = newPriceFormatted;
            totalQuantity.textContent = result.total_quantity;
            btnPay.textContent = newPriceFormatted;
          }

          // console.log("ổn");
        },
        error: function (error) {
          console.log(error);
        },
      });
    });
  }
  increaseProductInCart();

  // $("#testClick").click(function () {
  //   console.log("ok");
  //   localStorage.setItem("emptyCart", false);
  // });
  function reloadCart(
    increaseCallBack,
    decreaseCallBack,
    deleteProductInCartCb
  ) {
    $.ajax({
      type: "POST",
      url: "../../du_an1/index.php?action=load_cart",
      dataType: "json",
      success: function (responve) {
        let cartItems = responve.cart;
        let totalPrice = responve.total_cart;
        let totalNewPrice = "";
        let totalOldPrice = "";
        totalNewPrice = formatMoney("vi-VN", "VND", totalPrice.new_price);
        totalOldPrice = formatMoney("vi-VN", "VND", totalPrice.old_price);
        if (
          typeof totalNewPrice === "string" &&
          typeof totalPrice.new_price === "string"
        ) {
          totalNewPrice = 0;
        }
        let productInfo = ``;
        let productDetailInfo = ``;

        let cartTotalInfo = `
      <div class="product-cart-bottom"  style="display:${
        totalNewPrice === 0 ? "none" : "block"
      }">
        <div class="cart-total-price">
            <span class="cart-total-price-title">Tổng tiền:</span>
            <div class="cart-total-price">
                <span id="cart-total-new-price" class="cart-total-new-price">${
                  totalPrice.new_price === "" ? "" : totalNewPrice
                }</span>
                <span id="cart-total-old-price" class="cart-total-old-price">${
                  totalPrice.old_price === "" ? "" : totalOldPrice
                }</span>
            </div>
        </div>
        <div class="pay-to-cart">
            <button class="close-cart-modal">Tiếp tục mua sắm</button>
            <button class="btn-pay-to-cart"><a class="cart-modal-to-pay"href="/du_an1/order-detail" style="">Thanh Toán</a></button>
        </div></div>`;
        // Kiểm tra giỏ hàng có rỗng hay không
        const productQuantityInCart = Object.keys(cartItems).length;
        if (productQuantityInCart == 0) {
          localStorage.setItem("emptyCart", true);
          $("#favoriteProduct-containter").text(
            " Bạn không có sản phẩm nào trong giỏ hàng của bạn."
          );
        } else {
          localStorage.setItem("emptyCart", false);
        }
        const percent = 100;
        if (cartItems) {
          for (const cartItem in cartItems) {
            if (cartItems.hasOwnProperty(cartItem)) {
              const item = cartItems[cartItem];
              // console.log(cartItem);
              const discount =
                item.product_price -
                (item.product_price * item.discount) / percent;
              const newPriceFormatted = formatMoney("vi-VN", "VND", discount);
              const oldPriceFormatted = formatMoney(
                "vi-VN",
                "VND",
                item.product_price
              );

              productInfo += ` <div class="favoriteProduct-info">
              <a href="" class="favoriteProduct-img">
                  <div class="favoriteProduct-img-first">
                      <img src="../du_an1/${item.main_image_url}" alt="" />
                  </div>
              </a>
              <div class="favoriteProduct-details">
                  <a href="#" class="favoriteProduct-link">${item.product_name}</a>
                  <div class="favoriteProduct-option">
                      <div class="favoriteProduct-choose cart">
                          <div class="favoriteProduct-choose-color c">
                              MÀU:
                              <span>${item.color_name}</span>
                          </div>
                          <div class="favoriteProduct-choose-size">
                              SIZE:
                              <span>${item.size_name}</span>
                          </div>
                      </div>
                      <div class="favoriteProduct-inc">
                          <span id="cart_product_id" color_name_id="${item.colorNameId}" size_id="${item.sizeId}" product_id="${item.product_id}"></span>
                          <i class="fa-solid fa-minus cartModal-inc-minus" id="cartModal-inc-minus"></i>
                          <input type="number" disabled value="${item.quantity}" class="favoriteProduct-inc-quantity" idcz="i${item.product_id}C${item.colorNameId}Z${item.sizeId}"/>
                          <i class="fa-solid fa-plus cartModal-inc-plus" id="cartModal-inc-plus"></i>
                          <input type="hidden" value="${item.remainingAmount}" class="cart_product_quantity">
                      </div>
                      <span class="favoriteProduct-price" >${newPriceFormatted}</span>
                      <del class="favoriteProduct-price-old">${oldPriceFormatted}</del>
                  </div>
              </div>
              <div class="delete-from-cart favoriteProduct-close" idcz="i${item.product_id}c${item.colorNameId}z${item.sizeId}">
                  <i class="fa-solid fa-xmark"></i>
              </div>
          </div>`;

              const orderDetailDiscount =
                item.product_price -
                (item.product_price * item.discount) / percent;
              const orderDetailNewPriceFormatted = formatMoney(
                "vi-VN",
                "VND",
                orderDetailDiscount
              );
              const orderDetailOldPriceFormatted = formatMoney(
                "vi-VN",
                "VND",
                item.product_price
              );
              productDetailInfo += `<div class="favoriteProduct-info order">
          <a href="" class="favoriteProduct-img">
              <div class="favoriteProduct-img-first">
                  <img src="../du_an1/${item.main_image_url}" alt="" />
              </div>
              <div class="favoriteProduct-second-img">
                  <img src="../du_an1/${item.second_image_url}" alt="" />
              </div>
          </a>
          <div class="favoriteProduct-details">
              <a href="#" class="favoriteProduct-link">${item.product_name}</a>
              <div class="favoriteProduct-option">
                  <div class="favoriteProduct-choose cart">
                      <div class="favoriteProduct-choose-color c">
                          MÀU:
                          <span>${item.color_name}</span>
                      </div>
                      <div class="favoriteProduct-choose-size">
                          SIZE:
                          <span>${item.size_name}</span>
                      </div>
                  </div>
                  <div class="favoriteProduct-inc">
                      <span id="cart_product_id" color_name_id="${item.colorNameId}" size_id="${item.sizeId}" product_id="${item.product_id}"></span>
                      <i class="fa-solid fa-minus cartModal-inc-minus" id="cartModal-inc-minus"></i>
                      <input type="number" disabled value="${item.quantity}" id="cartModal-inc-quantity" class="favoriteProduct-inc-quantity" />
                      <i class="fa-solid fa-plus cartModal-inc-plus" id="cartModal-inc-plus"></i>
                      <input type="hidden" value="${item.remainingAmount}" class="cart_product_quantity">
                  </div>
                  <span class="favoriteProduct-price">${orderDetailNewPriceFormatted}</span>
                  <del class="favoriteProduct-price-old">${orderDetailOldPriceFormatted}</del>
              </div>
          </div> 
          <div class="delete-from-cart favoriteProduct-close" idcz="i${item.product_id}c${item.colorNameId}z${item.sizeId}">
                  <i class="fa-solid fa-xmark"></i>
              </div>
        </div>`;
            }
          }
        }
        $("#favoriteProduct-containter").html(productInfo);
        $(".show-cart-products").html(productDetailInfo);
        // console.log(productDetailInfo);
        // console.log(productInfo);
        $("#product-cart-bottom-container").html(cartTotalInfo);
        if (cartItems === "") {
          $("#btn-pay").hide();
          $(".checkout__oder__quantity_value").text("0");
          $(".checkout__order__provisional__rice__value").text("0");
          $(".checkout__order__total__price_value").text("0");
        }
        if (
          typeof increaseCallBack === "function" &&
          typeof decreaseCallBack === "function" &&
          typeof deleteProductInCartCb === "function"
        ) {
          increaseCallBack();
          decreaseCallBack();
          deleteProductInCartCb();
        }
        reloadShowQuantity();

        showCartNotitication();
        handlecontinueBuy();
      },
      error: function (error) {
        console.log(error, "lỗi");
      },
    });
  }
  function handleDeleteProductInCart() {
    $(".delete-from-cart").on("click", function () {
      const that = this;
      $(".confirm-modal").addClass("open-confirm");
      $(".confirm-container").addClass("open-confirm");
      thisIdcz = $(that).attr("idcz");
      // debugger;
      $("#agree-confirm").attr("idcz", thisIdcz);
    });
    $(".confirm-container").on("click", function (e) {
      e.stopPropagation();
    });

    function closeConfirmModal(tagClick) {
      $(`${tagClick}`).on("click", function () {
        $(".confirm-modal").removeClass("open-confirm");
        $(".confirm-container").removeClass("open-confirm");
      });
    }
    function autoCloseConfirmModal() {
      $(".confirm-modal").removeClass("open-confirm");
      $(".confirm-container").removeClass("open-confirm");
    }
    closeConfirmModal(".confirm-modal");
    closeConfirmModal(".confirm-close");
    closeConfirmModal(".cancel-confirm");

    $("#agree-confirm").on("click", function () {
      let getIdcz = $(this).attr("idcz");
      $.ajax({
        type: "POST",
        url: "../../du_an1/index.php?action=product_delete_quantity_to_cart",
        data: {
          Idcz: getIdcz,
        },
        success: function (responve) {
          // console.log(responve);
          if (responve === 0) {
            $("#product-quantity").hide();
          } else {
            $("#product-quantity").text(`${responve}`);
          }
          $(".cart-header-second span").text(`${responve} sản phẩm`);
          autoCloseConfirmModal();
          reloadCart(
            increaseProductInCart,
            decreaseQuantityInCart,
            handleDeleteProductInCart
          );
        },
        error: function (error) {
          console.log(error, "lỗi");
        },
      });
      // localStorage.setItem("openModal", true);
    });
  }
  handleDeleteProductInCart();

  // function reloadPage() {
  //   location.reload();
  // }
  function reloadShowQuantity() {
    $.ajax({
      type: "GET",
      url: "../../du_an1/index.php?action=show_quantity_in_cart",
      // dataType: "json",
      success: function (responve) {
        // console.log(responve);
        if (responve != 0) {
          $(".product-quantity").css("display", "flex");
          $(".product-quantity").text(`${responve}`);
        } else {
          $(".product-quantity").css("display", "none");
        }
        $(".cart-header-second span").text(`${responve} sản phẩm`);
      },
      error: function (error) {
        console.log(error, "lỗi");
      },
    });
  }

  // reloadShowQuantity();

  // let openModal = localStorage.getItem("openModal") || "false";
  // if (openModal !== "false") {
  //   setTimeout(function () {
  //     $("#header-content-cart").click();
  //   }, 500);
  // }
  function openModalCart() {
    setTimeout(function () {
      $("#header-content-cart").click();
    }, 100);
  }
  function showCartNotitication() {
    let checkEmptyCart = localStorage.getItem("emptyCart") || "false";
    if (checkEmptyCart !== "false") {
      let cartNotitication = `<span style="text-align: center; font-weight: 600;display:block">Bạn không có sản phẩm nào trong giỏ hàng của bạn. </span>`;
      $("#favoriteProduct-containter").append(cartNotitication);
    }
  }
  // showCartNotitication();
});

function formatMoney(locale, currency, price) {
  return new Intl.NumberFormat(`${locale}`, {
    style: "currency",
    currency: `${currency}`,
  }).format(price);
}
function handlecontinueBuy() {
  let continueBuy = document.querySelector(".close-cart-modal");
  if (continueBuy) {
    let cartModal = document.querySelector(".cart-modal");
    let cartModalContainer = document.querySelector(".cart-modal-container");
    continueBuy.onclick = function () {
      let hiddenBodyScollbar = document.querySelector("body");
      hiddenBodyScollbar.style.overflowY = "visible";
      cartModal.classList.remove(`cart-open`);
      cartModalContainer.classList.remove(`cart-open`);
    };
  }
}
