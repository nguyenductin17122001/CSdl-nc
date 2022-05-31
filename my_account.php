<?php

if (!isset($_SESSION)) {
    session_start();
}
include("functions/functions.php");
include("config/config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>responsive personal portfolio website design tutorail</title>

  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

  <!-- custom css file link  -->
  <link rel="stylesheet" href="./public/css/account.css?v=<?php echo time(); ?>">

</head>

<body>
  <?php if (isset($_SESSION['user_id'])) { ?>
  <!-- header section starts  -->
    
  <header>
     
    <div class="user">
      <?php    
         $run_image = mysqli_query($con, "SELECT * FROM user where id='$_SESSION[user_id]'");
         $row_image = mysqli_fetch_array($run_image);
         if ($row_image['image'] != '') {
      ?>
      <img src="./public/upload/<?php echo ($row_image['image']); ?>?v=<?php echo time(); ?>" alt="">
       <?php } else { ?>
         <img src="./public/image/profile-icon.png?v=<?php echo time(); ?>" alt="">
         <?php } ?>
         <?php if ($row_image['name'] != '') { ?>
          <h3 class="name"><?php echo ($row_image['name']); ?></h3>
           <?php } ?>
           <a href="index.php"><i class="fas fa-sign-out-alt"></i></a>
    </div>
    
        
            
    <nav class="navbar">
      <ul>
        <li><a href="#home">home</a></li>
        <li><a href="#about">Edit Account</a></li>
        <li><a href="#education">Edit Profile</a></li>
        <li><a href="#portfolio">Change Avatar</a></li>
        <li><a href="#contact">Change Password</a></li>
      </ul>
    </nav>
      
  </header>

  <!-- header section ends -->

  <div id="menu" class="fas fa-bars"></div>

  <!-- home section starts  -->

  <section class="home" id="home">

    <h3>Welcome to Cosmetics !</h3>
    <?php if ($row_image['name'] != '') { ?>
    <h1>Account <span><?php echo ($row_image['email']); ?></span></h1>
      <?php } ?>
    <p>Thank you so much for helping us become the number one brand in the hearts of our customers.
       We could not have achieved this success without you as our customer.
       Your satisfaction is our number one concern and we promise to always be reliable.
    </p>
    <a href="#about"><button class="btn"> Edit Account <i class="fas fa-user"></i></button></a>

  </section>
    <?php
    include("include/edit_account.php");
    include("include/edit_profiles.php");
    include("include/user_profile_picture.php");
    include("include/change_password.php");
    ?>
  <!-- home section ends -->
    
  <!-- about section starts  -->

  

  <!-- about section ends -->

  <!-- education section starts  -->

 

  <!-- education section ends -->

  <!-- portfolio section starts  -->

 
  <!-- portfolio section ends -->

  <!-- contact section starts  -->

  

  <!-- contact section ends -->


  <!-- scroll top button  -->

  <a href="#home" class="top">
    <img src="./public/image/scroll-top-img.png" alt="">
  </a>

   











  <?php } ?> 

  <!-- jquery cdn link  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- custom js file link  -->
  <script src="./public/js/jsaccount.js?v=<?php echo time(); ?>"></script>


</body>

</html>