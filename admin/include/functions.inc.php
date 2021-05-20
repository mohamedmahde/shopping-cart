<?php



function get_safe_value($con,$str){
	if($str!=''){
		$str=trim($str);
		return strip_tags( mysqli_real_escape_string($con,$str));
		}
}

function productSoldQtyByProductId($con,$pid){
	$sql="select sum(order_detail.qty) as qty from order_detail,`order` where `order`.id=order_detail.order_id and order_detail.product_id=$pid and `order`.order_status!=4";
	$res=mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($res);
	return $row['qty'];
}



function isAdmin(){
	if(!isset($_SESSION['ADMIN_LOGIN'])){
	?>
		<script>
		window.location.href='login.php';
		</script>
		<?php
	}
	if($_SESSION['ADMIN_ROLE']==1){
		?>
		<script>
		window.location.href='prodect.php';
		</script>
		<?php
	}
}
?>


