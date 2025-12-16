$(document).ready(function () {
  const responves = {};
  let oldSizeId = 0;
  let quantityId = 0;
  $(".update-color-and-size").on("click", function () {
    let that = this;
    $("#show_color_and_size_update").css("display", "block");

    let productId = $(that).prev().attr("product-id");
    let thisQuantityId = $(that).prev().attr("quantity-id");
    quantityId = thisQuantityId;
    let colorNameId = $(that).prev().attr("color-name-id");
    let sizeId = $(that).prev().attr("size-id");
    let quantity = $(that).prev().attr("data-quantity");
    $.ajax({
      url: "../../du_an1/admin/index.php?act=show_product_update",
      type: "POST",
      data: {
        productId: productId,
        sizeId: sizeId,
        colorNameId: colorNameId,
        quantity: quantity,
      },
      dataType: "json",
      success: function (responve) {
        console.log(responve);
        for (const item in responve) {
          if (responve.hasOwnProperty(item)) {
            const value = responve[item];
            responves[item] = value;
          }
        }
        $("#color_type_update").val(responve.color_type_id);
        $("#color_name_id_update").val(responve.color_type_id);
        $("#color_name_id_update").text(responve.color_type_name);

        $("#color_name_update").val(responve.color_name);
        const oldImage = `../../du_an1${responve.color_image}`;
        $("#old_image").attr("src", oldImage);
        $("#old_image_path").val(`${responve.color_image}`);
        // const targetSizeValue = responve.size_id;
        // let selectedSizeOption = $(
        //   "#size option[value='" + targetSizeValue + "']"
        // );
        // selectedSizeOption.remove();

        $("#size_id_update").val(responve.size_id);
        $("#size_id_update").text(responve.size_name);
        $("#size").val(responve.size_id);
        $("#new_quantity").val(responve.quantity);
        $("#color_name_id").val(responve.color_name_id);
      },
      error: function (error) {
        console.log("Có lỗi trong quá trình thực thi", error);
      },
    });
  });
  $("#QuantityRetype").on("click", function () {
    $("#color_type_update").val(responves.color_type_id);
    $("#color_name_id_update").val(responves.color_type_id);
    $("#color_name_id_update").text(responves.color_type_name);

    $("#color_name_update").val(responves.color_name);
    // const targetSizeValue = responves.size_id;
    // let selectedSizeOption = $(
    //   "#size option[value='" + targetSizeValue + "']"
    // );
    // selectedSizeOption.remove();

    $("#size_id_update").val(responves.size_id);
    $("#size_id_update").text(responves.size_name);
    $("#new_quantity").val(responves.quantity);
    $("#size").val(responves.size_id);
  });
  $("#updateProductCSQ").on("click", function () {
    console.log("OK");
    oldSizeId = $("size").val();

    let newColorType = $("#color_type_update");
    let newColorName = $("#color_name_update");
    let oldImage = $("#old_image_path").val();
    let newSize = $("#size");
    let newQuantity = $("#new_quantity");
    let fileInput = $("#new_color_image")[0];
    let formData = new FormData();
    let colorNameId = $("#color_name_id").val();
    let productId = $(".attr-container").attr("product-id");
    // formData dùng để upload data ảnh và data đi kèm
    if (fileInput !== undefined) {
      formData.append("colorImage", fileInput.files[0]);
    }
    formData.append("productId", productId);
    formData.append("quantityId", quantityId);
    formData.append("oldSizeId", oldSizeId);
    formData.append("newColorType", newColorType.val());
    formData.append("newColorName", newColorName.val());
    formData.append("oldImage", oldImage);
    formData.append("newSize", newSize.val());
    formData.append("newQuantity", newQuantity.val());
    formData.append("colorNameId", colorNameId);

    $.ajax({
      type: "POST",
      url: "../../du_an1/admin/index.php?act=progress_quantity_update",
      data: formData,
      processData: false,
      contentType: false,
      success: function () {
        console.log("Thành công");
        location.reload();
      },
      error: function (error) {
        console.log(error);
      },
    });
  });
});
