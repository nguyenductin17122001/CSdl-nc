 <?php
 include("include/header.php");
 ?>
 <section class="products" id="products">

        <h1 class="heading"> exclusive <span>products</span> </h1>

        <div class="filter-buttons">
            <!-- <div class="buttons active" data-filter="all">all</div> -->
            <!-- <div class="buttons" data-filter="arrivals">new arrivals</div>
            <div class="buttons" data-filter="featured">featured</div>
            <div class="buttons" data-filter="special">special offer</div>
            <div class="buttons" data-filter="seller">best seller</div> -->
            <?php getCats(); ?>
        </div>

        <div class="box-container">
                <?php
                   getPro()
                ?>
                 <?php
                   get_pro_by_cat_id()
                ?>
                

            

        </div>

    </section>
    <?php
    include("include/footer.php");
    ?>