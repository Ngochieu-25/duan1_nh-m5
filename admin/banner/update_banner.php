<?php require "./header.php" ?>

    <div class="main">
        <div class="main-content dashboard">
            <a href="./index.php?act=view_banner" class="mb-4">
                 <button class="btn btn-primary">Dach sach</button>
            </a>
            <span class="<?= isset($_COOKIE['notification']) ? "noti-success" : "" ?> ">
                <?= $notification = isset($_COOKIE['notification']) ? $_COOKIE['notification'] : ""; ?>
            </span>
            <!-- Select product by id -->
            <?php
            if (isset($_GET['banner_id'])) {
                $banner_id = $_GET['banner_id'];
                $banner_result = select_banner_by_id($banner_id);
            ?>
                <form action="..<?= $ADMIN_URL . $BANNER_URL; ?>/progess_update_banner.php" method="post" enctype="multipart/form-data"  name='form_add_banner' onsubmit="return validateForm_banner()">
                    <input type="hidden" name="banner_id" value="<?= $banner_id; ?>">
                    <div class="form-group mb-3 error">
                        <label for="banner_name">Tên sản phẩm</label>
                        <input type="text" class="form-control" value="<?= $banner_result['banner_name']; ?>" name="banner_name" id="banner_name">
                        <small></small>
                    </div>
                    <div class="form-group mb-3 error">
                        <label>
                            Ảnh cũ
                        </label>
                        <div class="mb-3">
                            <img src="../..<?= $ROOT_URL ?><?= $banner_result['banner_image'] ?>" width="100px" alt="">
                        </div>
                        <label for="banner_main_image">Ảnh chính</label>
                        <input type="file" class="form-control" name="banner_main_image" id="banner_main_image" multiple onchange="xulyfile()">
                        <small></small>
                        <input type="hidden" name="old_main_image" value="<?= $banner_result['banner_image'] ?>">
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Sửa</button>
                        <button type="reset" class="btn btn-warning">Nhập lại</button>
                    </div>
                </form>
            <?php } else { ?>
                <?= "Không có id" ?>
            <?php } ?>
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
function xulyfile(){
    let banner_image = document.querySelector('#banner_main_image');
   var arr = event.target.files;//mảng các file được chọn
   var f = arr[0];

if(f.size > 50000){
    showError(banner_image, "file quá lớn không thể up lên.")
    return false;
    //    console.log(f.size);
}else{
    showSuccess(banner_image);
    return true;
}
}


function validateForm_banner(){
    let banner_name = document.querySelector('#banner_name');
    let banner_image = document.querySelector('#banner_main_image');
 
  let x = document.forms["form_add_banner"]["banner_name"].value;
  let y = document.forms["form_add_banner"]["banner_main_image"].value;

// var y = $('#banner_image')[0].files[0].size;
// console.log(y.size);
//   let banner = banner_image.target.files;
//   console.log(y);
  if (x == "") {
    showError(banner_name, "trường này không dược bỏ trống");
    // showError(banner_image, "vui lòng chọn file ảnh.");
    return false;
  }else if(x.length < 5){
    showError(banner_name, "trường này không nhỏ hơn 5 ký tự")
    return false;
  }else if(y ==""){
    showError(banner_image, "vui lòng chọn file ảnh.");
    return false;
}else{
    showSuccess(banner_name);
    showSuccess(banner_image);
    return true;

}
  //   else if(y ==""){

//     return false;
//   }

  
}
    </script>