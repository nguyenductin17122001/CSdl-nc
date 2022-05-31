<div class="form_box">
    <form action="" method="POST" enctype="multipart/form-data">
        <table align="center" width="100%">
            <tr>
                <td colspan="7">
                    <h1>More <strong>product categories</strong></h1>
                    <div class="border_bottom">

                    </div>
                </td>
            </tr>
            <tr>
                <td><b>More categories:</b></td>
                <td><input type="text" name="product_cat" size="60" required value=""></td>
            </tr>

            <tr>
                <td colspan="7"><input type="submit" name="insert_cat" value="Add" id=""></td>
            </tr>
        </table>
    </form>
</div>
<!-- Thêm sản phẩm mới -->
<?php
if (isset($_POST['insert_cat'])) {
    
    $product_cat = mysqli_real_escape_string($con,$_POST['product_cat']);

    $insert_cat = mysqli_query($con,"CALL `sp_insert_category`('$product_cat')");

    if ($insert_cat) {
        echo ("<script>alert('Thêm loại sản phẩm thành công!')</script>");
        echo ("<script>window.open(window.location.href,'_self')</script>");
    }
}
?>