<?php
session_start();
require "../global.php";
require "..$MODEL_URL/pdo.php";
require "..$MODEL_URL/product.php";
require "..$MODEL_URL/banner.php";
require "..$MODEL_URL/category.php";
require "..$MODEL_URL/taikhoan.php";
require "..$MODEL_URL/comment.php";
require "..$MODEL_URL/orders.php";

if (isset($_SESSION['username']) && ($_SESSION['username']['role'] == 1)) {
    $act = isset($_GET['act']) ? $_GET['act'] : 'index';
    switch ($act) {
        case 'index':
            require "./view/main.php";
            break;
            // ---------------Xử lí Banner-------------------    
        case 'add_banner':
            require ".$BANNER_URL/add_banner.php";
            break;
        case 'view_banner':
            require ".$BANNER_URL/bannerList.php";
            break;
        case 'update_banner':
            require ".$BANNER_URL/update_banner.php";
            break;
        case 'delete_banner':
            require ".$BANNER_URL/delete_banner.php";
            break;
            // ---------------Xử lí Sản Phẩm-------------------    
        case 'add_product':
            require ".$PRODUCT_URL/add_product.php";
            break;
        case 'view_product':
            require ".$PRODUCT_URL/product_list.php";
            break;
        case 'update_product':
            require ".$PRODUCT_URL/update_product.php";
            break;
        case 'add_color_and_size':
            require ".$PRODUCT_URL/handle_add_color_and_size.php";
            break;
        case 'delete_color_name':
            require ".$PRODUCT_URL/handle_delete_color_name.php";
            break;
        case 'show_product_update':
            require ".$PRODUCT_URL/handle_product_quantity_update.php";
            break;
        case 'progress_quantity_update':
            require ".$PRODUCT_URL/handle_quantity_update.php";
            break;
        case 'add_image':
            require ".$PRODUCT_URL/add_image.php";
            break;
        case 'view_image':
            require ".$PRODUCT_URL/image_list.php";
            break;
        case 'detail_image':
            require ".$PRODUCT_URL/detail_image.php";
            break;
        case 'update_detail_image':
            require ".$PRODUCT_URL/update_detail_image.php";
            break;
        case 'delete_detail_image':
            require ".$PRODUCT_URL/delete_detail_image.php";
            break;
        case 'check_duplicate_color':
            require ".$PRODUCT_URL/check_duplicate_color.php";
            break;
            // ---------------Xử lí Comment-------------------
        case 'view_comment':
            require ".$COMMENT_URL/commentList.php";
            break;
        case 'delete_comment':
            require ".$COMMENT_URL/delete_comment.php";
            break;
        case 'add-Category':
            if ((isset($_POST['addCategory'])) && ($_POST['addCategory'])) {
                $name_category = $_POST['name_category'];
                insertCategory($name_category);
                $thongbao = "add thanh cong";
            }
            include "./categories/add-danhmuc.php";
        case 'listCategory':
            $list = listCategory();
            include "./categories/list-danhmuc.php";
            break;
        case "editCategory":
            if (isset($_GET['id_cate']) && ($_GET['id_cate'] > 0)) {
                $id_category = $_GET['id_cate'];
                $list_one = select_one_category($id_category);
            }
            if ((isset($_POST['addCategory'])) && ($_POST['addCategory'])) {
                $id_category = $_POST['id_category'];
                $name_category = $_POST['name_category'];
                update_category($name_category, $id_category);
                $thongbao = "update thanh cong";
            }
            include "./categories/edit-danhmuc.php";
            break;
        case "deleteCategory":
            if (isset($_GET['id_cate']) && ($_GET['id_cate'] > 0)) {
                $id_category = $_GET['id_cate'];
                delete($id_category);
            }
            $list = listCategory();
            include "./categories/list-danhmuc.php";
            break;
            // case "updateCategory":

            //     require "./categories/edit-danhmuc.php";
            //     break;

            //--------------------------PHẦN TÀI KHOẢN-----------------------------------------
            // DANH SÁCH TÀI KHOẢN
        case 'user':
            $listtaikhoan = loadall_taikhoan();
            // echo $listtaikhoan; die;
            include "./user/list.php";
            break;


            // XÓA TÀI KHOẢN
        case 'xoatk':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                delete_taikhoan($_GET['id']);
            }
            $listtaikhoan = loadall_taikhoan();
            include "./user/list.php";
            break;
            // SỬA TÀI KHOẢN
        case 'activetk':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                enable_taikhoan($_GET['id']);
            }
            $listtaikhoan = loadall_taikhoan();
            include "./user/list.php";
            break;
        case 'suatk':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $tk = loadone_taikhoan($_GET['id']);
            }
            $listtaikhoan = loadall_taikhoan();
            include "./user/update.php";
            break;
            // UPDATE TÀI KHOẢN
        case 'updatetk':
            if (isset($_POST['id']) && ($_POST['id'] > 0)) {
                $id = $_POST['id'];
                $full_name = $_POST['full_name'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $phone = $_POST['phone'];
                $role = $_POST['role'];

                $listsanpham = update_taikhoan($id, $full_name, $username, $password, $email, $address, $phone, $role,);
                $thongbao = "Cập nhật thành công";
            }
            $listtaikhoan = loadall_taikhoan();
            include "./user/list.php";
            break;
        case 'add_color':
            require "./product/add_color.php";
            break;
        case 'check-phantrang':
            require "./admin/check-phantrang.php";
            break;
            // ------------------ Orders -------------------
        case 'view_bill':
            require "./bill/bill_list.php";
            break;

        case 'detail_bill':
            require "./bill/bill_detail.php";
            break;
        case 'change_status':
            require "./bill/change_status.php";
            break;

        case 'thongke':
            require_once "./thongke/thongke.php";
            break;
        case 'ngay':
            require_once "./thongke/thongkengay.php";
            break;
        case 'thang':
            require_once "./thongke/thongkeythang.php";
            break;
        default:
            echo "Không có gì ";
            echo "admin";
            break;
    }
} else {
    require "./404not.php";
}