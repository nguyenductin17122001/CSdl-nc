
<?php

$con = mysqli_connect("localhost", "root", "", "cosmeticsnew");

if (mysqli_connect_errno()) {
    echo ("the connection was not established" . mysqli_connect_error());
}

// lấy ip của user khi ta thêm sản phẩm vào cart
function get_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
//thêm sản phẩm vào mục yêu thích
function like(){

    global $con;
    if(isset($_GET['add_like'])){
                    
        $product_id=$_GET['add_like'];//lấy add_like ở trên
        $ip= get_ip();//lấy địa chỉ user 
        $run_check_pro = mysqli_query($con,"SELECT * FROM likes where product_id='$product_id'");
        if(mysqli_num_rows($run_check_pro)>0){
            ?>
                <!-- 1 chút js để hiện thông báo khi thêm sản phẩm vào cart -->
                <script>
                     alert("sản phẩm đã tồn tại trong danh mục sản phẩm ưa thích ");
                </script>
                
                <?php

        }
        else{
            $fetch_pro = mysqli_query($con,"SELECT * FROM products where product_id='$product_id'");
            $fetch_pro = mysqli_fetch_array($fetch_pro);

            $pro_title = $fetch_pro['product_title'];
            $run_insert_pro = mysqli_query($con,"insert into likes(product_id,product_title,ip_address) values('$product_id','$pro_title','$ip')");
            
            if($run_insert_pro){
                ?>
                <!-- 1 chút js để hiện thông báo khi thêm sản phẩm vào cart -->
                <script>
                    alert("thêm vào sản phẩm ưa thích  thành công");
                    window.open('products.php','_self');
                </script>
                
                <?php
            }
            
        }
    }
}
//  thêm sản phẩm vào cart
function cart(){

    global $con;
    if(isset($_GET['add_cart'])){
                    
        $product_id=$_GET['add_cart'];//lấy add_cart ở trên
        $ip= get_ip();//lấy địa chỉ user 
        $run_check_pro = mysqli_query($con,"SELECT * FROM cart where product_id='$product_id'");
         $result_product = mysqli_query($con,"SELECT * FROM products where product_id = '$product_id'");
        $fetch_product = mysqli_fetch_array($result_product);
        $quality_pro = $fetch_product['qualitys'];
        if( $quality_pro >0){
        if(mysqli_num_rows($run_check_pro)>0){
            ?>
                <!-- 1 chút js để hiện thông báo khi thêm sản phẩm vào cart -->
                <!-- <script>
                    alert("sản phẩm đã tồn tại trong giỏ hàng");
                </script> -->
                
                <?php

        }
        else{
            $fetch_pro = mysqli_query($con,"SELECT * FROM products where product_id='$product_id'");
            $fetch_pro = mysqli_fetch_array($fetch_pro);

            $pro_title = $fetch_pro['product_title'];
            $run_insert_pro = mysqli_query($con,"insert into cart(product_id,product_title,ip_address) values('$product_id','$pro_title','$ip')");
            
            if($run_insert_pro){
                ?>
                <!-- 1 chút js để hiện thông báo khi thêm sản phẩm vào cart -->
                <script>
                    alert("thêm vào giỏ hàng thành công");
                    window.open('products.php','_self');
                </script>
                
                <?php
            }
            
        }
    
    } else{
         ?>
        <script>
            alert("xin lõi ! sản phẩm này shop đã bán hết rồi");
            window.open('products.php','_self');
                
        </script>
                
      <?php
   }
 }
}

// hàm thính tổng số tiền nhung order đã xác nhân
function sum_money(){
 global $con;
 $total = 0;
 $run_order = mysqli_query($con,"SELECT * FROM orders WHERE tinhtrang=1");
 while($fetch_order = mysqli_fetch_array($run_order)){
      $product_id = $fetch_order['product_id'];
      $result_product = mysqli_query($con,"SELECT * FROM products where product_id = '$product_id'");
       while($fetch_product = mysqli_fetch_array($result_product)){
            $product_price = array($fetch_product['product_price']);

            $values = array_sum($product_price);
            
            //xuất ra chất lượng của sản phẩm
            $run_qty = mysqli_query($con,"SELECT * FROM orders where product_id='$product_id'");
            $row_qty = mysqli_fetch_array($run_qty);

            $qty= $row_qty['quality'];
            $values_qty = $values * $qty;

            $total+=$values_qty;
            
            
        }

 }
   echo($total."$");
}
// hàm tính tổng bill
function total_price(){
    global $con;

    $total = 0;

    $ip=get_ip();
    $run_cart=mysqli_query($con,"SELECT * FROM cart where ip_address = '$ip'");

    while($fetch_cart = mysqli_fetch_array($run_cart)){
        $product_id = $fetch_cart['product_id'];

        $result_product = mysqli_query($con,"SELECT * FROM products where product_id = '$product_id'");
        while($fetch_product = mysqli_fetch_array($result_product)){
            $product_price = array($fetch_product['product_price']);
            $product_title = $fetch_product['product_title'];
            $product_image = $fetch_product['product_image'];
            $sing_price = $fetch_product['product_price'];

            $values = array_sum($product_price);
            
            //xuất ra chất lượng của sản phẩm
            $run_qty = mysqli_query($con,"SELECT * FROM cart where product_id='$product_id'");
            $row_qty = mysqli_fetch_array($run_qty);

            $qty= $row_qty['quality'];
            $values_qty = $values * $qty;

            $total+=$values_qty;
            
            
        }
    
    }
    echo($total."$");
}
//hàm đếm order
function total_items_orders(){
 global $con;
  $run_items = mysqli_query($con,"select * from orders  where tinhtrang = 0 group by mahang");
  echo $count_items = mysqli_num_rows($run_items);
}
//hàm đếm contacts
function total_item_contact(){
    global $con;
    $run_items = mysqli_query($con,"SELECT `SUM_Contact`() AS `SUM_Contact`");
     $count_items = mysqli_fetch_array( $run_items);
    echo  ($count_items['SUM_Contact']);
}
//hàm dếm user
function total_items_users(){
 global $con;
  $run_items = mysqli_query($con,"SELECT `Tong_user`() AS `Tong_user`;");
  $count_items = mysqli_fetch_array($run_items);
  echo  ($count_items['Tong_user']);
}
//hàm dếm số sản phẩm trong like
function total_items_likes(){
 global $con;
  $ip = get_ip();
  $run_items = mysqli_query($con,"select * from likes where ip_address='$ip'");
  echo $count_items = mysqli_num_rows($run_items);
}
    // hàm đếm số sản phẩm trong cart
function total_items(){
 global $con;

    $total = 0;

    $ip=get_ip();
    $run_cart=mysqli_query($con,"SELECT * FROM cart where ip_address = '$ip'");

    while($fetch_cart = mysqli_fetch_array($run_cart)){
        $product_id = $fetch_cart['product_id'];

        $result_product = mysqli_query($con,"SELECT * FROM products where product_id = '$product_id'");
        while($fetch_product = mysqli_fetch_array($result_product)){
            $product_price = array($fetch_product['product_price']);
            $product_title = $fetch_product['product_title'];
            $product_image = $fetch_product['product_image'];
            $sing_price = $fetch_product['product_price'];

            $values = array_sum($product_price);
            
            //xuất ra chất lượng của sản phẩm
            $run_qty = mysqli_query($con,"SELECT * FROM cart where product_id='$product_id'");
            $row_qty = mysqli_fetch_array($run_qty);

            $qty= $row_qty['quality'];
            $total+=$qty;
            
            
        }
    
    }
    echo($total);
}
function sum_quality(){
    global $con;
  $run_items = mysqli_query($con,"SELECT `sum_quality_cart`() AS `sum_quality_cart`;");
  $count_items = mysqli_fetch_array($run_items);
  echo  ($count_items['sum_quality_cart']);
}

//   xuất ra các thể loại sản phẩm ˈkætəɡəri
function getCats()
{

    global $con;

    $get_cats = "SELECT * from categories";
    $run_cats = mysqli_query($con, $get_cats);

    while ($row_cats = mysqli_fetch_array($run_cats)) {
        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['cat_title'];
        echo "<div class='buttons' data-filter='arrivals'><a href='products.php?cat=$cat_id'>$cat_title</a></div>";
    }
}
function getBrands_blog(){
    global $con;

    $get_cats_blog = "SELECT * from categories";
    $run_cats_blog = mysqli_query($con, $get_cats_blog);

    while ($row_cats_blog = mysqli_fetch_array($run_cats_blog)) {
        $cat_id = $row_cats_blog['cat_id'];
        $cat_title = $row_cats_blog['cat_title'];
        echo "<a href='products.php?cat=$cat_id'>$cat_title <span></span></a>";
    }
}
// xuất ra các thương hiệu
function getBrands()
{

    global $con;
    $get_brands = "SELECT * FROM brands";
    $run_brands = mysqli_query($con, $get_brands);
    while ($row_brands = mysqli_fetch_array($run_brands)) {
        $brand_id = $row_brands['brand_id'];
        $brand_title = $row_brands['brand_title'];
        echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
    }
}


// xuất ra 12 sản phẩm bất kì ở trang index
function getPro()
{
    if (!isset($_GET['cat'])) {
        if (!isset($_GET['brand'])) {

            global $con;

            $get_pro = "SELECT * FROM products order by RAND() LIMIT 0,12";
            $run_pro = mysqli_query($con, $get_pro);

            while ($row_pro = mysqli_fetch_array($run_pro)) {
                $pro_id = $row_pro['product_id'];
                $pro_cat = $row_pro['product_cat'];
                $pro_title = $row_pro['product_title'];
                $pro_price = $row_pro['product_price'];
                $pro_image = $row_pro['product_image'];
                $pro_sale = $row_pro['product_sale'];
                $sale     = $row_pro['phantram'];
                $qty = $row_pro['qualitys'];
                echo ("
                           <div class='box'>
                               <div class='icons'>
                                 <a href='products.php?add_cart=$pro_id' class='fas fa-shopping-cart'></a>
                                 <a href='products.php?add_like=$pro_id' class='fas fa-heart'></a>
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
                                             <div class='offer'>20% off</div>
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
        }
    }
}
// xuất ra sản phẩm theo thể loại
function get_pro_by_cat_id()
{

    global $con;
    if (isset($_GET['cat'])) {

        $cat_id = $_GET['cat'];
        $get_cat_pro = "CALL `Xuatsanphamtheodm`($cat_id);";
       if( $run_cat_pro = mysqli_query($con, $get_cat_pro)){
        $count_cats = mysqli_num_rows($run_cat_pro);

        if ($count_cats == 0) {
            echo ("<h2 style='padding:20px'>Không tìm thấy sản phẩm nào trong danh mục!</h2>");
        }
        while ($row_cat_pro = mysqli_fetch_array($run_cat_pro)) {
            $pro_id = $row_cat_pro['product_id'];
            $pro_cat = $row_cat_pro['product_cat'];
            $pro_title = $row_cat_pro['product_title'];
            $pro_price = $row_cat_pro['product_price'];
            $pro_image = $row_cat_pro['product_image'];
            $pro_sale = $row_cat_pro['product_sale'];
             $sale     = $row_cat_pro['phantram'];
            $qty = $row_cat_pro ['qualitys'];
            echo ("
                 <div class='box'>
                               <div class='icons'>
                                 <a href='products.php?add_cart=$pro_id' class='fas fa-shopping-cart'></a>
                                 <a href='products.php?add_like=$pro_id' class='fas fa-heart'></a>
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
    }
}
}
// xuất ra sản phẩm theo thương hiệu

?>