	<?php
		require('include/header.inc.php');
				$order_id=get_safe_value($con,$_GET['id']);
		if(isset($_POST['update_order_status'])){
				$update_order_status=$_POST['update_order_status'];
				if($update_order_status=='5'){
				mysqli_query($con,"update `order` set order_status='$update_order_status',payment_status='Success' where id='$order_id'");
		}else{
				mysqli_query($con,"update `order` set order_status='$update_order_status' where id='$order_id'");
		}

	}
	?>
	<div class="content pb-0">
	<div class="orders">
	<div class="row">
	<div class="col-xl-12">
	<div class="card">
	<div class="card-body text-center">
	<h4 class="box-title">تفاصيل الطلبات </h4>
	</div>
	<div class="card-body--">

	<div class="table-stats order-table ov-h">
	<table class="table">
	<thead>
	<tr>
	<th >اسم النتج</th>
	<th >صورة المنتج</th>
	<th >الكمية</th>
	<th >السعر</th>
	<th >سعر الشحن</th>
	<th >مجموع السعر</th>
	</tr>
	</thead>
	<tbody>

	<?php
	$query="select distinct(order_detail.id) ,order_detail.* ,product.name,product.image,product.shipping_price,`order`.address,`order`.Housing_area,`order`.home_no from order_detail,product ,`order` where order_detail.order_id='$order_id' and  order_detail.product_id=product.id GROUP by order_detail.id";
	$res=mysqli_query($con,$query);
	$total_price=0;
	$query="select * from `order` where id='$order_id'";
	$userInfo=mysqli_fetch_assoc(mysqli_query($con,$query));

	$address=$userInfo['address'];
	$Housing_area=$userInfo['Housing_area'];
	$home_no=$userInfo['home_no'];

	while($row=mysqli_fetch_assoc($res)){

	$total_price=$total_price+($row['qty']*$row['price']+$row['shipping_price']);
	?>
	<tr>

	<td ><?php echo $row['name']?></td>
	<td > <img src="<?php echo '../media/product/'.$row['image']?>"></td>
	<td ><?php echo $row['qty']?></td>
	<td ><?php echo $row['price']?></td>
	<td ><?php echo $row['shipping_price']?></td>
	<td ><?php echo $row['qty']*$row['price']+$row['shipping_price']?></td>

	</tr>
	<?php } ?>
	<tr>
	<td colspan="3"></td>
	<td > مجموع السعر الكلي</td>
	<td ><?php echo $total_price?></td>

	</tr>
	</tbody>

	</table>
	
	<br>

	<div id="address_details" class="text-center">
	<hr>
	<strong >العنوان</strong>
	<?php echo $address?>, <?php echo 	$Housing_area?>, <?php echo $home_no?><br/><br/>
	<strong>حالة الطلب</strong>
	<?php 
	$query="select order_status.name  from order_status,`order`,users where `order`.id='$order_id' and `order`.order_status=order_status.id";
	$order_status_arr=mysqli_fetch_assoc(mysqli_query($con,$query));
	echo $order_status_arr['name'];
	?>

	<div class="text-center">
	<form method="post">
	<select class="form-control" name="update_order_status" required>
	<option value="">تحديد الحالة</option>
	<?php
	$res=mysqli_query($con,"select * from order_status");
	while($row=mysqli_fetch_assoc($res)){
	if($row['id']==$categories_id){
	echo "<option selected value=".$row['id'].">".$row['name']."</option>";
	}else{
	echo "<option value=".$row['id'].">".$row['name']."</option>";
	}
	}
	?>
	</select>
	<input type="submit" class="btn btn-lg btn-danger btn-block"value="submit" class="form-control"/>
	</form>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	<?php
	require('include/footer.inc.php');
	?>