$(document).ready(function () {
  let paymentMethods = 1;
  function reloadShowQuantity() {
    $.ajax({
      type: "GET",
      url: "../../du_an1/index.php?action=show_quantity_in_cart",
      dataType: "json",
      success: function (responve) {
        // console.log(responve);
        if (responve != 0) {
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
  $("#auto__fill__btn").on("click", function () {
    let customerId = $("#customer_id");
    let customerfirstAndLastName = $("#customerFirstAndLastName");
    let customerAddress = $("#customerAddress");
    let customerNumberPhone = $("#customerNumberPhone");
    let customerEmail = $("#customerEmail");
    // let customerNote = $("#customerNote");
    $.ajax({
      type: "POST",
      url: "../../du_an1/index.php?action=get_customer_info",
      data: {
        customerId: customerId.val(),
      },
      dataType: "json",
      success: function (result) {
        if (result) {
          customerfirstAndLastName.val(result.full_name);
          customerAddress.val(result.address);
          customerNumberPhone.val(result.phone);
          customerEmail.val(result.email);
        }
      },
      error: function (error) {
        console.log(error);
      },
    });
  });

  $(".flexRadioDefault").on("click", function () {
    const that = this;
    paymentMethods = $(that).prev().val();
  });

  $("#btn-pay").on("click", function () {
    let isCheck = false;
    let customerId = $("#customer_id");
    let customerfirstAndLastName = $("#customerFirstAndLastName");
    let customerAddress = $("#customerAddress");
    let customerNumberPhone = $("#customerNumberPhone");
    let customerEmail = $("#customerEmail");
    let customerNote = $("#customerNote");
    let paymenMethod = paymentMethods;
  
    // Validate
    if (customerfirstAndLastName.val() === "") {
      isCheck = true;
      $(".order-notifi_name").text("Họ và tên không được để trống");
    }
    if (customerAddress.val() === "") {
      isCheck = true;
      $(".order-notifi_address").text("Địa chỉ không được để trống");
    }
    if (customerNumberPhone.val() === "") {
      isCheck = true;
      $(".order-notifi_phone_number").text("Số điện thoại không được để trống");
    }
    if (customerEmail.val() === "") {
      isCheck = true;
      $(".order-notifi_email").text("Email không được để trống");
    }
  
    if (isCheck) {
      return;
    }
  
    // Gửi Ajax
    $.ajax({
      type: "POST",
      url: "../../du_an1/index.php?action=order_handle",
      data: {
        customerId: customerId.val(),
        customerfirstAndLastName: customerfirstAndLastName.val(),
        customerAddress: customerAddress.val(),
        customerNumberPhone: customerNumberPhone.val(),
        customerEmail: customerEmail.val(),
        customerNote: customerNote.val(),
        pay_methods: paymenMethod,
      },
      dataType: "json",
      success: function (response) {
        console.log(response)
        reloadShowQuantity();
        if(response === 'block'){
          alert('Tài khoản của bạn đã bị khóa vui lòng liên lạc tới chúng tôi để biết thêm chi tiết.')
        }else{
          if (typeof response === "number") {
            $("#payMenttotalPrice").val(response);
            $("#startPayment").click();
          } else {
            alert("Đặt hàng thành công, đang xử lý đơn hàng");
            setTimeout(() => {
              location.href = `/du_an1/order_details_infomation?id=1`;
            }, 1);
          }
        }
      },
      error: function (error) {
        console.log("Lỗi khi gửi đơn hàng:", error);
      },
    });
  });
  
  
  $(".cancel_order").on("click", function () {
    const that = this;
    let ischeck = confirm("Bạn có muốn hủy đơn hàng ?");
    let orderId = $(that).attr("order_id");
    let statusId = $(that).attr("status_id");

    // console.log(orderId);
    if (ischeck) {
      $.ajax({
        type: "POST",
        url: "../../du_an1/index.php?action=cancel_order",
        data: {
          orderId: orderId,
          statusId: statusId
        },
        success: function (responve) {
          console.log(responve);
          if (responve === 0) {
            alert("Xóa thất bại có lỗi");
          } else {
            console.log(responve);
            console.log("Hủy đơn hàng thành công");
            location.reload()
          }
          // location.reload();
        },
        error: function (error) {
          console.log(error);
        },
      });
    }
  });
  $(".receive").on("click", function () {
    const that = this;
    let ischeck = confirm(
      "Bạn xác nhận đã nhận được hàng ?,sau khi xác nhận không thể hoàn trả lại."
    );
    let orderId = $(that).attr("order_id");
    let statusId = $(that).attr("status_id");

    // console.log(orderId);
    if (ischeck) {
      $.ajax({
        type: "POST",
        url: "../../du_an1/index.php?action=receive",
        data: {
          orderId: orderId,
          orderStatus : statusId
        },
        success: function (responve) {
          console.log(responve);
          location.href= './order_details_infomation?id=4'
          console.log("Xác nhận đơn hàng thành công");
        },
        error: function (error) {
          console.log(error);
        },
      });
    }
  });
  let isCheckGetCustomer = false;
  $("#getCustomerInfo").on("click", function () {
    if (isCheckGetCustomer) {
      isCheckGetCustomer = false;
      $(".get_anomyous_customer_info").css("display", "none");
    } else {
      isCheckGetCustomer = true;
      $(".get_anomyous_customer_info").css("display", "block");
    }
  });
});