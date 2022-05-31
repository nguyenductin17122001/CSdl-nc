 <?php
 include("include/header.php");

 ?>
<section class="contact" id="contact">

        <h1 class="heading"> <span>contact</span> us </h1>

        <div class="icons-container">

            <div class="icons">
                <i class="fas fa-map-marker-alt"></i>
                <h3>address</h3>
                <p>Hoa khanh, DaNang, VietNam - 500104</p>
            </div>

            <div class="icons">
                <i class="fas fa-envelope"></i>
                <h3>email</h3>
                <p>nguyenductin2k1@gmail.com</p>
                <p>nguyenductin17122001@gmail.com</p>
            </div>

            <div class="icons">
                <i class="fas fa-phone"></i>
                <h3>phone</h3>
                <p>+123-456-7890</p>
                <p>+111-222-3333</p>
            </div>

        </div>

        <div class="row">

           <form action=""  method="post"  enctype="multipart/form-data">
                <h3>get in touch</h3>
                <div class="inputBox">
                    <input type="text" placeholder="your name" name="name"  required>
                    <input type="email" placeholder="your email" name="email"  required>
                </div>
                <div class="inputBox">
                    <input type="number" placeholder="your phone" name="phone"  required>
                    <input type="text" placeholder="your address" name="address"  required>
                </div>
                <textarea placeholder="your message" cols="30" rows="10" name="message"  required></textarea>
                <input type="submit" value="send message" class="btn" name="send">
            </form>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d21377.947946914737!2d108.15349469582098!3d16.060738508195996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31421924682e8689%3A0x48eb0bdbeec05215!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYyBTxrAgUGjhuqFtIC0gxJBIxJBO!5e0!3m2!1svi!2s!4v1633580677808!5m2!1svi!2s"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            <!-- <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30153.788252261566!2d72.82321484621745!3d19.141690214227783!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b63aceef0c69%3A0x2aa80cf2287dfa3b!2sJogeshwari%20West%2C%20Mumbai%2C%20Maharashtra%20400047!5e0!3m2!1sen!2sin!4v1633431163028!5m2!1sen!2sin" allowfullscreen="" loading="lazy"></iframe> -->

        </div>

    </section>
<?php
  if(isset($_POST['send'])){
     if(!isset($_SESSION['email'])){
         echo ("<script>alert('bạn cần đăng nhập trước khi gửi đến admin');</script>");
      }
      else{
           if(isset($_POST['send'])){
                $user_id = $_SESSION['user_id'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $message = $_POST['message'];

                $insert_contact = "INSERT INTO `contacts`( `user_id`,`name`, `email`, `phone`, `address`, `message`) VALUES ('$user_id','$name','$email','$phone','$address','$message')";

                $insert = mysqli_query($con, $insert_contact);
                 if ($insert) {
                     echo ("<script>alert('đã gửi thành công!')</script>");
                    echo ("<script>window.open('index.php','_self')</script>");
                }
            }
      }
}
?>
   <?php
    include("include/footer.php");
    ?>