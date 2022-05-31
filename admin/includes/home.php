 <div class="head-title">
        <div class="left">
          <h1>Dashboard</h1>
          <ul class="breadcrumb">
            <li>
              <a href="#">Dashboard</a>
            </li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
              <a class="active" href="#">Home</a>
            </li>
          </ul>
        </div>
        <a href="#" class="btn-download">
          <i class='bx bxs-cloud-download'></i>
          <span class="text">Download PDF</span>
        </a>
      </div>

      <ul class="box-info">
        <li>
          <i class='bx bxs-calendar-check'></i>
          <span class="text">
            <h3><?php total_items_orders();?></h3>
            <p>New Order</p>
          </span>
        </li>
        <li>
          <i class='bx bxs-group'></i>
          <span class="text">
            <h3><?php total_items_users();?></h3>
            <p>Visitors</p>
          </span>
        </li>
        <li>
          <i class='bx bxs-dollar-circle'></i>
          <span class="text">
            <h3><?php sum_money();?></h3>
            <p>Total Sales</p>
          </span>
        </li>
      </ul>


      <div class="table-data">
        <div class="order">
          <div class="head">
            <h3>Recent Orders</h3>
            <i class='bx bx-search'></i>
            <i class='bx bx-filter'></i>
          </div>
          <div class="order-table">
           <?php
			   	$sql_select_khachhang = mysqli_query($con,"SELECT * FROM user,transactions WHERE user.id=transactions.id GROUP BY transactions.magiaodich ORDER BY transaction_id DESC"); 
				  ?> 
          <table>
            <thead>
              <tr>
                <th>User</th>
                <th>Date Order</th>
                <th>Status</th>
              </tr>
            </thead>
            	<?php
					      $i = 0;
					      while($row_khachhang = mysqli_fetch_array($sql_select_khachhang)){ 
					      $i++;
					    ?> 
            <tbody>
              <tr>
                <td>
                  <?php if ($row_khachhang['image'] != '') { ?>
                      <img src="../public/upload/<?php echo ($row_khachhang['image']) ?>" width="70px" height="50px" alt="">
                  <?php } else { ?>
                      <img src="../public/image/profile-icon.png" width="70px" height="50px" alt="">
                  <?php } ?>
                  <p><?php echo $row_khachhang['name']; ?></p>
                </td>
                <td><?php echo $row_khachhang['ngaythang'] ?></td>
                	<td><a class="status completed" href="index.php?action=home&user=<?php echo $row_khachhang['magiaodich'] ?>">view transaction</a></td>
              </tr>
            </tbody>
             <?php
				    	} 
				    	?> 
          </table>
          </div>
        </div>
        <div class="todo">
          <div class="head">
            <h3>List Order History</h3>
            <i class='bx bx-plus'></i>
            <i class='bx bx-filter'></i>
          </div>
            <?php
				if(isset($_GET['user'])){
					$magiaodich = $_GET['user'];
				}else{
					$magiaodich = '';
				}
				$sql_select = mysqli_query($con,"SELECT * FROM transactions,user,products WHERE transactions.product_id=products.product_id AND user.id=transactions.id AND transactions.magiaodich='$magiaodich' ORDER BY transactions.transaction_id DESC"); 
				?> 
          <table>
           <thead>
              <tr>
                 <th>STT</th>
                <th>Code</th>
                <th>Date Order</th>
                <th>product</th>
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
                <td><?php echo $row_donhang['product_title']; ?></td>
              </tr>
            </tbody>
             <?php
					 } 
				    ?>
          </table>
        </div>
      </div>