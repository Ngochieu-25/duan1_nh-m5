<?php 
if(isset($_SESSION['count_cart'])){
    echo $_SESSION['count_cart'];
}else {
    echo 0;
}