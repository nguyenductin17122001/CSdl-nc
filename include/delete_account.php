<style>
    .delete_account_container {
        padding: 10px;
    }
    .delete_account_box{
        width: 50%;
    }
    .delete_account_box input[type=submit]{
        padding: 7px 15px;
        margin: 20px;
        float: right;
        border: none;
    }
    .yes_btn{
        background-color: rgba(3, 169, 252, 0.9);
        color: white;
    }
</style>

<div class="delete_account_container">
    <h1 style="text-align: left;">
        Confirm Box
    </h1>
    <hr>
    <div class="delete_account_box">
        <h4>
            Bạn có chắc muốn xoá account này???
        </h4>
        <form action="" method="POST">
            <input type="submit" class="yes_btn" name="yes" value="Yes">
            <input type="submit" name="cancel" value="Cancel">
        </form>
    </div>
</div>

<?php
    if(isset($_POST['yes'])){

        $delete_account = mysqli_query($con,"DELETE from user where id='$_SESSION[user_id]'");

        //nếu không xoá session thì mặc dù account đã được xoá 
        //,nhưng thông tin vẫn đc lưu trên sesion
        //và nó vẫn sẽ hiển thị thông tin account cũ,
        session_destroy();

        echo("<script>alert('Đã xoá tài khoảng thành công');</script>");
        echo("<script>window.open('index.php','_self');</script>");
    }
    if(isset($_POST['cancel'])){
        echo("<script>window.open(window.location.href,'_self');</script>");
    }
?>