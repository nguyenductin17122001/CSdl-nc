<!-- //lấy lại mấy thông tin của user,để đưa thành values trên form edit -->
<?php
$select_user = mysqli_query($con, "SELECT * FROM user where id='$_SESSION[user_id]'");
$fetch_user = mysqli_fetch_array($select_user);
?>
 <section class="portfolio" id="portfolio">

    <h1 class="heading"> Change <span>Avatar</span> </h1>

    <div class="avata">
       <form action="" method="POST" enctype="multipart/form-data">
         <input type="file" name="image">
                    <div class="images">
                        
                        <img src="./public/image/vongtron2.png" alt="" >
                        <?php
                         if ($fetch_user['image'] != '') {
                        ?>
                        <img src="./public/upload/<?php echo $fetch_user['image'] ?> " alt="">
                         <?php } else { ?>
                               <img src="./public/image/profile-icon.png?v=<?php echo time(); ?>" alt="">
                         <?php } ?>
                    </div>
               
        <input type="submit"name="user_profile_picture" value="Save Change" class="boxthree">
        
      </form>
    </div>

  </section>

<!-- xử lý form -->
<?php
if (isset($_POST['user_profile_picture'])) {

    //kiểm tra xem thử file có rỗng k.
    if (!empty($_FILES['image']['name'])) {

        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        $target_file = "./public/upload/" . $image;

        $uploadOk = 1;
        $message = '';

        if ($_FILES['image']['size'] < 5098888) {

            //kiểm tra file này đã tồn tại chưa.
            if (file_exists($target_file)) {

                $uploadOk = 0;
                $message .= "Xin lỗi, ảnh này đã tồn tại";
            } 
            if($uploadOk == 0){
                $message .=", hãy thử với file khác..";
            }
            else {
                if (move_uploaded_file($image_tmp, $target_file)) {

                    $update_image = mysqli_query($con, "UPDATE user set image='$image' where id='$_SESSION[user_id]'");
                    $message .= "File" . basename($image) . "đã được upload.";
                } else {
                    $message .= "Đã xảy ra lỗi trong quá trình tải ảnh,vui lòng check lại!!!";
                }
            }
        }
    }
}
?>
<style>
.edit{
        color:#fff;
        font-size: 30px;
        position: relative;
        left:160px;
        text-shadow: 2px 1px 2px #130f40;
    }

h3{
    color :#fff;
    font-size:15px;
    display: block;
    font-weight: 550px;
    
   
}    
</style>

<p style="color:green;margin-left:20px">
    <?php if (isset($message)) {
        echo ($message);
    }
    ?>

</p>
<!--./content_wrapper-->