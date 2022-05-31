
    <div class="view_product_box">
        <h2>View <strong> Gallerys</strong></h2>
        <div class="border_bottom"></div>
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="content-table" width=100%>
                <thead>
                    <tr >
                        <th>Check</th>
                        <th>ID</th>
                        <th>imaged</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <?php
                // kết nối với table product
                  $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:4;
                $current_page = !empty($_GET['page'])?$_GET['page']:1; //Trang hiện tại
                $offset = ($current_page - 1) * $item_per_page;
                $gallerys = mysqli_query($con, "SELECT * FROM `gallerys` ORDER BY `gallery_id` ASC  LIMIT " . $item_per_page . " OFFSET " . $offset);
                $totalRecords = mysqli_query($con, "SELECT * FROM `gallerys`");
                $totalRecords = $totalRecords->num_rows;
                $totalPages = ceil($totalRecords / $item_per_page);
                $i = 1;
                while ($row = mysqli_fetch_array($gallerys)) {


                ?>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" name="deleteAll[]" value="<?php echo($row['gallery_id']); ?>"></td>
                            <td><?php echo ($i); ?></td>
                            <td><img src="./public/images/<?php echo ($row['gallery_image']) ?>" width="70px" height="50px" alt=""></td>
                            <td><a class="btn one" href="index.php?action=view_gallery&delete_gallery=<?php echo ($row['gallery_id']); ?>">Delete</a></td>
                            <td><a class="btn two" href="index.php?action=edit_gallery&gallery_id=<?php echo ($row['gallery_id']); ?>">Edit</a></td>
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
         <?php
                include 'pag_gallery.php';
                ?> 
    </div>

    <!-- xoá sản phẩm -->

    <?php
    if (isset($_GET['delete_gallery'])) {
        $delete_gallery = mysqli_query($con, "DELETE from gallerys where gallery_id='$_GET[delete_gallery]'");

        if ($delete_gallery) {
            echo ("<script>alert('Xoá gallery thành công');</script>");
            echo ("<script>window.open('index.php?action=view_gallery','_self')</script>");
        }
    }


    //  xoá các sản phẩm đã chọn bằng vòng lặp foreach -->
    if (isset($_POST['deleteAll'])) {
        $remove = $_POST['deleteAll'];

        foreach ($remove as $key) {
            $run_remove = mysqli_query($con, "DELETE from gallerys where gallery_id='$key'");

            if ($run_remove) {
                echo ("<script>alert('Xoá galleryđã chọn thành công');</script>");
                echo ("<script>window.open('index.php?action=view_gallery','_self')</script>");
            }
            else{
                echo ("<script>alert('Không thể kết nối với mysql');</script>");
            }
        }
    }
    ?>