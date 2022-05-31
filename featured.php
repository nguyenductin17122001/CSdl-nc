 <?php
 include("include/header.php");
 
 ?>
<section class="featured" id="featured">

        <h1 class="heading"> <span>featured</span> products </h1>

        <div class="swiper featured-slider">

            <div class="swiper-wrapper">
                <?php
                         $get_pro = "CALL `dsspdocquyen`();" ;
                    if( $run_pro = mysqli_query($con,$get_pro) ){
                
                    while($row_pro = mysqli_fetch_array($run_pro)){
                        $pro_id=$row_pro['product_id'];
                        $pro_cat=$row_pro['product_cat'];
                        $pro_title = $row_pro['product_title'];
                        $pro_price = $row_pro['product_price'];
                        $pro_image = $row_pro['product_image'];
                        $pro_sale = $row_pro['product_sale'];
                        $sale     = $row_pro['phantram'];
                          $qty = $row_pro['qualitys'];
                        echo("
                            <div class='swiper-slide slide'>
                               <div class='icons'>
                                 <a href='featured.php?add_cart=$pro_id' class='fas fa-shopping-cart'></a>
                                 <a href='featured.php?add_like=$pro_id' class='fas fa-heart'></a>
                                  <a href='details.php?pro_id=$pro_id' class='fas fa-eye'></a>
                                </div>
                                <div class='image'>
                                   <img src='admin/public/product_images/$pro_image' alt=''>
                                </div>
                                 <div class='content'>
                                    <h3>$pro_title</h3>
                                       <div class='price'>
                                            <div class='amount'>$ $pro_price</div>
                                             <div class='cut'>$ $pro_sale</div>
                                             <div class='offer'>$sale% off</div>
                                       </div>
                                        <div class='stars'>
                                        <i class='fas fa-star'></i>
                                        <i class='fas fa-star'></i>
                                        <i class='fas fa-star'></i>
                                        <i class='fas fa-star'></i>
                                        <i class='far fa-star'></i>
                                        <span>(qty: $qty)</span>
                                     </div>
                                </div>
                            </div>                           
                        ");
                    }}
                ?>

               

            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

        </div>

    </section>
   <?php
    include("include/footer.php");
    ?>