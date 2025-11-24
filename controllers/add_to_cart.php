<!-- <?php
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");

        if (isset($_POST['productId'])) {
            $product_id = $_POST['productId'];
            $colorNameId = $_POST['colorId'];
            $sizeId = $_POST['sizeId'];
            $quantity = $_POST['quantity'];
            $addToCart = select_product_by_id($product_id);
            $quantities_result = select_quantity_by_product_id_color_name_id_and_size_id($sizeId, $colorNameId, $product_id);
            $color_name = select_color_name_by_id($colorNameId);
            $size_name = select_size_by_id($sizeId);
            $currentDateTime = date("Y-m-d");
            $variantKey = "i" . $product_id . "c" . $colorNameId . "z".$sizeId;
            
            if (empty($_SESSION['cart'][$variantKey])) {
                $_SESSION['cart'][$variantKey]['product_id'] = (int)$product_id;
                $_SESSION['cart'][$variantKey]['sizeId'] = (int)$sizeId;
                $_SESSION['cart'][$variantKey]['colorNameId'] = (int)$colorNameId;
                $_SESSION['cart'][$variantKey]['product_name'] = $addToCart['product_name'];
                $_SESSION['cart'][$variantKey]['main_image_url'] = $color_name['color_image'];
                // $_SESSION['cart'][$variantKey]['second_image_url'] = $addToCart['hover_main_image_url'];
                $_SESSION['cart'][$variantKey]['product_price'] = (int)$addToCart['product_price'];
                $_SESSION['cart'][$variantKey]['discount'] = $addToCart['discount'];
                $_SESSION['cart'][$variantKey]['date'] = $currentDateTime;
                $_SESSION['cart'][$variantKey]['color_name'] = $color_name['color_name'];
                $_SESSION['cart'][$variantKey]['size_name'] = $size_name['size_name'];
                $_SESSION['cart'][$variantKey]['quantity'] = (int)$quantity;
                $_SESSION['count_cart']++;
                $_SESSION['cart'][$variantKey]['remainingAmount'] = $quantities_result['quantity'];
            } else {
                $_SESSION['cart'][$variantKey]['remainingAmount'] = $quantities_result['quantity'];
                $check_quantity = $quantities_result['quantity'];
                $check_stock = ($_SESSION['cart'][$variantKey]['quantity'] + $quantity) > $check_quantity;
                    if ($_SESSION['cart'][$variantKey]['quantity'] < $check_quantity && !$check_stock) {
                        $_SESSION['cart'][$variantKey]['quantity'] = $_SESSION['cart'][$variantKey]['quantity']  +$quantity;
                    }else{
                        $_SESSION['cart'][$variantKey]['quantity'] = $check_quantity;
                    }
            }
        }
