<?php
require('include/header.inc.php');

     if(isset($_GET['type']) && $_GET['type']!=''){
        $type=get_safe_value($con,$_GET['type']);
        if($type=='status'){
        $operation=get_safe_value($con,$_GET['operation']);
        $id=get_safe_value($con,$_GET['id']);
        if($operation=='active'){
        $status='1';
        }else{  
        $status='0';
     } 
        $update_status_sql="update product set status='$status' where id='$id'";
        mysqli_query($con,$update_status_sql);
     }

       
    if($type=='delete'){
        $id=get_safe_value($con,$_GET['id']);
        $delete_sql="delete from product where id='$id'";
        mysqli_query($con,$delete_sql);
     }
     }
    // ربط جدول التصنيفات مع جدول المنتجات 
    $query="select product.*,categories.categories from product,categories where product.categories_id=categories.id order by product.id ASC";
    $res=mysqli_query($con,$query);
    ?>

<div class="content pb-0">
<div class="orders">
<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card-body text-center">
<h4 class="box-title ">المنتجات </h4>
<h4 class="box-link"><a href="manage_product.php">اضافة منتج</a> </h4>
</div>
<div class="card-body--">
<!-- start table product -->
<div class="table-stats order-table ov-h">
<table class="table ">
<thead>
<tr>
<th class="serial">الترتيب</th>
<th >ID</th>
<th >التصنيفات</th>
<th>الاسم</th>
<th>الصورة</th>
<th >سعر الشحن</th>
<th >السعر</th>
<th >الكمية</th>
<th >التحكم</th>
</tr>
</thead>
<tbody>
<?php 
$i=1;
while($row=mysqli_fetch_assoc($res)){?>
<tr>
<td class="serial"><?php echo $i++?></td>
<td><?php echo $row['id']?></td>
<td><?php echo $row['categories']?></td>
<td><?php echo $row['name']?></td>
<td><img src="<?php echo '../media/product/'.$row['image']?>"/></td>
<td><?php echo $row['shipping_price']?></td>
<td><?php echo $row['price']?></td>
<td><?php echo $row['qty']?><br/>
<?php
$productSoldQtyByProductId=productSoldQtyByProductId($con,$row['id']);
$pneding_qty=$row['qty']-$productSoldQtyByProductId;

?>
<!-- Pending Qty  -->
<?php echo $pneding_qty?>

</td>
<td>
<?php
if($row['status']==1){
echo "<span class='badge badge-complete'>  <i class='fa fa-check'></i>  <a href='?type=status&operation=deactive&id=".$row['id']."'>active</a> </span>&nbsp;";
}else{
echo "<span class='badge badge-pending'> <i class='fa fa-close'></i> <a href='?type=status&operation=active&id=".$row['id']."'> deactive</a> </span>&nbsp;";
}
echo "<span class='badge badge-edit'>  <i class='fa fa-edit'></i>  <a href='manage_categories.php?id=".$row['id']."'>Edit</a> </span>&nbsp;";

echo "<span class='badge badge-delete confirm'> <i class='fa fa-close'></i>  <a href='?type=delete&id=".$row['id']."'>Delete</a> </span>";

?>
</td>
</tr>
<?php } ?>
</tbody>
</table>
   <!-- end table product -->
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