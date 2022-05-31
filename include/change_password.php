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
<section class="contact" id="contact">

    <h1 class="heading"> <span>Change</span> Password </h1>

    <div class="row">

        <div class="info">
           <img src="./public/image/chang2.jpg" alt="">
      </div>
     
      <form action=""method="POST" enctype="multipart/form-data">
       
        <div class="input-box">
            <label for="Current password"> <b>Current password</b></label>
             <input type="password" name="current_password" name="password" placeholder="Enter your Password" class="boxfour" >
        </div>
        <div class="input-box">
          <label for="New password"><b>New Password</b></label>
          <input type="password"  id="password_confirm1" name="new_password" placeholder="Enter your Password"  class="boxfour">
        </div>
        <div class="input-box">
           <label for="confirm_password"><b>Comfirm new Password</b></label>
           <input type="password" id="password_confirm2" name="confirm_new_password" placeholder="Enter your Password"  class="boxfour">
            <p id="status_for_confirm_password"></p>
        </div>
        <input type="submit"name="change_password" value="Save Change" class="boxfour">

      </form>

    </div>

  </section>
<!-- xử lý form -->
<?php
if (isset($_POST['change_password'])) {

    $current_password = trim($_POST['current_password']);
    $hash_current_password = md5($current_password);

    $new_password = trim($_POST['new_password']);
    $hash_new_password = md5($new_password);
    $confirm_new_password = trim($_POST['confirm_new_password']);

    $select_password = mysqli_query($con, "SELECT * FROM user where password='$hash_current_password' AND id = '$_SESSION[user_id]'");

    //kiểm tra nếu password trống

    if (mysqli_num_rows($select_password) == 0) {
        echo ("<script>alert('Nhập mật khẩu không đúng.!!')</script>");
    } else {
        if ($new_password != $confirm_new_password) {
            echo ("<script>alert('Password không khớp.!!')</script>");
        } else {
            $update = mysqli_query($con, "UPDATE user set password='$hash_new_password' where id='$_SESSION[user_id]'");
            
            if($update){
                echo ("<script>alert('Thay đổi password thành công.')</script>");
                echo("<script>window.open(window.location.href,'_self')</script>");
            }
            else{
                echo("<script>alert('Database query failed : mysqli_error($con !)');</script>");
            }
        }
    }
}
?>