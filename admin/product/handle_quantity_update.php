<?php
$newColorType = $_POST['newColorType'];
$colorImage = $_FILES['colorImage'];
$colorImageTmpName = $colorImage['tmp_name'];
$newColorName = $_POST['newColorName'];
$colorNameId = $_POST['colorNameId'];
$oldImage = $_POST['oldImage'];
$newSize = $_POST['newSize'];
$oldSizeId = $_POST['oldSizeId'];
$newQuantity = $_POST['newQuantity'];
$product_id = $_POST['productId'];
$quantityId = $_POST['quantityId'];
// $color_result = select_all_color();
// $size_result = select_all_size();

$save_img = "";
if ($colorImage['size'] == 0) {
    $save_img = $oldImage;
}else {
    unlink("../../du_an1" . $oldImage);
    $save_img = add_image_js_version($colorImage, $colorImageTmpName, $ASSET_URL);
}
update_color_name($newColorName,$save_img,$newColorType,$colorNameId);
update_size_by_size_id($newSize,$oldSizeId,$product_id);
quantities_update_size_quantity($newQuantity,$newSize,$product_id,$quantityId);
