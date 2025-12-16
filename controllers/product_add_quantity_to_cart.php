<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if (isset($_POST['type'])) {
    $type = $_POST['type'];
    $remainingAmount = (int)$_POST['remainingAmount'];
    $currentQuantity = (int)$_POST['currentQuantity'];
    if ($type == 'increase') {
        if ($currentQuantity < $remainingAmount) {
            $currentQuantity++;
        }
    } else {
        if ($currentQuantity > 1) {
            $currentQuantity--;
        }
    }
    echo $currentQuantity;
}
