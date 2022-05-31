<?php
  include("include/header.php");

?>
     <section class="products" id="products">

        <h1 class="heading"> product  <span>you want to find</span> </h1>

        <div class="filter-buttons">
           
          
        </div>

        <div class="box-container">
                <?php
            if (isset($_GET['search'])) {
                $search_query = $_GET['user_query'];

                $run_query_by_pro_id = mysqli_query($con, "SELECT * FROM products where product_keywords like '%$search_query%' ");
                 if(mysqli_num_rows( $run_query_by_pro_id) > 0){
                while ($row_pro = mysqli_fetch_array($run_query_by_pro_id)) {
                    $pro_id = $row_pro['product_id'];
                    $pro_cat = $row_pro['product_cat'];
                    $pro_title = $row_pro['product_title'];
                    $pro_price = $row_pro['product_price'];
                    $pro_image = $row_pro['product_image'];
                    $pro_sale = $row_pro['product_sale'];
                     $sale  = $row_pro['phantram'];
                     $qty = $row_pro['qualitys'];
                    echo ("
                            <div class='box'>
                               <div class='icons'>
                                 <a href='results.php?add_cart=$pro_id' class='fas fa-shopping-cart'></a>
                                 <a href='results.php?add_like=$pro_id' class='fas fa-heart'></a>
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
                }
            }else{
                echo '<p class="result">no result found ! </p>';
                }

            }
            ?>
             <?php
                   get_pro_by_cat_id()
              ?>
                    

        </div>

    </section> 
<?php
   
    include("include/footer.php");
?>