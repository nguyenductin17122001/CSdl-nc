<div class="form_box">
    <form action="" method="POST" enctype="multipart/form-data">
        <table align="center" width="100%">
            <tr>
                <td colspan="7">
                  <h1>Add <strong> New Banners </strong> </h1>
                    <div class="border_bottom">

                    </div>
                </td>
            </tr>
            <tr>
                <td><b>title banner</b></td>
                <td><input type="text" name="banner_title" size="60" required value=""></td>
            </tr>
            
            <tr>
                <td><b>images banner: </b></td>
                <td><input type="file" name="banner_image" /></td>
            </tr>
            <tr>
                <td valign = "top"><b>upto banner</b></td>
                <td><textarea name="banner_upto" rows="10"></textarea></td>
            </tr>
            
            <tr>
                <td colspan="7"><input type="submit" name="insert_banner" value="add banner " id=""></td>
            </tr>
        </table>
    </form>
</div>
<!-- Thêm sản phẩm mới -->
<?php
if (isset($_POST['insert_banner'])) {
    $banner_title = $_POST['banner_title'];
    $banner_upto = $_POST['banner_upto'];

    //getting the image from the field
    $banner_image = $_FILES['banner_image']['name'];
    $banner_image_tmp = $_FILES['banner_image']['tmp_name'];


    move_uploaded_file($banner_image_tmp, "./public/images/$banner_image");

    $insert_banner =
        "INSERT INTO banners(banner_title,banner_image,banner_upto) 
        value('$banner_title','$banner_image','$banner_upto')";
    $insert_pro = mysqli_query($con, $insert_banner);

    if ($insert_pro) {
        echo ("<script>alert('Thêm banner thành công!')</script>");
        echo ("<script>window.open('index.php?insert_banner','_self')</script>");
    }
}
?>
