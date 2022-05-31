<?php
include("functions/functions.php");
?>

<!-- js này dùng để confirm password,
    nó nhắc ta nhập đúng pass khi confirm lại, 
    có thể ko cần js này cũng đc -->

   
<!DOCTYPE html>
<!-- Designined by CodingLab - youtube.com/codinglabyt -->
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> cosmetics </title>
  <link rel="shortcut icon" type="image" href="image/logo.png">
  <link rel="stylesheet" href="./public/css/register.css?v=<?php echo time(); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <div class="container">
    <div class="title">Registration</div>
    <div class="content">
      <form method="post" action="" enctype="multipart/form-data">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" placeholder="Enter your name" name="name" required>
          </div>
          <div class="input-box">
            <span class="details">Address</span>
            <input type="text" placeholder="Enter your address" name="address" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" placeholder="Enter your email" name="email" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" placeholder="Enter your number" name="contact" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="text" placeholder="Enter your password" id="password_confirm1" name="password" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="text" placeholder="Confirm your password" id="password_confirm2" name="confirm_password"
              required>
          </div>
          <div class="input-box">
            <span class="details">choose avatar</span>
            <input type="file" id="file" accept="image/*" name="image">
            <label for="file"> Photo <i class='bx bx-photo-album'></i></label>
          </div>
        </div>
        <button class="button" name="register" type="submit">Register</button>
        <p class="subtitle">Already have an account? <a href="index.php?action=login"> Login</a></p>
      </form>
    </div>
  </div>

</body>

</html>

<!-- xử lý form -->
<?php
if (isset($_POST['register'])) {
    if (
        !empty($_POST['email'])
        && !empty($_POST['password'])
        && !empty($_POST['confirm_password'])
        && !empty($_POST['name'])
    ) {
        $ip = get_ip();
        $name = $_POST['name'];
        // hàm trim() để loại bỏ mấy cái kí tự đặt biệt  
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $hash_password = md5($password);
        $confirm_password = trim($_POST['confirm_password']);

        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        
        
        $check_exits = mysqli_query($con, "SELECT * FROM user where email='$email'");
        
        $email_count = mysqli_num_rows($check_exits);

        $row_register = mysqli_fetch_array($check_exits);


        // (*)khi suất ra có hiện dòng lỗi,
        // cái đó là do phiên bản k ảnh hưởng gì đến web


        if ($email_count > 0) {
            echo ("<script>alert('Xin lỗi,email : $email đã được sử dụng')</script>");
        } elseif ($row_register['email'] != $email && $password == $confirm_password) {
                move_uploaded_file($image_tmp, "./public/upload/$image");
                $run_insert = mysqli_query($con, "INSERT INTO user (ip_address,name,email,password,contact,user_address,image) values('$ip','$name','$email','$hash_password','$contact','$address','$image')");
                if($run_insert){
                    $sel_user = mysqli_query($con,"SELECT * FROM user where email='$email'");
                    $row_user = mysqli_fetch_array($sel_user);
                     $_SESSION['user_id'] = $row_user['id'];
                     $_SESSION['role'] = $row_user['role'];
                }   
                // kiểm tra xem có sản phẩm trong cart k
                $run_cart = mysqli_query($con,"SELECT * FROM cart where ip_address= '$ip'");
                $check_cart = mysqli_num_rows($run_cart);


                //nếu KHÔNG có sản phẩm trong cart thì điều sang trang my_account
                if($check_cart == 0){
                    $_SESSION['email'] = $email;
                    echo("<script>alert('Đăng ký thành công')</script>");
                    echo("<script>window.open('index.php','_self')</script>");
                }
                //nếu có sản phẩm trong cart thì điều sang trang thanh toán lun.
                else{
                    $_SESSION['email'] = $email;
                    echo("<script>alert('Đăng ký thành công')</script>");
            
                    
                }
        }
        else{
            if($password != $confirm_password){
                echo("<script>alert('mật khẩu không khớp..')</script>");
            }
        }


    }
}
?>

</div>
<!--./content_wrapper-->

