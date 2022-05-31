<div class="form_box">
    <form action="" method="POST" enctype="multipart/form-data">
        <table align="center" width="100%">
            <tr>
                <td colspan="7">
                   <h1>Add <strong> New Gallerys </strong> </h1>
                    <div class="border_bottom">

                    </div>
                </td>
            </tr>
            
            
            <tr>
                <td><b>Photo gallery: </b></td>
                <td><input type="file" name="gallery_image" /></td>
            </tr>
           
            <tr>
                <td colspan="7"><input type="submit" name="insert_gallery" value="Thêm gallery Mới" id=""></td>
            </tr>
        </table>
    </form>
</div>
<!-- Thêm sản phẩm mới -->
<?php
if (isset($_POST['insert_gallery'])) {

    //getting the image from the field
    $gallery_image = $_FILES['gallery_image']['name'];
    $gallery_image_tmp = $_FILES['gallery_image']['tmp_name'];


    move_uploaded_file($gallery_image_tmp, "./public/images/$gallery_image");

    $insert_gallery =
        "INSERT INTO gallerys(gallery_image) 
        value('$gallery_image')";
    $insert_gallery = mysqli_query($con, $insert_gallery);

    if ($insert_gallery) {
        echo ("<script>alert('Thêm gallery thành công!')</script>");
        echo ("<script>window.open('index.php?insert_gallery','_self')</script>");
    }
}
?>
