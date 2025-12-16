<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");


if (!empty($_POST['Idcz'])) {
    $variantKey = $_POST['Idcz'];
    unset($_SESSION['cart'][$variantKey]);
    if ($_SESSION['count_cart'] > 0) {
        $_SESSION['count_cart']--;
    }
    if (empty($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }
}
if (isset($_SESSION['count_cart'])) {
    echo $_SESSION['count_cart'];
} else {
    echo 0;
}
