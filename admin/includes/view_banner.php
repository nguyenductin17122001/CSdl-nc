
    <div class="view_product_box">
        <h2>View <strong>Banner</strong></h2>
        <div class="border_bottom"></div>
        <form action="" method="POST" enctype="multipart/form-data">

           

            <table class="content-table" width=100%>
                <thead>
                    <tr>
                        <th>Check</th>
                        <th>ID</th>
                        <th>title banner</th>
                        <th>image</th>
                        <th>upto</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <?php
                // kết nối với table product
                $all_banner = mysqli_query($con, "SELECT * FROM banners order by banner_id DESC");
                $i = 1;
                while ($row = mysqli_fetch_array($all_banner)) {


                ?>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" name="deleteAll[]" value="<?php echo($row['banner_id']); ?>"></td>
                            <td><?php echo ($i); ?></td>
                            <td><?php echo ($row['banner_title']); ?></td>
                            <td><img src="./public/images/<?php echo ($row['banner_image']) ?>" width="70px" height="50px" alt=""></td>
                            <td><?php echo ($row['banner_upto']) ?></td>
                            
                            <td><a class="btn one" href="index.php?action=view_banner&delete_banner=<?php echo ($row['banner_id']); ?>">Delete</a></td>
                            <td><a class="btn two" href="index.php?action=edit_banner&banner_id=<?php echo ($row['banner_id']); ?>">Edit</a></td>
                        </tr>
                    </tbody>
                <?php
                    $i++;
                }
                ?>

                <tr>
                    <td><input type="submit" name="delete_all" value="Remove"></td>
                </tr>
            </table>
        </form>
    </div>

    <!-- xoá sản phẩm -->

    <?php
    if (isset($_GET['delete_banner'])) {
        $delete_banner = mysqli_query($con, "DELETE from banners where banner_id='$_GET[delete_banner]'");

        if ($delete_banner) {
            echo ("<script>alert('Xoá banner thành công');</script>");
            echo ("<script>window.open('index.php?action=view_banner','_self')</script>");
        }
    }


    //  xoá các sản phẩm đã chọn bằng vòng lặp foreach -->
    if (isset($_POST['deleteAll'])) {
        $remove = $_POST['deleteAll'];

        foreach ($remove as $key) {
            $run_remove = mysqli_query($con, "DELETE from banners where banner_id='$key'");

            if ($run_remove) {
                echo ("<script>alert('Xoá bannerđã chọn thành công');</script>");
                echo ("<script>window.open('index.php?action=view_banner','_self')</script>");
            }
            else{
                echo ("<script>alert('Không thể kết nối với mysql');</script>");
            }
        }
    }
    ?>