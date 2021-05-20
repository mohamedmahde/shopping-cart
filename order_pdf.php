<?php
include('vendor/autoload.php');
require('include/connection.inc.php');
require('include/functions.inc.php');

if(!$_SESSION['ADMIN_LOGIN']){
	if(!isset($_SESSION['USER_ID'])){
		die();
	}
}

$order_id=get_safe_value($con,$_GET['id']);

$css=file_get_contents('assets/css/bootstrap.min.css');
$css.=file_get_contents('assets/css/style.css');

$html='<div class="wishlist-table table-responsive">
   <table>
      <thead>
         <tr>
            <th class="product-thumbnail">اسم المنتج</th>
            <th class="product-thumbnail">المنتج </th>
			<th class="product-name">الكمية</th>
			<th class="product-price">السعر</th>
			<th class="product-price">سعر الشحن</th>
            <th class="product-price">مجموع السعر</th>
         </tr>
      </thead>
      <tbody>';
		
		if(isset($_SESSION['ADMIN_LOGIN'])){
			$query="select distinct(order_detail.id) ,order_detail.*,product.name,product.image,product.shipping_price from order_detail,product ,`order` where order_detail.order_id='$order_id' and order_detail.product_id=product.id";
			$res=mysqli_query($con,	$query);
		}else{
			$uid=$_SESSION['USER_ID'];
			$query="select distinct(order_detail.id) ,order_detail.*,product.name,product.image,product.shipping_price from order_detail,product ,`order` where order_detail.order_id='$order_id' and `order`.user_id='$uid' and order_detail.product_id=product.id";
			$res=mysqli_query($con,$query);
		}

		$total_price=0;
		if(mysqli_num_rows($res)==0){
			die();
		}
		while($row=mysqli_fetch_assoc($res)){
		$total_price=$total_price+($row['qty']*$row['price']+$row['shipping_price']);
		 $pp=$row['qty']*$row['price']+$row['shipping_price'];
         $html.='<tr>
            <td class="product-name">'.$row['name'].'</td>
            <td class="product-name"> <img src="'.'media/product/'.$row['image'].' "></td>
			<td class="product-name">'.$row['qty'].'</td>
			<td class="product-name">'.$row['price'].'جنية'. '</td>
			<td class="product-name">'.$row['shipping_price']. 'جنية'. '</td>
			<td class="product-name">'.$pp.'</td>

         </tr>';
		 }
		 $html.='<tr>
				<td colspan="3"></td>
				<td class="product-name">Total Price</td>
				<td class="product-name">'.$total_price. 'جنية'.'</td>
				
			</tr>';
		 
      $html.='</tbody>
   </table>
</div>';
$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html,2);
$file=time().'.pdf';
$mpdf->Output($file,'D');
?>
