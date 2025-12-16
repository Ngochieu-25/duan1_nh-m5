<?php require "./header.php" ?>
<!--  Phàn content -->
<div class="main">
    <div class="main-content dashboard">
        <?php if (is_array($tk)) {
            extract($tk);
            $hinhpath = "../asset/images/" . $image_user;
            if (is_file($hinhpath)) {
                $image_user = "<img src='" . $hinhpath . "' height='80'>";
            } else {
                $image_user = "no photo";
            }
        } ?>
        <form action="index.php?act=updatetk" method="post" enctype="multipart/form-data">
            <!-- id -->
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">ID</label>
                <input type="text" name="id" class="form-control" disabled value="<?= $id ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <br>
            <!-- Họ và tên -->
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Họ và tên</label>
                <input type="text" name="full_name" class="form-control" value="<?= $full_name ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <!-- Username -->
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="<?= $username ?>" id="exampleInputPassword1">
            </div>
            <!-- Password -->
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="text" name="password" class="form-control" value="<?= $password ?>" id="exampleInputPassword1">
            </div>
            
            <!-- Email -->
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Email</label>
                <input type="text" name="email" class="form-control" value="<?= $email ?>" id="exampleInputPassword1">
            </div>
            <!-- Address-->
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                <input type="text" name="address" value="<?= $address ?>" class="form-control" id="exampleInputPassword1">
            </div>
            <!--Số điện thoại -->
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Số điện thoại</label>
                <input type="text" name="phone" value="<?= $phone ?>" class="form-control" id="exampleInputPassword1">
            </div>
            <br>
            <!-- Vai trò -->
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Vai trò: <strong> <?php if ($role == 1) {
                                                                                                    echo "Quản trị viên";
                                                                                                } else echo "Người dùng" ?></strong></label> <br>
                <select name="role" id="">
                    <?php $arr = array('1' => "Quản trị", '0' => "Người dùng"); ?>
                    <?php foreach ($arr as $key => $value) { ?>
                        <option value="<?= $key ?>" <?= $key == $role ? 'selected' : '' ?>><?= $value ?></option>
                    <?php } ?>
                </select>
            </div>
            <br>
            <!-- Button -->
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="submit" class="btn btn-primary" name="updatetk" value="Cập nhật"></input>
            <a href="./index.php?act=user"><input type="button" class="btn btn-success" value="Danh sách"></input></a> <br>
            <?php if (isset($thongbao) && ($thongbao != "")) echo $thongbao;  ?>
        </form>
    </div>
</div>