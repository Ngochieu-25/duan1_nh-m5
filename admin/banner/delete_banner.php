<?php
$banner_id = $_GET['banner_id'];
if(isset($banner_id)){
    delete_banner($banner_id);
}
include "./banner/bannerList.php";