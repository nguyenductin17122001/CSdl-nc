 <?php
     include('include/header.php');
     ?>
<div class="pay">
    <div class="pay_image">
        <img src="./public/image/check.png">
    </div>
    <div class="pay_noti">
        <h1>Thank you for coming to our shop!</h1>
        <p>Your order has been processed successfully. <br>The product will be delivered in the next 3-5 days to the address you have registered on the system. <br>Have a nice day !!!</p>
    </div>
    <!-- <div class="pay_button">
        <button onclick="window.location.href='index.php'">Return</button>
    </div> -->
</div>
<style>
  .pay{
  width: 100vw;
  height: 700px;
  position: relative;
 background: linear-gradient(#fff 20%, #f9f9f9 20.1%);

}

.pay_image{
  text-align: center;
  margin-top: 120px;
}

.pay_image img{
  width: 370px;
  height: 400px;
}

.pay_noti{
  margin-top: 10px;
  text-align: center;
}

.pay_noti h1{
  font-size: 30px;
  color: green;
  font-weight: 900;

}
.pay_noti p{
  font-size:15px;
   font-weight: 800;
   color: #1577bc;
}
.pay_button{
  margin-top: 20px;
  text-align: center;
}

.pay_button button{
  padding: 10px 40px 10px 40px;
  background: #eb4d4b;
  border: 2px solid transparent;
  border-radius: 7px;
  color: #fff;
}

.pay_button button:hover{
  background: #130f40;
}

</style>
 <?php
     include('include/footer.php');
  ?>