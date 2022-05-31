  <?php
 include("include/header.php");
 ?>
 <section class="blogs" id="blogs">

        <h1 class="heading"> our <span>blogs</span></h1>

        <div class="swiper blogs-slider">
            <div class="swiper-wrapper">
              <?php
                         $get_blog = "CALL `viewblog`();" ;

                    if($run_blog = mysqli_query($con,$get_blog)){
                
                    while($row_blog = mysqli_fetch_array($run_blog)){
                        $blog_id=$row_blog['blog_id'];
                        $blog_title = $row_blog['blog_title'];
                        $blog_desc = $row_blog['blog_desc'];
                        $blog_image = $row_blog['blog_image'];
                        $blog_date = $row_blog['blog_date'];
                        echo("
                                    <div class='swiper-slide slide'>
                                        <div class='image'>
                                            <img src='admin/public/images/$blog_image' alt=''>
                                        </div>
                                        <div class='content'>
                                            <h3>$blog_title</h3>
                                            <p>$blog_desc</p>
                                            <a href='detail_blog.php?blog_id=$blog_id' class='btn'>read more</a>
                                            <div class='icons'>
                                                <a href='#'> <i class='fas fa-calendar'></i> $blog_date </a>
                                                <a href='#'> <i class='fas fa-user'></i> by admin </a>
                                            </div>
                                        </div>
                                    </div>                  
                            ");
                    }
                }
                ?>


            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

        </div>

    </section>
 <?php
    include("include/footer.php");
    ?>