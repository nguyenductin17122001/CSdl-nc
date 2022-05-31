
<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/admin_form_login.css?v=<?php echo time(); ?>">
       <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
   
    <title>login admin</title>
</head>
<body>
     <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
        <h3>Welcome Admin!
            <span>Login to your account.</span>
        </h3>

        <label for="username">Username</label>
        <input type="text" placeholder="your account name" id="username"  name="email">

        <label for="password">Password</label>
        <input type="password" placeholder="Minimum 4 characters" id="password" name="password" >
         
          <input type="submit" name="login"  class="button" value="Log In" />
        
    </form>
</body>
</html>
<!-- Created By CodingNepal -->

<!-- <form action="" method="POST" enctype="multipart/form-data">

	<h2>Admin Login</h2>

	<input type="text" name="email" class="text-field" placeholder="Email" />
    <input type="password" name="password" class="text-field" placeholder="Password" />
    
   <input type="submit" name="login"  class="button" value="Log In" />

</form> -->
 

    <!-- ===== MAIN JS ===== -->
   


<?php
    include('../config/config.php');
    if(isset($_POST['login'])){
        $email = trim(mysqli_real_escape_string($con,$_POST['email']));

        $password = trim(mysqli_real_escape_string($con,$_POST['password']));

        $hash_password = md5($password);

        $sel_user = "SELECT * FROM user where email = '$email' AND password = '$hash_password'";

        $run_user = mysqli_query($con,$sel_user) or die ("error:" . mysqli_errno($con));
        $check_user = mysqli_num_rows($run_user);
        
        if($check_user >0){
            $db_row = mysqli_fetch_array($run_user);

            $_SESSION['email'] = $db_row['email'];
            $_SESSION['name'] = $db_row['name'];
            $_SESSION['user_id'] = $db_row['id'];
            $_SESSION['role'] = $db_row['role'];

            if($db_row['role'] == 'admin'){
                echo("<script>window.open('index.php?logged_in=Bạn đã đăng nhập thành công','_self')</script>");
            }
            elseif($db_row['role'] == 'guest'){
                  echo("<script>alert('Mật khẩu or Tài khoảng sai,bạn là khác hàng,không phải admin');</script>");  
            }
            
        }else{
            echo "<script>alert('Password or Email is wrong, try again!')</script>";
            
            }
    }
?>