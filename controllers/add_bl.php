        <?php
                include "../model/pdo.php";
                include "../model/product.php";
                include "../model/comment.php";
                include "../model/taikhoan.php";
                session_start();

              if (isset($_POST['guibinhluan'])) {
                $content = $_POST['content'];
                $id = $_SESSION['username']['id'];
                $ten_user = loadone_taikhoan($id);
                $product_id = $_POST['product_id'];
                $comment_time = date('Y-m-d');
                insert_comment($content, $id, $product_id, $comment_time);
                }
                header("location: ../index.php?action=product_detail&product_id=$product_id");
              ?>
          </div>