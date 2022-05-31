            <?php
                if (isset($_SESSION['customer_email'])) {
                    echo ("<b> your email : <b>" . $_SESSION['customer_email']);
                } else {
                    echo ("");
                }
                ?>
         <form action="" class="cor-form" method="POST" enctype="multipart/form-data">
           <h3>Product liked</h3>
            <?php
            

                    $ip = get_ip();
                    $run_like = mysqli_query($con, "SELECT * FROM likes where ip_address = '$ip'");
                    if(mysqli_num_rows($run_like) > 0){
                    while ($fetch_like = mysqli_fetch_array($run_like)) {
                        $product_id = $fetch_like['product_id'];

                        $result_product = mysqli_query($con, "SELECT * FROM products where product_id = '$product_id'");
                        while ($fetch_product = mysqli_fetch_array($result_product)) {
                            $product_price = array($fetch_product['product_price']);
                            $product_title = $fetch_product['product_title'];
                            $product_image = $fetch_product['product_image'];
                            $sing_price = $fetch_product['product_price'];

                            $values = array_sum($product_price);

                           
                    ?>
                           
                           <div class="box">
                               <i class="fas fa-heart"></i>
                               <input type="checkbox" name="remove[]" value="<?php echo($product_id);?>">
                               <img src="admin/public/product_images/<?php echo($product_image) ?>" alt="">
                               <div class="content">
                                   <h4><?php echo($product_title) ?></h4>
                                   <span class="price"><?php echo($sing_price)."$" ?></span>
                               </div>
                           </div>
                            <?php }} }
                             else{
                                 echo '<p class="favorite">Favorite product is empty</p>';
                                  echo '<img  class="no-cor" src="./public/image/Online.png">';
                                }//end while ?>
                           <input type="submit" value="update" name="update_liked" class="btn">
                       </form>
         <?php

                
                if(isset($_POST['remove'])){
                    
                    foreach($_POST['remove'] as $remove_id){
                        
                        $run_delete = mysqli_query($con,"DELETE from likes where product_id='$remove_id' and ip_address = '$ip'" );
                        
                        if($run_delete){
                            echo("<script>window.open('products.php','_self')</script>");
                        }
                    }
                }
                    
            ?>
            <?php
             like();
            ?>