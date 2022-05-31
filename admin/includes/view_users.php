<div class="view_product_box">
    <h2>View <strong>User</strong></h2>
    <div class="border_bottom"></div>
    <form action="" method="POST" enctype="multipart/form-data">


        <table class="content-table" width=100%>
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll">Check</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Avatar</th>
                    <th>competence</th>
                    <th>status</th>
                    <th>Delete</th>

                </tr>
            </thead>
            <?php
            
            $all_users = mysqli_query($con, "SELECT * FROM user order by id DESC");
            $i = 1;
            while ($row = mysqli_fetch_array($all_users)) {


            ?>
                <tbody>
                    <tr>
                        <td><input type="checkbox" name="deleteAll[]" value="<?php echo ($row['id']); ?>"></td>
                        <td><?php echo ($i); ?></td>
                        <td><?php echo ($row['name']); ?></td>
                        <td><?php echo ($row['email']) ?></td>
                        <td>
                            <?php if ($row['image'] != '') { ?>
                                <img src="../public/upload/<?php echo ($row['image']) ?>" width="70px" height="50px" alt="">
                            <?php } else { ?>
                                <img src="../public/image/profile-icon.png" width="70px" height="50px" alt="">
                            <?php } ?>
                        </td>
                        <td><?php echo ($row['role']); ?></td>
                        <td>
                            <?php
                            if ($row['visible'] == 1) {
                                echo ("Chấp thuận");
                            } else {
                                echo ("đang chờ xử lý");
                            }
                            ?>
                        </td>
                        <td><a class="btn one" href="index.php?action=view_users&delete_user=<?php echo ($row['id']); ?>">Delete</a></td>

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

<!-- xoá user -->

<?php
if (isset($_GET['delete_user'])) {
    $delete_user = mysqli_query($con, "DELETE from user where id='$_GET[delete_user]'");

    if ($delete_user) {
        echo ("<script>alert('Xoá user thành công');</script>");
        echo ("<script>window.open('index.php?action=view_users','_self')</script>");
    }
}


//  xoá các user đã chọn bằng vòng lặp foreach -->
if (isset($_POST['deleteAll'])) {
    $remove = $_POST['deleteAll'];

    foreach ($remove as $key) {
        $run_remove = mysqli_query($con, "DELETE from user where id='$key'");

        if ($run_remove) {
            echo ("<script>alert('Xoá các users đã chọn thành công');</script>");
            echo ("<script>window.open('index.php?action=view_users','_self')</script>");
        } else {
            echo ("<script>alert('Không thể kết nối với mysql');</script>");
        }
    }
}
?>