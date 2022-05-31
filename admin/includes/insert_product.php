<div class="form_box">
    <form action="" method="POST" enctype="multipart/form-data">
        <table align="center" width="100%">
            <tr>
                <td colspan="7">
                    <h1>Add <strong> New Products </strong> </h1>
                    <div class="border_bottom">

                    </div>
                </td>
            </tr>
            <tr>
                <td><b>Product's name</b></td>
                <td><input type="text" name="product_title" size="60" required value=""></td>
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
                            echo "<option value = '$cat_id'>$cat_title</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><b>Product Pictures: </b></td>
                <td><input type="file" name="product_image" /></td>
            </tr>
            <tr>
                <td><b>Product Price : </b></td>
                <td><input type="text" name="product_price" required/ id=""></td>
            </tr>
              <tr>
                <td><b>Original Product Price : </b></td>
                <td><input type="text" name="product_sale" required/ id=""></td>
            </tr>
            <tr>
                <td valign = "top"><b>Product description</b></td>
                <td><textarea name="product_desc" rows="10"></textarea></td>
            </tr>
             <tr>
                <td><b>percentage reduction </b></td>
                <td><input type="text" name="phantram" required/ id=""></td>
            </tr>
              <tr>
                <td><b>product prominence: </b></td>
                <td><input type="text" name="sukien" required/ id=""></td>
            </tr> 
             <tr>
                <td><b>quality: </b></td>
                <td><input type="text" name="qty" required/ id=""></td>
            </tr> 
            <tr>
                <td><b>Product Search Keyword : </b></td>
                <td><input type="text" name="product_keywords" required/ id=""></td>
            </tr>
            <tr>
                <td colspan="7"><input type="submit" name="insert_post" value="Add New Products" id=""></td>
            </tr>
        </table>
    </form>
</div>
<!-- Thêm sản phẩm mới -->
<?php
if (isset($_POST['insert_post'])) {
    $product_title = $_POST['product_title'];
    $product_cat = $_POST['product_cat'];
    $product_price = $_POST['product_price'];
     $product_sale = $_POST['product_sale'];
    $product_desc = trim(mysqli_real_escape_string($con, $_POST['product_desc']));
    $phantram =  $_POST['phantram'];
    $sukien = $_POST['sukien'];
    $qty = $_POST['qty'];
    $product_keywords = $_POST['product_keywords'];

    //getting the image from the field
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp = $_FILES['product_image']['tmp_name'];


    move_uploaded_file($product_image_tmp, "./public/product_images/$product_image");

    // $insert_product =
    //     "INSERT INTO products(product_cat,product_title,product_price,product_desc,product_image,phantram,product_keywords,sukien,qualitys) 
    //     value('$product_cat','$product_title','$product_price','$product_desc','$product_image','$phantram','$product_keywords','$sukien','$qty')";
    
     $insert_product = ("CALL `sp_insert_product`( '$product_cat','$product_title','$product_price','$product_desc','$product_image',$phantram,'$product_keywords','$sukien')");
    
   $insert_pro = mysqli_query($con, $insert_product);
    if ($insert_pro) {
        echo ("<script>alert('Thêm sản phẩm thành công!')</script>");
        echo ("<script>window.open('index.php?insert_product','_self')</script>");
    }
}
?>