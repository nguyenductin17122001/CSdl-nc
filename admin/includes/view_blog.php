
    <div class="view_product_box">
        <h2>View <strong>Blog</strong></h2>
        <div class="border_bottom"></div>
        <form action="" method="POST" enctype="multipart/form-data">

         
            <table class="content-table" width=100%>
                <thead>
                    <tr>
                        <th>Check</th>
                        <th>ID</th>
                        <th>Name blog</th>
                        <th>image</th>
                        <th>Date</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <?php
                // kết nối với table product
                $all_blog = mysqli_query($con, "SELECT * FROM blogs order by blog_id DESC");
                $i = 1;
                while ($row = mysqli_fetch_array($all_blog)) {


                ?>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" name="deleteAll[]" value="<?php echo($row['blog_id']); ?>"></td>
                            <td><?php echo ($i); ?></td>
                            <td><?php echo ($row['blog_title']); ?></td>
                            <td><img src="./public/images/<?php echo ($row['blog_image']) ?>" width="70px" height="50px" alt=""></td>
                            <td><?php echo ($row['blog_date']) ?></td>
                            
                            <td><a class="btn one"href="index.php?action=view_blog&delete_blog=<?php echo ($row['blog_id']); ?>">Delete</a></td>
                            <td><a class="btn two" href="index.php?action=edit_blog&blog_id=<?php echo ($row['blog_id']); ?>">Edit</a></td>
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
    if (isset($_GET['delete_blog'])) {
        $delete_blog = mysqli_query($con, "DELETE from blogs where blog_id='$_GET[delete_blog]'");

        if ($delete_blog) {
            echo ("<script>alert('Xoá blog thành công');</script>");
            echo ("<script>window.open('index.php?action=view_blog','_self')</script>");
        }
    }


    //  xoá các sản phẩm đã chọn bằng vòng lặp foreach -->
    if (isset($_POST['deleteAll'])) {
        $remove = $_POST['deleteAll'];

        foreach ($remove as $key) {
            $run_remove = mysqli_query($con, "DELETE from blogs where blog_id='$key'");

            if ($run_remove) {
                echo ("<script>alert('Xoá blogđã chọn thành công');</script>");
                echo ("<script>window.open('index.php?action=view_blog','_self')</script>");
            }
            else{
                echo ("<script>alert('Không thể kết nối với mysql');</script>");
            }
        }
    }
    ?>