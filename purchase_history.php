<?php
include ("config/config.php");
?>
<?php
	if(isset($_GET['huydon'])&& isset($_GET['magiaodich'])){
		$huydon = $_GET['huydon'];
		$magiaodich = $_GET['magiaodich'];
	}else{
		$huydon = '';
		$magiaodich = '';
	}
	$sql_update_donhang = mysqli_query($con,"UPDATE orders SET huydon='$huydon' WHERE mahang='$magiaodich'");
	$sql_update_giaodich = mysqli_query($con,"UPDATE transactions SET huydon='$huydon' WHERE magiaodich='$magiaodich'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./public/css/purchase.css?v=<?php echo time();?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Document</title>
</head>
<body>

	<header class="header">

        <a href="index.php" class="logo"><span>view</span> order</a>

        <nav class="navbar">
            <a href="index.php" class="fa-solid fa-rectangle-xmark"></a>
        </nav>

    </header>


    <section class="contact" id="contact">
								
								<?php
								if(isset($_GET['user'])){
									$id_user = $_GET['user'];
								}else{
									$id_user = '';
								}
								$sql_select = mysqli_query($con,"SELECT * FROM transactions WHERE transactions.id='$id_user' GROUP BY transactions.magiaodich  order by transaction_id DESC"); 
								?> 
             <table class=" content-table one">
								<thead>
									<tr>
										<th>Stt</th>
										<th>Code</th>
										<th>Day</th>
										<th>Manager</th>
										<th>Status</th>
										<th>Request</th>
									</tr>
							  </thead>
									<?php
									$i = 0;
									while($row_donhang = mysqli_fetch_array($sql_select)){ 
										$i++;
									?> 
									 <tbody>
									<tr>
										<td><?php echo $i; ?></td>
										
										<td><?php echo $row_donhang['magiaodich']; ?></td>
									
										
										<td><?php echo $row_donhang['ngaythang'] ?></td>
										<td><a class="text-one" href="purchase_history.php?user=<?php echo $row_donhang['id'] ?>&magiaodich=<?php echo $row_donhang['magiaodich'] ?>">Xem chi tiết</a></td>
										<td><?php 
										if($row_donhang['tinhtrangdon']==0){
											echo 'Đã đặt hàng';
										}else{
											echo 'Đã xử lý | Đang giao hàng';
										}
										?></td>
										<td>
											<?php
											if($row_donhang['huydon']==0){ 
											?>
											<a class="text-two" href="purchase_history.php?user=<?php echo $row_donhang['id'] ?>&magiaodich=<?php echo $row_donhang['magiaodich'] ?>&huydon=1">Yêu cầu hủy</a>
											<?php
										}elseif($row_donhang['huydon']==1){											
											?>
											<p>Đang chờ hủy...</p>
											<?php
											}else{
												echo 'Đã hủy';
											}
											?>
										</td>
									</tr>
										</tbody>
									 <?php
									} 
									?> 
								</table>
          
								<?php
								if(isset($_GET['magiaodich'])){
									$magiaodich = $_GET['magiaodich'];
								}else{
									$magiaodich = '';
								}
								$sql_select = mysqli_query($con,"SELECT * FROM transactions,user,products WHERE transactions.product_id=products.product_id AND user.id=transactions.id AND transactions.magiaodich='$magiaodich' ORDER BY transactions.transaction_id DESC"); 
								?> 
								<table class=" content-table two">
									<thead>
									<tr>
										<th>Stt</th>
										<th>Code</th>
										<th>Name Product</th>
										<th>Image</th>
	                  <th>Price</th>
										<th>Quality</th>
										<th>Total</th>
										<th>Day</th>
									</tr>
							  </thead>
									<?php
									$i = 0;
									while($row_donhang = mysqli_fetch_array($sql_select)){ 
										$i++;
									?> 
									 <tbody>
									<tr class="active-row">
										<td><?php echo $i; ?></td>
										
										<td><?php echo $row_donhang['magiaodich']; ?></td>
									
										<td><?php echo $row_donhang['product_title']; ?></td>

                    <td><img src="./admin/public/product_images/<?php echo $row_donhang['product_image']; ?>"  alt="" class="pur_pro"></td>
										<td><?php echo $row_donhang['product_price']; ?>$</td>
											<td><?php echo $row_donhang['quality']; ?></td>
										<td><?php echo number_format($row_donhang['quality']*$row_donhang['product_price']).'$';?></td>
										
										<td><?php echo $row_donhang['ngaythang'] ?></td>
									
										
									</tr>
									<tbody>
									 <?php
									} 
									?> 
								</table>
  </section>
		 <section class="footer">

        <div class="follow">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
        </div>

        <div class="credit">created by <span>NĐT-2K1</span> | all rights reserved</div>

    </section>
   
</body>
</html>