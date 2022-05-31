<?php
session_start();
if (!isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {
    echo ("<script>window.open('login.php','_self')</script>");
} else {


?>

    <?php include('../config/config.php');
    include('../functions/functions.php'); ?>
   <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Boxicons -->
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  
  <!-- My CSS -->
  <link rel="stylesheet" href="./public/css/list.css?v=<?php echo time(); ?>">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <title>Admin</title>
</head>

<body>


  <!-- SIDEBAR -->
  <section id="sidebar">
    <a href="#" class="brand">
      <i class='bx bxs-smile'></i>
      <span class="text">Admin - <?php
             if (isset($_SESSION['name'])) {
                 echo ($_SESSION['name']);
             }
        ?>
    </span>
    </a>
    <ul class="side-menu top">
       <li>
        <a href="index.php?action">
          <i class='bx bxs-dashboard'></i>
          <span class="text">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="../index.php">
        <i class='bx bxs-doughnut-chart'></i>
          <span class="text">My website</span>
        </a>
      </li>
      <li>
        <a href="index.php?action=order_processing">
       <i class='bx bxs-check-shield'></i>
          <span class="text">order management</span>
        </a>
      </li>
      <li>
        <a href="index.php?action=add_pro">
        <i class='bx bx-cloud-upload'></i>
          <span class="text">Add new products</span>
        </a>
      </li>
      <li>
        <a href="index.php?action=view_pro">
         <i class='bx bxs-grid'></i>
          <span class="text">Product Management</span>
        </a>
      </li>
      <li>
        <a href="index.php?action=add_cat">
           <i class="bx bxs-add-to-queue"></i>
          <span class="text">Add product category</span>
        </a>
      </li>
      <li>
        <a href="index.php?action=view_cat">
        <i class='bx bxs-food-menu' ></i>
          <span class="text">all genres</span>
        </a>
      </li>
      <li>
        <a href="index.php?action=view_users">
          <i class='bx bxs-group'></i>
          <span class="text">User management</span>
        </a>
      </li>
       <li>
        <a href="index.php?action=add_blog">
       <i class='bx bxs-comment-add'></i>
          <span class="text">add blog</span>
        </a>
      </li>
      <li>
        <a href="index.php?action=view_blog">
          <i class='bx bxl-blogger'></i>
          <span class="text">blog Management</span>
        </a>
      </li>
       <li>
        <a href="index.php?action=add_banner">
       <i class='bx bxs-image-add'></i>
          <span class="text">add banner</span>
        </a>
      </li>
      <li>
        <a href="index.php?action=view_banner">
         <i class='bx bx-fullscreen'></i>
          <span class="text">view banner</span>
        </a>
      </li>
       <!-- <li>
        <a href="index.php?action=add_gallery">
         <i class='bx bxs-calendar-event'></i>
          <span class="text">add gallery</span>
        </a>
      </li>
       <li>
        <a href="index.php?action=view_gallery">
        <i class='bx bx-show'></i>
          <span class="text">view gallery</span>
        </a>
      </li> -->
    </ul>
    <ul class="side-menu">
      <li>
        <a href="#">
          <i class='bx bxs-cog'></i>
          <span class="text">Settings</span>
        </a>
      </li>
      <li>
        <a href="logout.php" class="logout">
          <i class='bx bxs-log-out-circle'></i>
          <span class="text">Logout</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- SIDEBAR -->



  <!-- CONTENT -->
  <section id="content">
    <!-- NAVBAR -->
    <nav>
      <i class='bx bx-menu'></i>
      <a href="#" class="nav-link">Categories</a>
      <form action="#">
        <div class="form-input">
          <input type="search" placeholder="Search...">
          <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
        </div>
      </form>
       <div class="notification" id="notifications">
        <i class='bx bxs-bell'></i>
        <span class="num"><?php total_item_contact();?></span>
      </div>
      
      <?php if (isset($_SESSION['user_id'])) { ?>
       <a href="#" class="profile">
         <?php    
         $run_image = mysqli_query($con, "SELECT * FROM user where id='$_SESSION[user_id]'");
         $row_image = mysqli_fetch_array($run_image);
         if ($row_image['image'] != '') {
      ?>
        <img src="../public/upload/<?php echo ($row_image['image']); ?>?v=<?php echo time(); ?>">
         <?php } else { ?>
         <img src="../public/image/profile-icon.png?v=<?php echo time(); ?>" alt="">
         <?php }} ?>
      </a>
       <div class="notificationone" id="notificationsone">
       <i class='bx bx-history'></i>
      </div>
      <!-- --------------- -->
      <?php
      include('includes/contact.php');
      include('includes/history.php');
      ?>

       
    </nav>
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>
      
     <div class="content">
        <div class="content_box">
                        <?php
                        if (isset($_GET['action'])) {
                            $action = $_GET['action'];
                        } else {
                            $action = '';
                        }

                        switch ($action) {
                            case 'add_pro';
                                include 'includes/insert_product.php';
                                break;

                            case 'view_pro';
                                include 'includes/view_products.php';
                                break;

                            case 'edit_pro';
                                include 'includes/edit_product.php';
                                break;

                            case 'add_cat';
                                include 'includes/insert_category.php';
                                break;

                            case 'view_cat';
                                include 'includes/view_categories.php';
                                break;

                            case 'edit_cat';
                                include 'includes/edit_category.php';
                                break;

                            case 'add_brand';
                                include 'includes/insert_brand.php';
                                break;
                            case 'view_brands';
                                include 'includes/view_brands.php';
                                break;

                            case 'edit_brand';
                                include 'includes/edit_brand.php';
                                break;

                            case 'view_users';
                                include 'includes/view_users.php';
                                break;

                            case 'add_blog';
                                include 'includes/insert_blog.php';
                                break;

                            case 'view_blog';
                                include 'includes/view_blog.php';
                                break;

                            case 'edit_blog';
                                include 'includes/edit_blog.php';
                                break;

                            case 'add_banner';
                                include 'includes/insert_banner.php';
                                break;

                            case 'view_banner';
                                include 'includes/view_banner.php';
                                break;

                            case 'edit_banner';
                                include 'includes/edit_banner.php';
                                break;  

                            case 'add_gallery';
                                include 'includes/insert_gallery.php';
                                break;

                            case 'view_gallery';
                                include 'includes/view_gallery.php';
                                break;

                            case 'edit_gallery';
                                include 'includes/edit_gallery.php';
                                break;  
                            case 'order_processing';
                                include 'includes/order_processing.php';
                                break;    
                             default:
                                 include 'includes/home.php' ;     
                        }
                        ?>
                    </div>
    </main>
    <!-- MAIN -->
  </section>
  <!-- CONTENT -->


  <script src="./public/js/main.js?v=<?php echo time(); ?>"></script>
</body>

</html>


    <!-- hiệu ứng tạo thanh menu trượt -->

    <!--Cái js này là :sau khi click vào biểu tượng or... thì nó sẽ xử lý.
        thì ở đây thì ta sẽ thực hiện tìm kiếm class để xử lý bằng hàm find() ,
        rồi tiếp tục sử dụng hàm slideToggle() : nó tựa như chức năng :hover
        với tốc độ là fast -->
    <!-- <script>
        //thanh products,categories
        $(document).ready(function() {
            $(".dropdown-navbar-right").on('click', function() {
                $(this).find(".subnavbar-right").slideToggle('fast');
            });
            // thông báo,account
            $(".left_sidebar_first_level li").on('click', this, function() {
                $(this).find(".left_sidebar_second_level").slideToggle('fast');
            });
        });
    </script> -->
<?php } ?>