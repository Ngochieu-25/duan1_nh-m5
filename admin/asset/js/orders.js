$(document).ready(function () {
  function fillColorStatus() {
    let status = $(".status_name").attr("status");
    if (status === "1" || status === "6") {
      $(".status_name").css("color", "#e03033");
    } else {
      $(".status_name").css("color", "#26820b");
    }
  }
  // fillColorStatus();

  $("#status_update").on("click", function () {
    let isCheck = confirm("Xác nhận thay đổi trạng thái ?");
    if (isCheck) {
      let orderStatus = $("#order_status").val();
      let orderId = $(this).attr("order_id");
      // console.log(orderStatus);
      // console.log(orderId);
      $.ajax({
        type: "POST",
        url: "../../du_an1/admin/index.php?act=change_status",
        data: {
          orderStatus: orderStatus,
          orderId: orderId,
        },
        dataType: "json",
        success: function (responve) {
          console.log(responve)
          $(".status_name").attr("status", `${responve.status_id}`);
          $(".status_name").text(responve.status);
          fillColorStatus();
          window.location.reload()
        },
        error: function (error) {
          console.log(error);
        },
      });
    }
  });
});
