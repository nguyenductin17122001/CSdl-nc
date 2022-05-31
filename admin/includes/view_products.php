
    <div class="view_product_box">
        <h2>View <strong> Products</strong></h2>
        <div class="border_bottom"></div>
        <form action="" method="POST" enctype="multipart/form-data">

           

            <table class="content-table" width=100% >
                <thead>
                    <tr>
                        <th><input type="checkbox" id="checkAll">Check</th>
                        <th>ID</th>
                        <th>Product's name</th>
                        <th>price</th>
                        <th>Initial price</th>
                        <th>image</th>
                        <th>Quality</th>
                        <th>Date</th>
                        <th>status</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <?php
                $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:5;
                $current_page = !empty($_GET['page'])?$_GET['page']:1; //Trang hiện tại
                $offset = ($current_page - 1) * $item_per_page;
                $products = mysqli_query($con, "SELECT * FROM `products` ORDER BY `product_id` ASC  LIMIT " . $item_per_page . " OFFSET " . $offset);
                $totalRecords = mysqli_query($con, "SELECT * FROM `products`");
                $totalRecords = $totalRecords->num_rows;
                $totalPages = ceil($totalRecords / $item_per_page);
                // kết nối với table product
    
                $i = 1;
                while ($row = mysqli_fetch_array($products)) {


                ?>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" name="deleteAll[]" value="<?php echo($row['product_id']); ?>"></td>
                            <td><?php echo ($i); ?></td>
                            <td><?php echo ($row['product_title']); ?></td>
                            <td><?php echo ($row['product_price']) ?></td>
                             <td><?php echo ($row['product_sale']) ?></td>
                            <td><img src="./public/product_images/<?php echo ($row['product_image']) ?>" width="70px" height="50px" alt=""></td>
                            <td><?php echo ($row['qualitys']); ?></td>
                            <td><?php echo ($row['date']) ?></td>
                            <td>
                                <?php
                                if ($row['visible'] == 1) {
                                    echo ("Chấp thuận");
                                } else {
                                    echo ("đang chờ xử lý");
                                }
                                ?>
                            </td>
                            <td><a class="btn one" href="index.php?action=view_pro&delete_product=<?php echo ($row['product_id']); ?>">Delete</a></td>
                            <td><a class="btn two" href="index.php?action=edit_pro&product_id=<?php echo ($row['product_id']); ?>">Edit</a></td>
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
                include 'pagination.php';
         ?>
    </div>
           
    <!-- xoá sản phẩm -->

    <?php
    if (isset($_GET['delete_product'])) {
        $delete_product = mysqli_query($con, "DELETE from products where product_id='$_GET[delete_product]'");

        if ($delete_product) {
            echo ("<script>alert('Xoá sản phẩm thành công');</script>");
            echo ("<script>window.open('index.php?action=view_pro','_self')</script>");
        }
    }


    //  xoá các sản phẩm đã chọn bằng vòng lặp foreach -->
    if (isset($_POST['deleteAll'])) {
        $remove = $_POST['deleteAll'];

        foreach ($remove as $key) {
            $run_remove = mysqli_query($con, "DELETE from products where product_id='$key'");

            if ($run_remove) {
                echo ("<script>alert('Xoá sản phẩm đã chọn thành công');</script>");
                echo ("<script>window.open('index.php?action=view_pro','_self')</script>");
            }
            else{
                echo ("<script>alert('Không thể kết nối với mysql');</script>");
            }
        }
    }
    ?>