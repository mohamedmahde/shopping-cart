<?php
require('include/header.inc.php');

$sql="select * from users order by id desc";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
<div class="orders">
<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card-body">
<h4 class="box-title">الطلبات</h4>
</div>
<div class="card-body--">
<div class="table-stats order-table ov-h">
<table class="table">
<thead>
<tr>
<th >Order ID</th>
<th ><span class="nobr">تاريخ الطلب</span></th>
<th ><span class="nobr"> العنوان </span></th>
<th ><span class="nobr"> اسم البائع </span></th>
<th><span class="nobr"> نوع الدفع </span></th>
<th ><span class="nobr"> حالة الدفع </span></th>
<th ><span class="nobr"> حالة الطلب</span></th>
</tr>
</thead>
<tbody>


<?php
$query="select `order`.*,order_status.name as order_status_str,users.name from `order`,order_status ,users where order_status.id=`order`.order_status";
$res=mysqli_query($con,$query);
while($row=mysqli_fetch_assoc($res)){
?>
<tr>
<td class="product-add-to-cart"><a href="order_master_detail.php?id=<?php echo $row['id']?>"> <?php echo $row['id']."-تفاصيل الطلب"?></a><br/><br/>
<a href="../order_pdf.php?id=<?php echo $row['id']?>"><i class="fa fa-print"></i> طباعة</a> </td>
<td ><?php echo $row['added_on']?></td>
<td >
<?php echo $row['address']."العنوان"?><br/>

<?php echo $row['Housing_area']."اسم الحي"?><br/>

<?php echo $row['home_no']. "رقم المنزل"?>
</td>
<td ><?php echo $row['name']?></td>

<td ><?php echo $row['payment_type']?></td>
<td ><?php echo $row['payment_status']?></td>
<td ><?php echo $row['order_status_str']?></td>

</tr>
<?php } ?>
</tbody>

</table>
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