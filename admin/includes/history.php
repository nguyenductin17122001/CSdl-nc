<form action="" class="history-form" method="POST" enctype="multipart/form-data">
        <div class="top-content">
          <div class="left-text">
           Operation history
          </div>
          <div  class='bx bx-history' id="plane"></div>
        </div>
        <!-- ---- -->
        <div class="warpper">
           <?php
          
          $all_history = mysqli_query($con, "SELECT * FROM history  order by id_history DESC");
           $i = 1;
            if(mysqli_num_rows($all_history) > 0){
              while ($row = mysqli_fetch_array($all_history)) {

          ?>
         
          <div class="box">
            <a href="index.php?delete_history=<?php echo($row['id_history']); ?>" class="delete"><i class='bx bx-x'></i></a>
              <div class="day"><?php echo ($row['time']); ?></div>
              <h3>You have <strong> <?php echo ($row['activate']); ?></strong>  </br> the product <?php echo ($row['product_title']); ?> </br> with the price <?php echo ($row['product_price']); ?>$</h3>
            <div class="content">
             
              <div class="image">
                
                <img src="./public/product_images/<?php echo ($row['product_image']) ?>" alt="">
                
              </div>
            </div>

              </div>
             <?php
                    $i++;
                }}
                else{
                   echo '<p class="request">No activities have been done yet</p>';
                    echo '<img  class="no-contact" src="../public/image/history.png">';
                  }
                ?>

          </div>
      </form>
     <?php
                  if (isset($_GET['delete_history'])) {
                        $delete_cart = mysqli_query($con, "DELETE from history where id_history='$_GET[delete_history]' ");
                                    
                        if ($delete_cart) {
                            echo ("<script>alert('Đã xoá ');</script>");
                            echo ("<script>window.open('index.php','_self')</script>");
                        }
                    }
     ?>