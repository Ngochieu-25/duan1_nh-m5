<?php require "./header.php" ?>

    <div class="main">
        <div class="main-content dashboard">
            <a href="./index.php?act=view_banner" class="mb-4">
                 <button class="btn btn-primary">Dach sach</button>
            </a>
            <span class="<?= isset($_COOKIE['notification']) ? "noti-success" : "" ?> "><?= $notification = isset($_COOKIE['notification']) ? $_COOKIE['notification'] : ""; ?></span>
            <form action="..<?= $ADMIN_URL . $BANNER_URL; ?>/progess_add_banner.php" method="post" enctype="multipart/form-data" name='form_add_banner' onsubmit="return validateForm_banner()">
                <div class="form-group mb-3 error">
                    <label for="banner_name">Tên banner</label>
                    <input type="text" class="form-control" name="banner_name" id="banner_name">
                    <small></small>
                </div>
                <div class="form-group mb-3 error">
                    <label for="banner_image">Ảnh chính</label>
                    <input type="file" class="form-control" name="banner_image" id='banner_image'  onchange="xulyfile()">
                    <small></small>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Thêm</button>
                    <button type="reset" class="btn btn-warning">Nhập lại</button>
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
function xulyfile(){
    let banner_image = document.querySelector('#banner_image');
   var arr = event.target.files;//mảng các file được chọn
   var f = arr[0];

if(f.size < 50000){
    // showError(banner_image, "trường này không dược bỏ trống")
    // return false;
       console.log(f.size);
}
// else{
//     showSuccess(banner_image);
//     return true;
// }
}
function validateForm_banner(){
    let banner_name = document.querySelector('#banner_name');
    let banner_image = document.querySelector('#banner_image');
 
  let x = document.forms["form_add_banner"]["banner_name"].value;
  let y = document.forms["form_add_banner"]["banner_image"].value;

// var y = $('#banner_image')[0].files[0].size;
// console.log(y.size);
//   let banner = banner_image.target.files;
//   console.log(y);
  if ((x == "") && (y =="")) {
    showError(banner_name, "trường này không dược bỏ trống");
    showError(banner_image, "vui lòng chọn file ảnh.");
    return false;
  }else if(x.length < 5){
    showError(banner_name, "trường này không nhỏ hơn 5 ký tự")
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