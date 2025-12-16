$(document).ready(function () {
  let colors = [];
  let sizes = [];
  let itsOK = false;
  let colorAndSizeContainer = [];
  $("#check_color_name_duplicate").on("click", function () {
    // BLACK
    let colorName = $("#color_name");
    console.log(colorName.val());
    if (colorName.val() === "") {
      $(".color_name_notifi").text("Tên màu trống");
      return;
    }
    let colorNameList = $("#color_name_duplicate_list");
    $.ajax({
      type: "POST",
      url: "../../du_an1/admin/index.php?act=check_duplicate_color",
      data: {
        colorName: colorName.val(),
      },
      dataType: "json",
      success: function (responve) {
        console.log(responve);
        // console.log(responve.color_name_id);
        let html = ``;
        for (const item in responve) {
          if (responve.hasOwnProperty(item)) {
            const value = responve[item];
            console.log(value.color_name_id);
            html += `<option value="${value.color_name_id}">${value.color_name} id ${value.color_name_id} ${value.product_name}</option>`;
          }
        }
        colorNameList.html(html);
        colorNameList.append(
          $("<option>", {
            value: `0`,
            text: `Tạo mới`,
          })
        );
      },
      error: function (error) {
        console.log(error);
      },
    });
  });
  // $(".duplication_allowed").on("click", function () {
  //   itsOK = itsOK === false ? true : false;
  //   $("#itsOKValueField").val(itsOK);
  //   if (itsOK) {
  //     $(".notifi").text("Chấp thuận");
  //   } else {
  //     $(".notifi").text("Từ chối");
  //   }
  // });
  $("#submitColorAndSize").on("click", function () {
    let formData = new FormData();
    let fileInput = $("#product_color_image")[0];

    let colorType = $("#add_color_type");
    let colorName = $("#color_name");
    let colorNameId = $("#color_name_duplicate_list");
    if ($("#color_name_duplicate_list").val() === "0") {
      colorName = $("#color_name");
      console.log("1");
      formData.append("colorName", colorName.val());
    } else {
      console.log("2");
      console.log(colorNameId.val());
      formData.append("colorNameId", colorNameId.val());
    }
    let quantity = $("#colorAndSizequantities").val();
    let sizeId = $("#add_size");
    let sizeName = sizeId.find(":selected").text();
    let currentQuantity = 0;
    console.log(fileInput);
    formData.append("colorImage", fileInput.files[0]);
    formData.append("colorType", colorType.val());
    if (colorName.val() === "") {
      $(".color_name_notifi").text("Tên màu trống");
      return;
    }
    // console.log(colorType);
    $.ajax({
      type: "POST",
      url: "../../du_an1/admin/index.php?act=add_color_and_size",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        let isCheckMatch = false;
        console.log(response);
        if (colorAndSizeContainer.length >= 1) {
          for (let i = 0; i < colorAndSizeContainer.length; i++) {
            const sizeIdIndex = 2;
            const colorNameIndex = 1;
            let checkSameColorDiffSize = colorAndSizeContainer[i][sizeIdIndex];
            let colorExist = colorAndSizeContainer[i][colorNameIndex];
            if (
              colorExist === colorName.val() &&
              checkSameColorDiffSize === Number(sizeId.val())
            ) {
              isCheckMatch = true;
            }
          }
        }
        if (response.status && isCheckMatch) {
          if (colorAndSizeContainer.length >= 1) {
            for (let i = 0; i < colorAndSizeContainer.length; i++) {
              const colorNameIndex = 1;
              const sizeQuantityIndex = 4;
              const colorNameIdIndex = 0;
              const sizeIdIndex = 2;
              let colorExist = colorAndSizeContainer[i][colorNameIndex];
              let checkSameColorDiffSize =
                colorAndSizeContainer[i][sizeIdIndex];
              if (
                colorExist === colorName.val() &&
                checkSameColorDiffSize === Number(sizeId.val())
              ) {
                console.log("I'm work");
                let newQuantities = $("#colorAndSizequantities").val();
                colorAndSizeContainer[i][sizeQuantityIndex] +=
                  Number(newQuantities);
                let showSizeQuantity =
                  colorAndSizeContainer[i][sizeQuantityIndex];
                currentColorNameId = colorAndSizeContainer[i][colorNameIdIndex];
                updateColorAndSize();
                // update lại số lượng nếu trùng
                currentQuantity =
                  showSizeQuantity !== 0 ? showSizeQuantity : newQuantities;
                let queryColorNameId = $(
                  `[color-and-size-id=c${currentColorNameId}s${colorAndSizeContainer[i][sizeIdIndex]}]`
                );
                queryColorNameId.text(
                  `Color: ${colorName.val()} | Size: ${sizeName} | Số lượng: ${currentQuantity}`
                );
              }
            }
          } //else {
          //   console.log("I'm runing !!!");
          //   let colorAndSizeElement = `<span class="color-name" style="padding: 6px 12px;margin-bottom: 8px;display: inline-flex;align-items: center;border: 1px solid #dedede;border-radius: 4px;
          //   margin-right:4px;">
          //   <span color-name-id=c${response.color_name_id}s${sizeId.val()} style="font-size: 1rem;margin-right: 12px;">Color: ${response.color_name} | Size: ${sizeName} | Số lượng: ${quantity}</span>
          //   <i class="fa-solid fa-circle-xmark delete-color-name" style="color: #ff0000;font-size: 1.6rem;cursor: pointer;"></i>
          //   </span>`;
          //   $("#showNewColorAndSize").append(colorAndSizeElement);
          //   let colorAndSizeInfo = [
          //     response.color_name_id,
          //     response.color_name,
          //     Number(sizeId.val()),
          //     sizeName,
          //     Number(quantity),
          //   ];
          //   colorAndSizeContainer.push(colorAndSizeInfo);
          //   handleDelete();
          //   $("#color_quantities").val("");
          //   updateColorAndSize();
          // }
        } else {
          console.log("I'm here");
          let colorAndSizeElement = `<span class="color-name" style="padding: 6px 12px;margin-bottom: 8px;display: inline-flex;align-items: center;border: 1px solid #dedede;border-radius: 4px;
            margin-right:12px;">
            <span color-and-size-id=c${
              response.color_name_id
            }s${sizeId.val()}  style="font-size: 1rem;margin-right: 12px;user-select: none;">Color: ${
            response.color_name
          } | Size: ${sizeName} | Số lượng: ${quantity}</span>
            <i class="fa-solid fa-circle-xmark delete-color-name" style="color: #ff0000;font-size: 1.6rem;cursor: pointer;"></i>
            </span>`;
          $("#showNewColorAndSize").append(colorAndSizeElement);
          let colorAndSizeInfo = [
            response.color_name_id,
            response.color_name,
            Number(sizeId.val()),
            sizeName,
            Number(quantity),
            `c${response.color_name_id}s${sizeId.val()}`,
          ];
          colorAndSizeContainer.push(colorAndSizeInfo);
          handleDelete();
          $("#color_quantities").val("");
          updateColorAndSize();
        }
        // for (let i = 0; i < colors.length; i++) {
        //   let colorNameIndex = 2;
        //   let colorContain = colors[i][colorNameIndex];
        //   colorContain = colorContain.toLowerCase();
        //   let responseColorName = response.color_name;
        //   responseColorName = responseColorName.toLowerCase();
        //   if (colorContain === responseColorName) {
        //     $("#showColorMessage").text("Màu này đã hiện tại đã có!");
        //     // Xóa dữ liệu trùng trên database
        //     $.ajax({
        //       type: "POST",
        //       url: "../../du_an1/admin/index.php?act=delete_color_name",
        //       data: {
        //         getColorNameId: response.color_name_id,
        //       },
        //       success: function () {
        //         console.log("Thành công xóa màu đã trùng");
        //       },
        //       error: function (error) {
        //         console.log("Lỗi khi gửi dữ liệu:", error);
        //       },
        //     });
        //     return;
        //   }
        // }
        // let colorAndSizeElement = `<span class="color-name" style="padding: 6px 12px;margin-bottom: 8px;display: inline-flex;align-items: center;border: 1px solid #dedede;border-radius: 4px;
        // margin-right:4px;">
        // <span color-name-id=${response.color_name_id} style="font-size: 1rem;margin-right: 12px;">Color: ${response.color_name} | Size: ${sizeName} | Số lượng: ${quantity}</span>
        // <i class="fa-solid fa-circle-xmark delete-color-name" style="color: #ff0000;font-size: 1.6rem;cursor: pointer;"></i>
        // </span>`;
        // $("#showNewColorAndSize").append(colorAndSizeElement);
        // let colorAndSizeInfo = [
        //   response.color_name_id,
        //   response.color_name,
        //   sizeId.val(),
        //   sizeName,
        //   Number(quantity),
        // ];
        // colorAndSizeContainer.push(colorAndSizeInfo);
        // // handleDeleteColor(response.color_name_id);
        // $("#color_quantities").val("");
        // updateColorAndSize();
      },
      error: function (error) {
        console.log("Lỗi khi gửi dữ liệu:", error);
      },
    });
  });
  function updateColorAndSize() {
    $("#colorAndSizeInfo").val(JSON.stringify(colorAndSizeContainer));
  }
  // function updateColor() {
  //   $("#color_input").val(JSON.stringify(colors));
  // }
  function handleDelete() {
    $(".delete-color-name").on("click", function () {
      let that = this;
      let getColorNameId = $(that).prev().attr("color-and-size-id");
      for (let i = 0; i < colorAndSizeContainer.length; i++) {
        let indexToDelete = i;
        const colorAndSizeId = 5;
        let elementNeedDelete = colorAndSizeContainer[i][colorAndSizeId];
        if (elementNeedDelete === getColorNameId) {
          colorAndSizeContainer.splice(indexToDelete, 1);
          break;
        }
      }
      $(that).parent().remove();
      updateColorAndSize();
    });
  }
  // function updateSize() {
  //   $("#size_input").val(JSON.stringify(sizes));
  // }
  // function handleDeleteSize() {
  //   $(".delete-size-name").on("click", function () {
  //     let that = this;
  //     let sizeId = $(that).prev().attr("size-name-id");
  //     for (let i = 0; i < sizes.length; i++) {
  //       let indexToDelete = i;
  //       let sizeNeedToDelete = sizes[i][0];
  //       if (sizeNeedToDelete === Number(sizeId)) {
  //         sizes.splice(indexToDelete, 1);
  //         break;
  //       }
  //     }
  //     $(that).parent().remove();
  //     updateSize();
  //   });
  // }
  // $("#submitSize").on("click", function () {
  //   let sizeValue = $("#add_size");
  //   let sizeQuantities = $("#sizeQuantities").val();
  //   let sizeName = sizeValue.find(":selected").text();
  //   let sameSize = 0;
  //   let currentSize = 0;
  //   let currentSizeId = 0;
  //   if (sizes.length >= 1) {
  //     const quantitiesIndex = 1;
  //     const colorNameIdIndex = 0;
  //     for (let i = 0; i < sizes.length; i++) {
  //       let sizeNameIndex = 0;
  //       let sizeContain = sizes[i][sizeNameIndex];
  //       if (sizeContain === Number(sizeValue.val())) {
  //         let newSizeQuantities = $("#sizeQuantities").val();
  //         sizes[i][quantitiesIndex] += Number(newSizeQuantities);
  //         sameSize = sizes[i][quantitiesIndex];
  //         currentSizeId = sizes[i][colorNameIdIndex];
  //         // $("#showSizeMessage").text(
  //         //   `Trùng size, Size ${sizeName} được cộng dồn lên ${sizes[i][quantitiesIndex]}`
  //         // );
  //         // setTimeout(function () {
  //         //   $("#showSizeMessage").text("");
  //         // }, 3000);
  //         updateSize();
  //         // update lại số lượng nếu trùng
  //         currentSize = sameSize !== 0 ? sameSize : sizeQuantities;
  //         let querySizeNameId = $(`[size-name-id=${currentSizeId}]`);
  //         querySizeNameId.text(`Size: ${sizeName} Số lượng: ${currentSize}`);
  //         return;
  //       }
  //     }
  //   }
  //   let size = `<span class="size-name" style="padding: 6px 12px;margin-bottom: 8px;user-select:none;margin-right:6px;display: inline-flex;align-items: center;border: 1px solid #dedede;border-radius: 4px;">
  //   <span size-name-id=${sizeValue.val()} style="font-size: 1rem;margin-right: 12px;">Size: ${sizeName} Số lượng: ${sizeQuantities}</span>
  //   <i class="fa-solid fa-circle-xmark delete-size-name" style="color: #ff0000;font-size: 1.6rem;cursor: pointer;"></i>
  //   </span>`;
  //   $("#showNewSize").append(size);
  //   let sizeInfo = [Number(sizeValue.val()), Number(sizeQuantities)];
  //   sizes.push(sizeInfo);
  //   // $("#sizeQuantities").val("");
  //   handleDeleteSize();
  //   updateSize();
  // });
});
