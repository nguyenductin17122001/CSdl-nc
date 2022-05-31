<?php 
if(isset($_POST['capnhatdonhang'])){
	$xuly = $_POST['xuly'];
	$mahang = $_POST['mahang_xuly'];
	$sql_update_donhang = mysqli_query($con,"UPDATE orders SET tinhtrang='$xuly' WHERE mahang='$mahang'");
	$sql_update_giaodich = mysqli_query($con,"UPDATE transactions SET tinhtrangdon='$xuly' WHERE magiaodich='$mahang'");
}

?>
<?php
	if(isset($_GET['xoadonhang'])){
		$mahang = $_GET['xoadonhang'];
		$sql_delete = mysqli_query($con,"DELETE FROM orders WHERE mahang='$mahang'");
	} 
	if(isset($_GET['xacnhanhuy'])&& isset($_GET['mahang'])){
		$huydon = $_GET['xacnhanhuy'];
		$magiaodich = $_GET['mahang'];
	}else{
		$huydon = '';
		$magiaodich = '';
	}
	$sql_update_donhang = mysqli_query($con,"UPDATE orders SET huydon='$huydon' WHERE mahang='$magiaodich'");
	$sql_update_giaodich = mysqli_query($con,"UPDATE transactions SET huydon='$huydon' WHERE magiaodich='$magiaodich'");

?>

	<div class="order-box">
		<div class="row">
			 <?php
			if(isset($_GET['quanly'])=='xemdonhang'){
				$mahang = $_GET['mahang'];
				$sql_chitiet = mysqli_query($con,"SELECT * FROM orders,products WHERE orders.product_id=products.product_id AND orders.mahang='$mahang'");
				?>
				<div class="col">
				 <h2>View <strong> order details</strong></h2>
			<form action="" method="POST">
				<table class="content-table ">
					 <thead>
					<tr>
						<th>STT</th>
						<th>Mã hàng</th>
						<th>Tên sản phẩm</th>
						<th>Ảnh</th>
            <th>Giá</th> 
						<th>Số lượng</th>
						<th>Tổng tiền</th>
						<th>Ngày đặt</th>

						
						<!-- <th>Quản lý</th> -->
					</tr>
			</thead>
					<?php
					$i = 0;
					while($row_donhang = mysqli_fetch_array($sql_chitiet)){ 
						$i++;
					?> 
					<tbody>
					<tr class="active-row">
						<td><?php echo $i; ?></td>
						<td><?php echo $row_donhang['mahang']; ?></td>
						<td><?php echo $row_donhang['product_title']; ?></td>
						<td><img src="../admin/public/product_images/<?php echo $row_donhang['product_image']; ?>"  alt=""></td>
						<td><?php echo $row_donhang['product_price'].'$'; ?></td>
						<td><?php echo $row_donhang['quality']; ?></td>
						<td><?php echo number_format($row_donhang['quality']*$row_donhang['product_price']).'$'; ?></td>
						
						<td><?php echo $row_donhang['ngaythang'] ?></td>
						<input type="hidden" name="mahang_xuly" value="<?php echo $row_donhang['mahang'] ?>">

						<!-- <td><a href="?xoa=<?php echo $row_donhang['order_id'] ?>">Xóa</a> || <a href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['mahang'] ?>">Xem đơn hàng</a></td> -->
					</tr>
					</tbody>
					 <?php
					} 
					?> 
				</table>

				<select class="form-control" name="xuly">
					<option value="1">Đã xử lý | Giao hàng</option>
					<option value="0">Chưa xử lý</option>
				</select><br>

				<input type="submit" value="order update" name="capnhatdonhang" class="btn btn-success">
			</form>
				</div>  
			<?php
			}else{
				?> 
				
				<div class="col-one">
				</div>  
				<?php
			} 
			
				?> 
			<div class="col-two">
				 <h2>Order <strong>  Listing</strong></h2>
				<?php
				$sql_select = mysqli_query($con,"SELECT * FROM products,user,orders WHERE orders.product_id=products.product_id AND orders.id=user.id GROUP BY  mahang ORDER BY order_id DESC"); 
				?> 
				<table class=" content-table ">
					<thead>
					<tr>
						<th>STT</th>
						<th>Mã hàng</th>
						<th>Tình trạng </th>
						<th>Tên khách hàng</th>
						<th>Ngày đặt</th>
						<th>phone</th>
            <th>dia chi</th>
						<th>Hủy đơn</th>
						<th>Quản lý</th>
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
						
						<td><?php echo $row_donhang['mahang']; ?></td>
						<td><?php
							if($row_donhang['tinhtrang']==0){
								echo 'Chưa xử lý';
							}else{
								echo 'Đã xử lý';
							}
						?></td>
						<td><?php echo $row_donhang['name']; ?></td>
						
						<td><?php echo $row_donhang['ngaythang'] ?></td>
						<td><?php echo $row_donhang['contact'] ?></td>
            	<td><?php echo $row_donhang['user_address'] ?></td>
						<td><?php if($row_donhang['huydon']==0){ }elseif($row_donhang['huydon']==1){
							echo '<a href="index.php?action=order_processing&mahang='.$row_donhang['mahang'].'&xacnhanhuy=2">Xác nhận hủy đơn</a>';
						}else{
							echo 'Đã hủy';
						} 
						?></td>

						<td><a href="index.php?action=order_processing&xoadonhang=<?php echo $row_donhang['mahang'] ?>">Xóa</a> || <a href="index.php?action=order_processing&quanly=xemdonhang&mahang=<?php echo $row_donhang['mahang'] ?>">Xem </a></td>
					</tr>
					</tbody>
					 <?php
					} 
					?> 
				</table>
			</div>
		</div>
	</div>