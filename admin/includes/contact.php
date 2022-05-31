<form action="" class="contact-form" method="POST" enctype="multipart/form-data">
        <div class="top-content">
          <div class="left-text">
            contact from customer
          </div>
          <div class='bx bxs-paper-plane' id="plane"></div>
        </div>
        <!-- ---- -->
        <div class="warpper">
           <?php
          
          
          $all_contact = mysqli_query($con, "SELECT * FROM `v_contact`");


           $i = 1;
            if(mysqli_num_rows($all_contact) > 0){
              while ($row = mysqli_fetch_array($all_contact)) {
          ?>
          <div class="box">
            <a href="index.php?delete_contact=<?php echo($row['contact_id']); ?>" class="delete"><i class='bx bx-x'></i></a>
              <div class="day"><?php echo ($row['day']); ?></div>
            <i class="fas fa-quote-left quote"></i>
            <p><?php echo ($row['message']); ?></p>
            <div class="content">
              <div class="info">
                <div class="name"><?php echo ($row['name']); ?></div>
                <div class="job"><?php echo ($row['email']); ?></div>
              </div>
              <div class="image">
                <?php if ($row['image'] != '') { ?>
                <img src="../public/upload/<?php echo ($row['image']) ?>" alt="">
                <?php } else { ?>
                  <img src="../public/image/profile-icon.png" alt="">
                   <?php } ?>
              </div>
            </div>

              </div>
             <?php
                    $i++;
                }}
                else{
                   echo '<p class="request">There is not a request sent to</p>';
                    echo '<img  class="no-contact" src="../public/image/contacs.png">';
                  }
                ?>

          </div>
      </form>
     <?php
                  if (isset($_GET['delete_contact'])) {
                        $delete_cart = mysqli_query($con, "DELETE from contacts where contact_id='$_GET[delete_contact]' ");
                                    
                        if ($delete_cart) {
                            echo ("<script>alert('Đã xoá ');</script>");
                            echo ("<script>window.open('index.php','_self')</script>");
                        }
                    }
     ?>