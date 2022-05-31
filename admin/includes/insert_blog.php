<div class="form_box">
    <form action="" method="POST" enctype="multipart/form-data">
        <table align="center" width="100%">
            <tr>
                <td colspan="7">
                    <h1>Add <strong> New Blogs </strong> </h1>
                    <div class="border_bottom">

                    </div>
                </td>
            </tr>
            <tr>
                <td><b>title</b></td>
                <td><input type="text" name="blog_title" size="60" required value=""></td>
            </tr>
            
            <tr>
                <td><b> blog image : </b></td>
                <td><input type="file" name="blog_image" /></td>
            </tr>
            <tr>
                <td valign = "top"><b>blog content</b></td>
                <td><textarea name="blog_desc" rows="10"></textarea></td>
            </tr>
             <tr>
                <td valign = "top"><b>Additional doc description</b></td>
                <td><textarea name="blog_content" rows="10"></textarea></td>
            </tr>
            <tr>
                <td><b> date blog : </b></td>
                <td><input type="text" name="blog_date" required/ id=""></td>
            </tr>
            <tr>
                <td colspan="7"><input type="submit" name="insert_blog" value="add blog " id=""></td>
            </tr>
        </table>
    </form>
</div>
<!-- Thêm sản phẩm mới -->
<?php
if (isset($_POST['insert_blog'])) {
    $blog_title = $_POST['blog_title'];
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

    move_uploaded_file($blog_image_tmp, "./public/images/$blog_image");

    $insert_blog =
        "INSERT INTO blogs(blog_title,blog_desc,blog_image,blog_date,blog_content) 
        value('$blog_title','$blog_desc','$blog_image','$blog_date','$blog_content')";
    $insert_pro = mysqli_query($con, $insert_blog);

    if ($insert_pro) {
        echo ("<script>alert('Thêm blog thành công!')</script>");
        echo ("<script>window.open('index.php?insert_blog','_self')</script>");
    }
}
?>