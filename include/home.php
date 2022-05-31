<section class="home" id="home">

        <div class="swiper home-slider">

            <div class="swiper-wrapper">
                  <?php
                        $get_banner = "SELECT * FROM banners" ;
                        $run_banner = mysqli_query($con,$get_banner);
                
                    while($row_banner = mysqli_fetch_array($run_banner)){
                        $banner_id=$row_banner['banner_id'];
                        $banner_title = $row_banner['banner_title'];
                        $banner_upto = $row_banner['banner_upto'];
                        $banner_image = $row_banner['banner_image'];
                       
                        echo("
                     <div class='swiper-slide slide' style='background:url(admin/public/images/$banner_image) no-repeat;height: 600px;'>
                              <div class='content'>
                                <span>$banner_upto</span>
                                <h3> $banner_title</h3>
                                <a href='#products' class='btn'>shop now</a>
                            </div>
                        </div>               
                            ");
                    }
                ?>

              

                <!-- <div class="swiper-slide slide"
                    style="background:url(image/banner4.jpg) no-repeat;height: 600px;object-fit: cover;">
                    <div class="content">
                        <span>upto 50% off</span>
                        <h3>cosmetics for men</h3>
                        <a href="#" class="btn">shop now</a>
                    </div>
                </div>

                <div class="swiper-slide slide" style="background:url(image/banner3.jpg) no-repeat;height: 600px;">
                    <div class="content">
                        <span>upto 50% off</span>
                        <h3>new cosmetics</h3>
                        <a href="#" class="btn">shop now</a>
                    </div>
                </div> -->

            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

        </div>

    </section>