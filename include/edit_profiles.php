<!-- //lấy lại mấy thông tin của user,để đưa thành values trên form edit -->
<?php
$select_user = mysqli_query($con, "SELECT * FROM user where id='$_SESSION[user_id]'");
$fetch_user = mysqli_fetch_array($select_user);

?>
 <section class="education" id="education">
  
    <h1 class="heading"> Edit <span>Profile</span> </h1>
    <div class="list">
      <div class="box_img">
        <img src="./public/image/edit2.jpg" alt="" >
    </div>
     <div class="edit">
       <form action="" method="POST" enctype="multipart/form-data">
        <div class="input-box">
            <label for="name"> <b>Name</b></label>
            <input type="text"  name="name" value="<?php echo ($fetch_user['name']); ?>" required placeholder="Name" class="boxtwo">
        </div>
          <div class="input-box">
            <label for="contact"> <b>Contact</b></label>
            <input type="text"  name="contact" value="<?php echo ($fetch_user['contact']); ?>" placeholder="Contact" class="boxtwo">
        </div> 
        <div class="input-box">
           <label for="address"> <b>Address</b></label>
            <input type="text" name="address" value="<?php echo ($fetch_user['user_address']); ?>" placeholder="Address" class="boxtwo">
        </div>
            <input type="submit"name="edit_profile" value="Edit " class="boxtwo">
        
      </form>
     </div>
    </div>
    
    </div>

  </section>
<!-- xử lý form -->
<?php
if (isset($_POST['edit_profile'])) {

    if ($_POST['name'] != '' 
    && $_POST['contact'] != '' 
    && $_POST['address'] !='') {
        // hàm trim() để loại bỏ mấy cái kí tự đặt biệt  
       
        $name = $_POST['name'];
       
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        
        $update_profile = mysqli_query($con,"UPDATE user set name = '$name',contact = '$contact',user_address = '$address' where id='$_SESSION[user_id]'");

        if($update_profile){
            echo("<script> alert('Cập nhật pro5 thành công') </script>");
            echo("<script>window.open(window.location.href,'_self')</script>");
        }
        
    }
}

?>

</div>
<!--./content_wrapper-->