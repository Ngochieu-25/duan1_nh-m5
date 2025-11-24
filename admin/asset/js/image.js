$(document).ready(function () {
  let isCheck = false;
  $(".update-image").on("click", function () {
    // if (isCheck) {
    //   $("#update_image").css("visibility", "hidden");
    //   isCheck = false;
    // } else {
      $("#update_image").css("visibility", "visible");
    //   isCheck = true;
    // }
  });
  $(".delete-image").on("click", function () {
    const that = this;
    let colorNameId = $(that).prev().val();
    let productId = $(that).prev().attr("delete-product-id");
    $.ajax({
      type:"POST",
      url:"../../du_an1/admin/index.php?act=delete_detail_image",
      data:{
        colorNameId:colorNameId,
        productId:productId,
      },
      success:function(result){
        console.log("Thành công",result);
        location.reload();
      },
      error:function(error){
        console.log("Có lỗi",error);
      }
    });
  });
  
});
