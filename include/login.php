
<form action="" class="login-form" method="POST">
        <h3>login now</h3>
        <input type="email" placeholder="your email" class="box" name="email">
        <input type="password" placeholder="your password" class="box" name="password">
        <p>forget your password <a href="#">click here</a></p>
        <p>don't have an account <a href="register.php">create now</a></p>
        <input type="submit" value="login now" class="btn" name="login">
    </form>
<?php
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $password = md5($password);
    $run_login = mysqli_query($con, "SELECT * FROM user where password = '$password' AND email='$email'");

    $check_login = mysqli_num_rows($run_login);
    $row_login = mysqli_fetch_array($run_login);
    
    if ($check_login == 0) {
        echo ("<script>alert('Email hoặc mật khẩu không chính xác,hãy nhập lại!!!')</script>");
          echo ("<script>window.open('index.php','_self')</script>");
        exit();
    }
    $ip = get_ip();
    $run_cart = mysqli_query($con, "SELECT * FROM cart where ip_address = '$ip'");
    $check_cart = mysqli_num_rows($run_cart);
    if ($check_login > 0 and $check_cart == 0) {

        $_SESSION['user_id'] = $row_login['id'];
        $_SESSION['role'] = $row_login['role'];


        $_SESSION['email'] = $email;
        echo ("<script>alert('Bạn đã đăng nhập thành công!!')</script>");
        echo ("<script>window.open('index.php','_self')</script>");
    } else {
         $_SESSION['user_id'] = $row_login['id'];
         $_SESSION['role'] = $row_login['role'];

        $_SESSION['email'] = $email;
        echo ("<script>alert('Bạn đã đăng nhập thành công!!')</script>");
        
        if($_SESSION['role']=='admin'){
            echo ("<script>alert('Bạn đang truy cập với quyền admin');</script>");
        }

        echo ("<script>window.open('index.php','_self')</script>");
        
        
    }
    
   
}
?>