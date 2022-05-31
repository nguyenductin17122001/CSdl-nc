<?php
include("functions/functions.php");
include("config/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product page</title>
  <link rel="shortcut icon" type="image" href="image/logo.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./public/css/detail.css?v=<?php echo time(); ?>">

</head>

<body>
   <?php
            if (isset($_GET['pro_id'])) {
                $product_id = $_GET['pro_id'];
                $run_query_by_pro_id = mysqli_query($con, "CALL `chitietsanpham`( $product_id );");

                while ($row_pro = mysqli_fetch_array($run_query_by_pro_id)) {
                    $pro_id = $row_pro['product_id'];
                    $pro_cat = $row_pro['product_cat'];
                    $pro_title = $row_pro['product_title'];
                    $pro_price = $row_pro['product_price'];
                    $pro_image = $row_pro['product_image'];
                    $pro_desc = $row_pro['product_desc'];
                    $pro_sukien =$row_pro['sukien'];

                    echo ("
                            <div class='product'>
                                <div class='product-img'>
                                  <img src='admin/public/product_images/$pro_image' alt=''>
                                  <span class='tag'>$pro_sukien</span>
                                </div>
                                <div class='product-listing'>
                                   <div class='content'>
                                      <h1 class='name'>$pro_title</h1>
                                         <p class='info'>$pro_desc</p>
                                         <p class='price'>$ $pro_price </p>
                                       <div class='btn-and-rating-box'>
                                        <div class='center'>
                                            <div class='stars'>
                                                <input type='radio' id='five' name='rate' value='5'>
                                                <label for='five'></label>
                                                <input type='radio' id='four' name='rate' value='4'>
                                                <label for='four'></label>
                                                <input type='radio' id='three' name='rate' value='3'>
                                                <label for='three'></label>
                                                <input type='radio' id='two' name='rate' value='2'>
                                                <label for='two'></label>
                                                <input type='radio' id='one' name='rate' value='1'>
                                                <label for='one'></label>
                                                <span class='result'></span>
                                            </div>
                                        </div>
                                            <a href = 'products.php?add_cart=$pro_id'>
                                                 <button class='btn'>Add to Cart</button>
                                            </a>
                                             <a href='products.php'>
                                                   <h1><i class='fas fa-arrow-circle-right'></i></h1>
                                             </a>
                                     </div>
                                 </div>
                              </div>
                            </div>
                
                        ");
                }
            }
            ?>

  <!-- <div class="product">
    <div class="product-img">
      <img src="image/sanpham (2).jpg" alt="">
      <span class="tag">new</span>
    </div>
    <div class="product-listing">
      <div class="content">
        <h1 class="name">leather bag</h1>
        <p class="info">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque laborum optio natus
          quibusdam ea nam odit vitae id unde officia.</p>
        <p class="price">$ 299</p>
        <div class="btn-and-rating-box">
          <div class="rating">
            <img src="image/star.png" alt="">
            <img src="image/star.png" alt="">
            <img src="image/star.png" alt="">
            <img src="image/star.png" alt="">
            <img src="image/star stroke.png" alt="">
          </div>
             <button class="btn">Add to Cart</button>
          <h1><i class="fas fa-arrow-circle-right"></i></h1>
        </div>
      </div>
    </div>
  </div> -->

</body>

</html>