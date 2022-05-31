<?php

if (!isset($_SESSION)) {
    session_start();
}

include ("config/config.php");
?>
<?php
include("functions/functions.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> cosmetics</title>
    <link rel="shortcut icon" type="image" href="./public/image/logo.png">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
     -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="./public/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./public/css/style-prefix.css?v=<?php echo time(); ?>">

</head>

<body>

   



  <!--
    - NOTIFICATION TOAST
  -->
<!-- 
  <div class="notification-toast" data-toast>

    <button class="toast-close-btn" data-toast-close>
      <ion-icon name="close-outline"></ion-icon>
    </button>

    <div class="toast-banner">
      <img src="./public/image/sanpham (10).jpg" alt="Rose Gold Earrings" width="120" height="70">
    </div>

    <div class="toast-detail">

      <p class="toast-message">
       on the 6th of June
      </p>

      <p class="toast-title">
        Ultrahydrate Serum
      </p>

      <p class="toast-meta">
        <time datetime="PT2M">-20% </time> off
      </p>

    </div>

  </div> -->


    <!-- header section starts  -->

    <header class="header">

        <a href="#" class="logo"> <img src="./public/image/logo.png" alt="" width="100px" height="70px"></a>

        <nav class="navbar">
            <a href="index.php">home</a>
            <a href="products.php">products</a>
            <a href="featured.php">featured</a>
            <a href="#review">review</a>
            <a href="contact.php">contact</a>
            <a href="blogs.php">blogs</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="search-btn" class="fas fa-search"></div>
            <!-- <a href="#" class="fas fa-shopping-cart"></a> -->
            <!-- <a href="#" class="fas fa-heart"></a> -->
            <div class="fas fa-heart" id="cor-btn"></div>
            <div class="fas fa-shopping-cart" id="cart-btn"> <span class="num"><?php sum_quality();?></span></div>
              <?php if (!isset($_SESSION['user_id'])) { ?>
            <div class="fas fa-user" id="login-btn"></div>
             <?php } else { ?>
            <div class="fas fa-user" id="login-btn"></div>
             <div class="fas fa-cog" id="setting-btn"></div>
             <?php } ?>
        </div>

        <form action="results.php" class="search-form" method="GET" enctype="multipart/form-data">
            <input type="search" name="user_query" placeholder="search here..." id="search-box">
            <input type="submit" name="search" value="Search">
        </form>
        <?php
        include("include/liked.php")
        ?>
          <?php
          include("include/cart.php");
          ?>
       

        <?php if (!isset($_SESSION['user_id'])) { ?>
        <?php include("include/login.php");?>
        <?php } else { ?>

                <?php
                $select_user = mysqli_query($con, "SELECT * FROM user where id='$_SESSION[user_id]'");
                $data_user = mysqli_fetch_array($select_user);
                ?>

        <div class="side-setting">
          
            <div id="close-side-setting" class="fas fa-times"></div>
            
            <div class="user">
                 <?php if ($data_user['image'] != '') { ?>
                <img src="./public/upload/<?php echo ($data_user['image']); ?>" alt="">
                  <?php } else { ?>
                                 <span><img src="./public/image/profile-icon.png?v=<?php echo time(); ?>" alt=""></span>
                         <?php } ?>
                 <?php if ($data_user['name'] != '') { ?>        
                <h3><?php echo ($data_user['name']); ?></h3>
                  <?php } ?>
                <a href="logout.php">log out</a>
            </div>
             <?php if($_SESSION['role'] != 'admin'){ ?>
            <nav class="navbar-setting">
                <a href="purchase_history.php?user=<?php echo $_SESSION['user_id'] ?>"> <i class="fas fa-angle-right"></i> my order </a>
                <a href="my_account.php?action=edit_account"> <i class="fas fa-angle-right"></i> my account </a>
               
            </nav>
            </nav>
               <?php }else{ ?>
                <nav class="navbar-setting">
                 <a href="../../cosmetics3/admin/"> <i class="fas fa-angle-right"></i> admin </a>
                 <a href="purchase_history.php?user=<?php echo $_SESSION['user_id'] ?>"> <i class="fas fa-angle-right"></i> my order </a>
                <a href="my_account.php"> <i class="fas fa-angle-right"></i> my account </a>
            </nav>
             <?php } ?>
        </div>
          <?php } ?>
         
    </header>
