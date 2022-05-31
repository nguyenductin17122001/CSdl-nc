<?php
$edit_banner = mysqli_query($con, "SELECT * from banners where banner_id='$_GET[banner_id]'");
$fetch_edit = mysqli_fetch_array($edit_banner);
?>

<div class="form_box">
    <form action="" method="POST" enctype="multipart/form-data">
        <table align="center" width="100%">
            <tr>
                <td colspan="7">
                   <h1>Edit <strong>banner information</strong></h1>
                    <div class="border_bottom">

                    </div>
                </td>
            </tr>
            <tr>
                <td><b>Title banner</b></td>
                <td><input type="text" name="banner_title" value="<?php echo ($fetch_edit['banner_title']); ?>" size="60" required value=""></td>
            </tr>
          
            <tr>
                <td valign="top"><b>Hình Ảnh banner: </b></td>
                <td><input type="file" name="banner_image" />
                    <div class="edit_image">
                        <img src="./public/images/<?php echo ($fetch_edit['banner_image']); ?>" width="100px" height="70px" alt="">
                    </div>
                </td>
            </tr>
          
            <tr>
                <td valign="top"><b>Mô tả banner</b></td>
                <td><textarea name="banner_upto"  rows="10" ><?php echo($fetch_edit['banner_upto']); ?></textarea></td>
            </tr>
            
            <tr">
                <td colspan="7"><input type="submit" name="edit_banner" value="Save and change" id=""></td>
                </tr>
        </table>
    </form>
</div>
<!-- Thêm sản phẩm mới -->
<?php
if (isset($_POST['edit_banner'])) {
    $banner_title = trim(mysqli_real_escape_string($con,$_POST['banner_title']));
    $banner_upto = trim(mysqli_real_escape_string($con, $_POST['banner_upto']));
   
    //getting the image from the field
    $banner_image = $_FILES['banner_image']['name'];
    $banner_image_tmp = $_FILES['banner_image']['tmp_name'];

    // echo( $product_title);
    // echo($product_cat);
    // echo($product_brand);
    // echo ($product_price);
    // echo($product_upto);
    // echo($product_image);
    // echo($product_image_tmp);

    if(!empty($_FILES['banner_image']['name'])){
    if(move_uploaded_file($banner_image_tmp, "./public/images/$banner_image")){
        $update_banner = mysqli_query($con,"UPDATE banners set banner_title = '$banner_title',banner_upto='$banner_upto',banner_image='$banner_image' where banner_id = '$_GET[banner_id]'");
    }

    }else{  
        $update_banner = mysqli_query($con,"UPDATE banners set banner_title = '$banner_title',banner_upto='$banner_upto',banner_image='$banner_image' where banner_id = '$_GET[banner_id]'");

    }
    if($update_banner){
        echo("<script>alert('thay đổi thành công')</script>");
        echo("<script>window.open(window.location.href,'_self')</script>");
    }
}
?>