<?php require "./header.php" ?>
<div class="main">
    <div class="main-content dashboard">
        <a href="./index.php?act=ngay" class="mb-4">
            <button class="btn btn-primary">Thống kê ngày</button>
        </a>
        <a href="./index.php?act=thang" class="mb-4">
            <button class="btn btn-primary">Thống kê tháng</button>
        </a>
        <span class="<?= isset($_COOKIE['notification']) ? "noti-success" : "" ?> ">
            <?= $notification = isset($_COOKIE['notification']) ? $_COOKIE['notification'] : ""; ?>
        </span>
        <table id="example" class="table table-bordered table-hover" style="width:100%">
            <thead>
                <!-- <tr class="table-primary"> -->
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Mã sản phẩm</th>
                    <th>Số lượng bán</th>
                    <th>Số lượng hàng tồn kho</th>
                    <th>Giá nhập</th>
                    <th>Mã giảm giá</th>
                    <th>Thành tiền</th>
                    <th>Doanh thu</th>
                </tr>
            </thead>
            <tbody>
                <?php
  
                    
                    
                    $sum_quantity_product=sum_product_quantities();
                    
                    foreach ($sum_quantity_product as $quan) {
                        $x=$quan['product_id'];
                     
                        $hangban=sum_product_order($x);

                                
                          
                           
                                
                                 
                ?>
                    <tr>
                        <?php

                        ?>
                        <td><?php if($name= select_all_product_by_d($x)) echo $name['product_name']?></td>
                        <td><?php if($name= select_all_product_by_d($x)) echo $name['product_code']?></td>
                        <td><?php  if(isset($hangban['soluongban'])){echo $hangban['soluongban'];}else{echo "0";}?></td>
                        <td>
                        <?php   $hangton=sum_product_quantities_by_id($quan['product_id']);
                                echo $hangton['soluongton'];       
                        ?>
                        </td>
                        <td><?php if($name= select_all_product_by_d($x)) echo formatMoney($name['product_price'])?></td>
                        <td><?php if($name= select_all_product_by_d($x)) echo $name['discount']?></td>
                        <td><?php $price=($name['product_price']-($name["product_price"]*($name['discount']/100))); if($name= select_all_product_by_d($x)) echo formatMoney($price) ?></td>
                        <td><?php if(isset($hangban['soluongban'])){$doanhthu =($hangban['soluongban'] * $price); echo formatMoney($doanhthu);}else{echo '0';}?></td>


                        
                    </tr>

                <?php
                    }
                // }

                    $total=total();
                    // foreach ($total as $keys) {
                        extract($total);
                    
                ?>
                <td><h3>Tổng doanh thu :</h3></td>
                <td> <?php echo formatMoney($tong)?></td>
                <td><?php ?></td>
                <?php
                //   }
                 ?> 
            </tbody>
        </table>
        <script>
            $('#example').DataTable();
        </script>
    </div>
</div>

<div class="overlay"></div>
<?php require "./footer.php" ?>


