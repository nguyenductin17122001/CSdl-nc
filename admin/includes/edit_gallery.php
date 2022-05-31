<?php
$edit_gallery = mysqli_query($con, "SELECT * from gallerys where gallery_id='$_GET[gallery_id]'");
$fetch_edit = mysqli_fetch_array($edit_gallery);
?>

<div class="form_box">
    <form action="" method="POST" enctype="multipart/form-data">
        <table align="center" width="100%">
            <tr>
                <td colspan="7">
                    <h1>Edit <strong> gallery information</strong></h1>
                    <div class="border_bottom">

                    </div>
                </td>
            </tr>
           
            <tr>
                <td valign="top"><b>Photo gallery: </b></td>
                <td><input type="file" name="gallery_image" />
                    <div class="edit_image">
                        <img src="./public/images/<?php echo ($fetch_edit['gallery_image']); ?>" width="100px" height="70px" alt="">
                    </div>
                </td>
            </tr>
            
            <tr">
                <td colspan="7"><input type="submit" name="edit_gallery" value="Lưu thanh đổi" id=""></td>
                </tr>
        </table>
    </form>
</div>
<!-- Thêm sản phẩm mới -->
<?php
if (isset($_POST['edit_gallery'])) {
  
   
    //getting the image from the field
    $gallery_image = $_FILES['gallery_image']['name'];
    $gallery_image_tmp = $_FILES['gallery_image']['tmp_name'];

    
    if(!empty($_FILES['gallery_image']['name'])){
    if(move_uploaded_file($gallery_image_tmp, "./public/images/$gallery_image")){
        $update_gallery = mysqli_query($con,"UPDATE gallerys set gallery_image='$gallery_image' where gallery_id = '$_GET[gallery_id]'");
    }

    }else{  
        $update_gallery = mysqli_query($con,"UPDATE gallerys set gallery_image='$gallery_image' where gallery_id = '$_GET[gallery_id]'");

    }
    if($update_gallery){
        echo("<script>alert('thay đổi thành công')</script>");
        echo("<script>window.open(window.location.href,'_self')</script>");
    }
}
?>