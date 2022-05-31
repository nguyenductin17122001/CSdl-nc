<?php
include("functions/functions.php");
include("config/config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> cosmetics</title>
    <link rel="shortcut icon" type="image" href="image/logo.png">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="./public/css/blog.css?v=<?php echo time(); ?>">

</head>

<body>



    <section class="banner" id="banner">
        <div class="content">
            <h3>explore the nature</h3>
            <p>You will find a wide variety of beauty themes. From cosmetics, skin care methods, 
                hair care or makeup, health training, reasonable diet</p>
            <a href="blogs.php" class="btn">Exit <i class="fas fa-sign-out-alt"></i></a>
        </div>

    </section>

    <!-- banner section ends -->

    <!-- posts section starts  -->

    <section class="container" id="posts">

        <div class="posts-container">
              <?php
            if (isset($_GET['blog_id'])) {
                $blog_id = $_GET['blog_id'];
                $run_query_by_blog_id = mysqli_query($con, "CALL `chitietblog`( $blog_id);");

                while ($row_blog = mysqli_fetch_array($run_query_by_blog_id)) {
                    $blog_id = $row_blog['blog_id'];
                    $blog_title = $row_blog['blog_title'];
                    $blog_date = $row_blog['blog_date'];
                    $blog_image = $row_blog['blog_image'];
                    $blog_desc = $row_blog['blog_desc'];
                    $blog_content = $row_blog['blog_content'];
                    echo ("
                            <div class='post'>
                             <div class='post-img'>
                              <img src='admin/public/images/$blog_image' alt='' class='image'>
                               </div>
                                <div class='date'>
                                <i class='far fa-clock'></i>
                                <span>$blog_date</span>
                            </div>
                            <h3 class='title'> $blog_title</h3>
                            <p class='text'> $blog_content</p>
                            
                            <div class='links'>
                          <a href='#' class='user'>
                        <i class='far fa-user'></i>
                        <span>by admin</span>
                    </a>
                </div>
            </div>
                        ");
                }
            }
            ?>
            <!-- <div class="post">
                <img src="image/blog-1.jpg" alt="" class="image">
                <div class="date">
                    <i class="far fa-clock"></i>
                    <span>1st may, 2021</span>
                </div>
                <h3 class="title">blog title goes here</h3>
                <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum molestias rerum numquam,
                    quos aut est culpa quisquam excepturi sed a inventore dicta tempore consequuntur possimus magnam
                    corporis cum doloremque quasi fugiat exercitationem aliquid cupiditate pariatur. Dolor laboriosam
                    voluptatem ex praesentium magni error debitis maxime alias autem distinctio. Fuga, esse velit!</p>
                <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, reiciendis fugiat
                    quas nemo quia omnis repellat obcaecati quaerat voluptates fuga error dicta cupiditate pariatur
                    soluta dolorum quis eum quibusdam quam?</p>
                <div class="links">
                    <a href="#" class="user">
                        <i class="far fa-user"></i>
                        <span>by admin</span>
                    </a>
                </div>
            </div> -->
        </div>
         <div class="sidebar">

            <div class="box">
                <h3 class="title">Shop</h3>
                <div class="about">
                    <img src="./public/image/logo_blog.jpg" alt="">
                    <h3>cosmetics shop</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique, officia.</p>
                    <div class="follow">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                    </div>
                </div>
            </div>

            <div class="box">
                <h3 class="title">categories</h3>
                <div class="category">
                    <?php
                    getBrands_blog()
                    ?>
                    

                </div>
            </div>
          </div>  


    </section>

<section class="footer">

        <div class="follow">
            <!-- <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
        </div> -->

        <div class="credit">created by <span>NĐT-2K1</span> | all rights reserved</div>

    </section>





       

</body>

</html>