<?php
$edit_blog = mysqli_query($con, "SELECT * from blogs where blog_id='$_GET[blog_id]'");
$fetch_edit = mysqli_fetch_array($edit_blog);
?>

<div class="form_box">
    <form action="" method="POST" enctype="multipart/form-data">
        <table align="center" width="100%">
            <tr>
                <td colspan="7">
                     <h1>Edit <strong>blog information</strong></h1>
                    <div class="border_bottom">

                    </div>
                </td>
            </tr>
            <tr>
                <td><b>Name blog</b></td>
                <td><input type="text" name="blog_title" value="<?php echo ($fetch_edit['blog_title']); ?>" size="60" required value=""></td>
            </tr>
          
            <tr>
                <td valign="top"><b>image blog: </b></td>
                <td><input type="file" name="blog_image" />
                    <div class="edit_image">
                        <img src="./public/images/<?php echo ($fetch_edit['blog_image']); ?>" width="100px" height="70px" alt="">
                    </div>
                </td>
            </tr>
          
            <tr>
                <td valign="top"><b>blog content</b></td>
                <td><textarea name="blog_desc"  rows="10" ><?php echo($fetch_edit['blog_desc']); ?></textarea></td>
            </tr>
             <tr>
                <td valign="top"><b>Additional doc description</b></td>
                <td><textarea name="blog_content"  rows="10" ><?php echo($fetch_edit['blog_content']); ?></textarea></td>
            </tr>
            <tr>
                <td><b> date blog : </b></td>
                <td><input type="text" name="blog_date" value="<?php echo($fetch_edit['blog_date']) ?>" required/ id=""></td>
            </tr>
            <tr">
                <td colspan="7"><input type="submit" name="edit_blog" value="Save and change" id=""></td>
                </tr>
        </table>
    </form>
</div>
<!-- Thêm sản phẩm mới -->
<?php
if (isset($_POST['edit_blog'])) {
    $blog_title = trim(mysqli_real_escape_string($con,$_POST['blog_title']));
    $blog_desc = trim(mysqli_real_escape_string($con, $_POST['blog_desc']));
    $blog_date = $_POST['blog_date'];
    $blog_content = trim(mysqli_real_escape_string($con, $_POST['blog_content']));
    //getting the image from the field
    $blog_image = $_FILES['blog_image']['name'];
    $blog_image_tmp = $_FILES['blog_image']['tmp_name'];

    // echo( $product_title);
    // echo($product_cat);
    // echo($product_brand);
    // echo ($product_price);
    // echo($product_desc);
    // echo($product_image);
    // echo($product_image_tmp);

    if(!empty($_FILES['blog_image']['name'])){
    if(move_uploaded_file($blog_image_tmp, "./public/images/$blog_image")){
        $update_blog = mysqli_query($con,"UPDATE blogs set blog_title = '$blog_title',blog_desc='$blog_desc',blog_image='$blog_image',blog_date = '$blog_date',blog_content = '$blog_content' where blog_id = '$_GET[blog_id]'");
    }

    }else{  
        $update_blog = mysqli_query($con,"UPDATE blogs set blog_title = '$blog_title',blog_desc='$blog_desc',blog_image='$blog_image',blog_date = '$blog_date',blog_content = '$blog_content' where blog_id = '$_GET[blog_id]'");

    }
    if($update_blog){
        echo("<script>alert('thay đổi thành công')</script>");
        echo("<script>window.open(window.location.href,'_self')</script>");
    }
}
?>