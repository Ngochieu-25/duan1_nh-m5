<?php require "./header.php" ?>

<div class="main">
    <div class="main-content dashboard">
        <a href="./index.php?act=view_product" class="mb-4">
            <button class="btn btn-primary">Danh sách</button>
        </a>
        <span class="<?= isset($_COOKIE['notification']) ? "noti-success" : "" ?> "><?= $notification = isset($_COOKIE['notification']) ? $_COOKIE['notification'] : ""; ?></span>
        <form action="..<?= $ADMIN_URL . $PRODUCT_URL; ?>/progess_add_product.php" method="post" enctype="multipart/form-data" name='form_add_product' onsubmit=" return validateForm_banner()">
            <div class="form-group mb-3 error">
                <label for="product_name">Tên sản phẩm</label>
                <input type="text" class="form-control" name="product_name" id="product_name" >
                <small></small>
            </div>
            <div class="form-group mb-3 error">
                <label for="product_code">Mã sản phẩm</label>
                <input type="text" class="form-control" name="product_code" id="product_code" >
                <small></small>
            </div>
            <div class="form-group mb-3">
                <label>Giới tính</label><br>
                <input type="radio" name="product_gender" id="male" value="0" checked >
                <label for="male" class="gender">Nam</label>
                <input type="radio" name="product_gender" id="female" value="1" >
                <label for="female" class="gender">Nữ</label>
            </div>
            <div class="form-group mb-3 error">
                <label for="product_price">Giá sản phẩm</label>
                <input type="number" class="form-control" name="product_price" id="product_price" >
                <small></small>
            </div>
            <div class="form-group mb-3 error">
                <label for="product_discount">Giảm giá</label>
                <input type="number" class="form-control" name="product_discount" min="0" max="99" id="product_discount" >
                <small></small>
            </div>
            <!-- <div class="form-group mb-3">
                <label for="product_quantity">Số lượng kích cỡ</label>
                <input type="number" class="form-control" id="sizeQuantities" required>
            </div> -->
            <!-- <div class="form-group mb-3">
                <div id="showSizeMessage" style="color:red"></div>
                <div id="showNewSize">

                </div>
                <input type="text" id="size_input" name="size_info">
                <i class="fa-solid fa-square-plus" id="submitSize" style="color: #05a34a;cursor: pointer;font-size: 2.4rem;"></i>
            </div> -->
            <div class="form-group mb-3 error">
                <label for="product_color">Loại màu</label>
                <?php $color_result = select_all_color(); ?>
                <select class="form-control" name="color_type" id="add_color_type">
                    <?php foreach ($color_result as $value) : ?>
                        <option value="<?= $value['color_type_id']; ?>"><?= $value['color_type_name'] ?></option>
                    <?php endforeach ?>
                </select>
                <input type="hidden" name="hidden_color_type" id="hidden_color_type">
                <small></small>
            </div>
            <div class="form-group mb-3 error">
                <label for="color_name">Tên màu:</label><br>
                <!-- <div style="display: fle;align-items: baseline;"> -->
                    <!-- <span style="margin-bottom: 12px;display: inline-block;margin-right: 12px;">Tạo ra tên 1 màu trùng nhưng khác sản phẩm ?</span> -->
                    <!-- <i class="fa-solid fa-square-check duplication_allowed" style="color: #1aa82b;font-size: 2rem;cursor: pointer;user-select: none;"></i>
                    <span class="notifi"></span>
                    <input type="hidden" id="itsOKValueField"> -->
                <!-- </div> -->
                <input type="text" class="form-control" name="color_name" id="color_name">
                <small></small>
                <span class="color_name_notifi" style="color:red"></span><br>
                <button type="button" class="btn btn-warning" id="check_color_name_duplicate">Kiểm tra trùng</button>
                <select name="" id="color_name_duplicate_list">
                    <option value="0">Tạo mới</option>
                </select>
            </div>
            <div class="form-group mb-3 error">
                <label for="product_color_image">Ảnh Màu</label>
                <input type="file" class="form-control" name="color_image" id="product_color_image" onchange="xulyfile_anhmau()">
                <small></small>
            </div>
            <div class="form-group mb-3">
                <label for="product_size">Kích cỡ</label>
                <?php $size_result = select_all_size(); ?>
                <select class="form-control" name="product_size" id="add_size">
                    <?php foreach ($size_result as $value) : ?>
                        <option value="<?= $value['size_id']; ?>"><?= $value['size_name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group mb-3 error">
                <label for="color_quantities">Số lượng</label>
                <input type="number" class="form-control" id="colorAndSizequantities" name='colorAndSizequantities'>
                <small></small>
            </div>
            <div class="form-group mb-3">
                <div id="showMessage" style="color:red"></div>
                <div id="showNewColorAndSize">

                </div>
                <input type="hidden" id="colorAndSizeInfo" name="colorAndSizeInfo">
                <i class="fa-solid fa-square-plus" id="submitColorAndSize" style="color: #05a34a;cursor: pointer;font-size: 2.4rem;"></i>
            </div>
            <div class="form-group mb-3 error">
                <label for="product_main_image">Ảnh chính</label>
                <input type="file" class="form-control" name="product_main_image" id="product_main_image" onchange="xulyfile_anhchinh()">
                <small></small>
            </div>
            <div class="form-group mb-3 error">
                <label for="product_hover_main_image">Ảnh phụ</label>
                <input type="file" class="form-control" name="product_hover_main_image" id="product_hover_main_image" onchange="xulyfile_anhphu()">
                <small></small>
            </div>
            <!-- <div class="form-group mb-3">
                <label for="product_main_image">Chi tiết ảnh sản phẩm</label>
                <input type="file" class="form-control" name="product_detail_image[]" id="product_detail_image" multiple>
            </div> -->
            <div class="form-group mb-3 error">
                <label for="product_desc">Mô tả</label>
                <input type="text" class="form-control" rows="6" name="product_desc" id="product_desc"></input>
                <!-- <input type="hidden" name="hidden_product_desc" id='hidden_product_desc'> -->
                <small></small>
            </div>
            <div class="form-group mb-3 error">
                <label for="product_cat_id">Loại sản phẩm</label>
                <!-- Select product caregory id -->
                <select name="product_cat_id" id="product_cat_id" class="form-control">
                    <?php $category_result =  listCategory(); ?>
                    <?php foreach ($category_result as $value) : ?>
                        <option value="<?= $value['id_category'] ?>"><?= $value['name_category'] ?></option>
                    <?php endforeach ?>
                </select>
                <input type="hidden" name="hidden_product_cat_id">
                <small></small>
            </div>
            <div class="mt-3">
                <button type="submit" name='addProduct' class="btn btn-success">Thêm</button>
                <button type="reset" class="btn btn-warning">Nhập lại</button>
                <a href="./index.php?act=view_product" class="mb-4">
                    <button type="button" class="btn btn-primary">Danh sách</button>
                </a>
            </div>
        </form>
    </div>
</div>

<div class="overlay"></div>
<script>

           
function  showError(input, message) 
{
    let parent = input.parentElement;
    let small = parent.querySelector('small');
    parent.classList.add('error')
    small.innerText = message
}

function  showSuccess(input) 
{
    let parent = input.parentElement;
    let small = parent.querySelector('small');
    parent.classList.remove('error')
    small.innerText = ''
}



// function checkRong(listInput) 
// {
//     let isEmpty = false
//     listInput.forEach(input => {
//        input.value = input.value.trim()
       
//        if(!input.value){
//         isEmpty = true;
//         showError(input, "trường này không được để trống.")

//        }else{
//         showSuccess(input)
//        }
//     });

//     return isEmpty
// }




function xulyfile_anhmau(){
    let banner_image = document.querySelector('#color_image');
   var arr = event.target.files;//mảng các file được chọn
   var f = arr[0];
   let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
if(f.size > 50000){
    showError(banner_image, "file quá lớn không thể up lên.")
    return false;
    //    console.log(f.size);
}else if(!allowedExtensions.exec(banner_image.value)){
    showError(banner_image, "file không dúng định dạng .")
    return false;
}else{
    showSuccess(banner_image);
    return true;
}
}

function xulyfile_anhchinh(){
    let banner_image = document.querySelector('#product_main_image');
   var arr = event.target.files;//mảng các file được chọn
   var f = arr[0];
   let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
// console.log(f);
if(f.size > 50000){
    showError(banner_image, "file quá lớn không thể up lên.")
    return false;
    //    console.log(f.size);
}else if(!allowedExtensions.exec(banner_image.value)){
    showError(banner_image, "file không dúng định dạng .")
    return false;
}else{
    showSuccess(banner_image);
    return true;
}
}

function xulyfile_anhphu(){
    let banner_image = document.querySelector('#product_hover_main_image');
   var arr = event.target.files;//mảng các file được chọn
   var f = arr[0];
   let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
if(f.size > 50000){
    showError(banner_image, "file quá lớn không thể up lên.")
    return false;
    //    console.log(f.size);
}else if(!allowedExtensions.exec(banner_image.value)){
    showError(banner_image, "file không dúng định dạng .")
    return false;
}else{
    showSuccess(banner_image);
    return true;
}
}


function validateForm_banner(){

    // e.preventDefault();
    let product_name = document.querySelector('#product_name');
  let product_namee = document.forms["form_add_product"]["product_name"];
  let product_code = document.querySelector('#product_code');
  let product_codee = document.forms["form_add_product"]["product_code"];
  let product_price = document.querySelector('#product_price');
  let product_pricee = document.forms["form_add_product"]["product_price"];
  let product_discount = document.querySelector('#product_discount');
  let product_discounte = document.forms["form_add_product"]["product_discount"];

  let hidden_color_type = document.querySelector('#hidden_color_type');
  let color_type = document.forms["form_add_product"]["color_type"];

  let color_name = document.querySelector('#color_name');
  let color_namee = document.forms["form_add_product"]["color_name"];
  let color_image = document.querySelector('#color_image');
  let color_imagee = document.forms["form_add_product"]["color_image"];
  let colorAndSizequantities = document.querySelector('#colorAndSizequantities');
  let colorAndSizequantitiese = document.forms["form_add_product"]["colorAndSizequantities"];
  let product_main_image = document.querySelector('#product_main_image');
  let product_main_imagee = document.forms["form_add_product"]["product_main_image"];
  let product_hover_main_image = document.querySelector('#product_hover_main_image');
  let product_hover_main_imagee = document.forms["form_add_product"]["product_hover_main_image"];

  let hidden_product_desc = document.querySelector('#hidden_product_desc');
  let product_desc = document.forms["form_add_product"]["product_desc"];
  let hidden_product_cat_id = document.querySelector('#hidden_product_cat_id');
  let product_cat_id = document.forms["form_add_product"]["product_cat_id"];



let listInput = [product_namee,product_codee,product_pricee,product_discounte,color_namee,color_imagee,colorAndSizequantitiese,product_main_imagee,product_hover_main_imagee,product_desc] ;


 let isEmpty = false
    listInput.forEach(input => {
       input.value = input.value.trim()
    //    console.log(input.value.length);
       if(!input.value){
        isEmpty = false;
        showError(input, "trường này không được để trống.")
        // return isEmpty;
       }else if(input.value.length < 5){
        isEmpty = false;
        showError(input, "trường này không được nhỏ hơn 5 ký tự.")
       }else{
        showSuccess(input)
        // isEmpty = true;
       }
    });
    return isEmpty;


  
}
</script>
<?php require "./footer.php" ?>