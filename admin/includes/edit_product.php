<?php
$edit_product = mysqli_query($con, "SELECT * from products where product_id='$_GET[product_id]'");
$fetch_edit = mysqli_fetch_array($edit_product);
?>

<div class="form_box">
    <form action="" method="POST" enctype="multipart/form-data">
        <table align="center" width="100%">
            <tr>
                <td colspan="7">
                    <h1>Edit <strong>product information</strong></h1>
                    <div class="border_bottom">

                    </div>
                </td>
            </tr>
            <tr>
                <td><b>Product's name:</b></td>
                <td><input type="text" name="product_title" value="<?php echo ($fetch_edit['product_title']); ?>" size="60" required value=""></td>
            </tr>
            <tr>
                <td><b>Product portfolio</b></td>
                <td>
                    <select name="product_cat" id="">
                        <option value="">Choose a category</option>
                        <?php
                        $get_cats = "SELECT * from categories";
                        $run_cats = mysqli_query($con, $get_cats);

                        while ($row_cats = mysqli_fetch_array($run_cats)) {
                            $cat_id = $row_cats['cat_id'];
                            $cat_title = $row_cats['cat_title'];
                            if ($fetch_edit['product_cat'] == $cat_id) {
                                echo "<option value = '$fetch_edit[product_cat]' selected>$cat_title</option>";
                            } else {
                                echo "<option value = '$cat_id'>$cat_title</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td valign="top"><b>Product Pictures : </b></td>
                <td><input type="file" name="product_image" />
                    <div class="edit_image">
                        <img src="./public/product_images/<?php echo ($fetch_edit['product_image']); ?>" width="100px" height="70px" alt="">
                    </div>
                </td>
            </tr>
            <tr>
                <td><b>Product Price : </b></td>
                <td><input type="text" name="product_price" value="<?php echo($fetch_edit['product_price']) ?>" required/ id=""></td>
            </tr>
              <tr>
                <td><b>Original Product Price: </b></td>
                <td><input type="text" name="product_sale" value="<?php echo($fetch_edit['product_sale']) ?>" required/ id=""></td>
            </tr>
            <tr>
                <td valign="top"><b>Product description</b></td>
                <td><textarea name="product_desc"  rows="10" ><?php echo($fetch_edit['product_desc']); ?></textarea></td>
            </tr>
            <tr>
                <td valign = "top"><b>percentage reduction</b></td>
                <td><input type="text" name="phantram" value="<?php echo($fetch_edit['phantram']) ?>" required/ id=""></td>
            </tr>
             <tr>
                <td valign = "top"><b>product prominence</b></td>
                 <td><input type="text" name="sukien" value="<?php echo($fetch_edit['sukien']) ?>" required/ id=""></td>
            </tr>
            <tr>
                <td><b>quality: </b></td>
                <td><input type="text" name="qty" required/ id=""></td>
            </tr> 
            <tr>
                <td><b>Product Search Keyword : </b></td>
                <td><input type="text" name="product_keywords" value="<?php echo($fetch_edit['product_keywords']) ?>" required/ id=""></td>
            </tr>
            <tr">
                <td colspan="7"><input type="submit" name="edit_product" value="Save and change" id=""></td>
                </tr>
        </table>
    </form>
</div>
<!-- Thêm sản phẩm mới -->
<?php
if (isset($_POST['edit_product'])) {
    $product_title = trim(mysqli_real_escape_string($con,$_POST['product_title']));
    $product_cat = $_POST['product_cat'];
    $product_price = $_POST['product_price'];
    $product_sale = $_POST['product_sale'];
    $product_desc = trim(mysqli_real_escape_string($con, $_POST['product_desc']));
    $phantram =  $_POST['phantram'];
    $sukien = $_POST['sukien'];
    $qty = $_POST['qty'];
    $product_keywords = $_POST['product_keywords'];
    $date = date("F d, y");

    //getting the image from the field
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp = $_FILES['product_image']['tmp_name'];

    // echo( $product_title);
    // echo($product_cat);
    // echo($product_brand);
    // echo ($product_price);
    // echo($product_desc);
    // echo($product_image);
    // echo($product_image_tmp);

   if(!empty($_FILES['product_image']['name'])){

    if(move_uploaded_file($product_image_tmp, "./public/product_images/$product_image")){

        // $update_product_query = ("CALL `sp_insert_product`('$product_cat', '$product_title', '$product_price', '$product_sale', '$product_desc', '$product_image', '$sukien', '$product_keywords', '$phantram', '$date', '$_GET[product_id]');");

         $update_product = mysqli_query($con, "CALL `sp_update_pr`('$product_cat', '$product_title', '$product_price', '$product_sale', '$product_desc', '$product_image', '$sukien', '$product_keywords', '$phantram', '$date', '$get_pro_id');");
    }


    }else{  

        // $update_product_query = ("CALL `sp_insert_product`('$product_cat', '$product_title', '$product_price', '$product_sale', '$product_desc', '$product_image', '$sukien', '$product_keywords', '$phantram', '$date', '$_GET[product_id]');");

         $update_product = mysqli_query($con, "CALL `sp_update_pr`('$product_cat', '$product_title', '$product_price', '$product_sale', '$product_desc', '$product_image', '$sukien', '$product_keywords', '$phantram', '$date', '$get_pro_id');");

     

    }

    if($update_product){

        echo("<script>alert('thay đổi thành công')</script>");

        echo("<script>window.open(window.location.href,'_self')</script>");

    }
}
?>