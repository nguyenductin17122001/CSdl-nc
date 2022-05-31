               <?php
                if (isset($_SESSION['customer_email'])) {
                    echo ("<b> your email : <b>" . $_SESSION['customer_email']);
                } else {
                    echo ("");
                }
                ?>

            <form class="shopping-cart" action="" method="POST" enctype="multipart/form-data">
                <h3 class ="youcart">Your cart</h3>
                <?php
                    $total = 0;

                    $ip = get_ip();
                    $run_cart = mysqli_query($con, "SELECT * FROM cart where ip_address = '$ip'");
                   if(mysqli_num_rows($run_cart) > 0){
                    while ($fetch_cart = mysqli_fetch_array($run_cart)) {
                        $product_id = $fetch_cart['product_id'];

                        $result_product = mysqli_query($con, "SELECT * FROM products where product_id = '$product_id'");
                        while ($fetch_product = mysqli_fetch_array($result_product)) {
                            $product_price = array($fetch_product['product_price']);
                            $product_title = $fetch_product['product_title'];
                            $product_image = $fetch_product['product_image'];
                            $sing_price = $fetch_product['product_price'];

                            $values = array_sum($product_price);

                            //xuất ra chất lượng của sản phẩm
                            $run_qty = mysqli_query($con, "SELECT * FROM cart where product_id='$product_id'");
                            $row_qty = mysqli_fetch_array($run_qty);

                            $qty = $row_qty['quality'];
                            $values_qty = $values * $qty;

                            $total += $values_qty;
                    
                    ?> 
          
            <div class="box">
              <a href="index.php?delete_cart=<?php echo($product_id) ?>"><i class="fas fa-trash"></i></a>
                <img src="admin/public/product_images/<?php echo($product_image) ?>" alt="">
                <div class="content">
                    <h3><?php echo($product_title) ?></h3>
                    <span class="price"><?php echo($values_qty)."$" ?>/-</span>
                    <span class="quantity">quantity :<input type="hidden" name="product_id[]" value="<?php echo($product_id) ?>"> <input type="number" size="1" min="1" max="100" name="quality[]" onkeydown="return false" value="<?php echo($qty)?>"></span>
                </div>
                
            </div> 
              <?php }}}
                    else{
                         echo '<p class="empty"> lets do some shopping !</p>';
                        echo '<img  class="shopping" src="./public/image/shopping.png">';
                       
                        } //end while ?>          
            <div class="total"> total : <?php total_price() ?>/-<?php total_items(); ?> </div>
            <input type="submit" name="edit_cart" value="Update cart" class="up <?php echo ($total > 1)?'':'disabled'; ?>" style='cursor: pointer;'>
            <input  type="submit" name="payment" value="Checkout" class="btn <?php echo ($total > 1)?'':'disabled'; ?>">
       </form>
       <?php

                
                
                    // ----------------------------------------------------
                     if (isset($_GET['delete_cart'])) {
                        $delete_cart = mysqli_query($con, "DELETE from cart where product_id='$_GET[delete_cart]' and ip_address = '$ip'");
                                    
                        if ($delete_cart) {
                            echo ("<script>alert('Xoá thành công');</script>");
                            echo ("<script>window.open('products.php','_self')</script>");
                        }
                    }

                    if (isset($_POST['edit_cart'])) {
                        for($i=0;$i<count($_POST['product_id']);$i++){
                        		$product_id = $_POST['product_id'][$i];
                        		$quality = $_POST['quality'][$i];
                                $result_product = mysqli_query($con,"SELECT * FROM products where product_id = '$product_id'");
                                $fetch_product = mysqli_fetch_array($result_product);
                                $quality_pro = $fetch_product['qualitys'];
                        		if($quality <= $quality_pro ){
                        			$edit_cart = mysqli_query($con,"UPDATE cart SET quality='$quality' WHERE product_id='$product_id'");
                                     if ($edit_cart) {
                                          echo("<script>window.open(window.location.href,'_self')</script>");
                                          
                                      }
                        		}
                                else{
                                    echo ("<script>alert('số lượng sản phẩm bạn muốn mua vượt quá sô lượng trong kho')</script>");
                                     echo("<script>window.open(window.location.href,'_self')</script>");
                                }
                        	
                        }
                    
                    }

                    if(isset($_POST['payment'])){
                         if(!isset($_SESSION['email'])){
                                 echo ("<script>alert('bạn cần đăng nhập trước khi thanh toán');</script>");
                                  echo("<script>window.open('products.php','_self')</script>");
                              }    
                        else{
                               if(isset($_POST['payment'])){             
                                 	$user_id = $_SESSION['user_id'];
                                 	$mahang = rand(0,9999);	
                                 	for($i=0;$i<count($_POST['product_id']);$i++){
                                	 		$product_id = $_POST['product_id'][$i];
                                	 		$quality = $_POST['quality'][$i];
                                            $result_product = mysqli_query($con,"SELECT * FROM products where product_id = '$product_id'");
                                            $fetch_product = mysqli_fetch_array($result_product);
                                            $quality_pro = $fetch_product['qualitys'];
                                             $qty =  $quality_pro-$quality;
                                	 		$sql_insert_order = mysqli_query($con,"INSERT INTO orders (product_id,id,quality,mahang) VALUES ('$product_id','$user_id','$quality','$mahang')");
                                	 		$sql_transaction = mysqli_query($con,"INSERT INTO transactions (product_id,quality,magiaodich,id) values ('$product_id','$quality','$mahang','$user_id')");
                                            $edit_pro = mysqli_query($con,"UPDATE products SET qualitys='$qty' WHERE product_id='$product_id'");
                                	 		$sql_delete_thanhtoan = mysqli_query($con,"DELETE FROM cart WHERE product_id='$product_id'");
                                             if ($sql_delete_thanhtoan) {
                                              echo ("<script>alert('Đặt hàng thành công!')</script>");
                                              echo("<script>window.open('payment.php','_self')</script>");
                                          }
                                 		}
                                 }
                        }
                    }
            
               
            ?>
<?php
            // thêm sản phẩm vào cart
            cart();
        ?>