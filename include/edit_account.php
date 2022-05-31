<!-- js này dùng để confirm password,
    nó nhắc ta nhập đúng pass khi confirm lại, 
    có thể ko cần js này cũng đc -->
<script>
    $(document).ready(function() {
        $("#password_confirm2").on('keyup', function() {
            // alert('testing jquery');
            var password_confirm1 = $("#password_confirm1").val();
            var password_confirm2 = $("#password_confirm2").val();

            // alert(password_confirm2);
            if (password_confirm1 == password_confirm2) {
                $("#status_for_confirm_password").html('<strong style="color:green">Mật khẩu khớp</strong>')
            } else {
                $("#status_for_confirm_password").html('<strong style="color:red">Mật khẩu không khớp,cần xem lại !!!</strong>')

            }
        });
    });
</script>
<style>
.edit{
        color:#fff;
        font-size: 30px;
        position: relative;
        left:160px;
        text-shadow: 2px 1px 2px #130f40;
    }

h3{
    color :#fff;
    font-size:15px;
    display: block;
    font-weight: 550px;
    margin-bottom: 40px;
   
}    
</style>

<!-- //lấy lại mấy thông tin của user,để đưa thành values trên form edit -->
<?php
$select_user = mysqli_query($con, "SELECT * FROM user where id='$_SESSION[user_id]'");
$fetch_user = mysqli_fetch_array($select_user);

?>
<section class="about" id="about">

    <h1 class="heading"> <span>Edit</span> Account </h1>

    <div class="row">

      <div class="info">
          <h1>personal information</h1>
         <?php if ($row_image['name'] != '') { ?>
        <h3> <span> name : </span><?php echo ($row_image['name']); ?></h3>
          <?php } ?>
         <?php if ($row_image['email'] != '') { ?>
        <h3> <span> email : </span></span><?php echo ($row_image['email']); ?></h3>
          <?php } ?>
           <?php if ($row_image['contact'] != '') { ?>
        <h3> <span> phone number : </span> <?php echo ($row_image['contact']); ?> </h3>
            <?php } ?>
            <?php if ($row_image['user_address'] != '') { ?>
        <h3> <span> address : </span> <?php echo ($row_image['user_address']); ?> </h3>
            <?php } ?>
        
      </div>

      <div class="counter">

        <form action="" method="POST" enctype="multipart/form-data">
    <div class="input-box">
        <label for="email"> <b>New email</b></label>
        <input type="text" name="email" value="<?php echo ($fetch_user['email']); ?>" required placeholder="Email" class="boxone">
     </div>
     <div class="input-box">
        <label for="password"> <b>Password</b></label>
        <input type="password" name="current_password" required placeholder="Current Password" class="boxone">
     </div>
        <input type="submit"name="edit_account" value="Edit " class="boxone">
        
      </form>

      </div>

    </div>

  </section>
<!-- xử lý form -->
<?php
if (isset($_POST['edit_account'])) {

    // hàm trim() để loại bỏ mấy cái kí tự đặt biệt  
    $email = trim($_POST['email']);
    $current_password = trim($_POST['current_password']);
    $hash_password = md5($current_password);

    $check_exits = mysqli_query($con, "SELECT * FROM user where email='$email'");

    $email_count = mysqli_num_rows($check_exits);

    $row_register = mysqli_fetch_array($check_exits);


    // (*)khi suất ra có hiện dòng lỗi,
    // cái đó là do phiên bản k ảnh hưởng gì đến web


    if ($email_count > 0) {
        echo ("<script>alert('Xin lỗi,email : $email đã tồn tại')</script>");
    } elseif ($fetch_user['password'] != $hash_password) {
        echo ("<script>alert('Mật khẩu không chính xác,hãy nhập lại!!!')</script>");
    } else {
        $update_email = mysqli_query($con, "UPDATE user set email = '$email' where id='$_SESSION[user_id]'");
        if ($update_email) {
            echo ("<script>alert('Đã thay đổi Email thành công!!!')</script>");
            // sau thi hiện thông báo sẽ điều hướng đến file này lại..
            echo ("<script>window.open(window.location.href,'_self')</script>");
        }
    }
}

?>

</div>
<!--./content_wrapper-->