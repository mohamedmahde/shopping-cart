<?php
require('include/header.inc.php');
isAdmin();

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
$update_status_query="update categories set status='$status' where id='$id'";
mysqli_query($con,$update_status_query);
}

if($type=='delete'){
$id=get_safe_value($con,$_GET['id']);
$delete_query="delete from categories where id='$id'";
mysqli_query($con,$delete_query);
}
}

$query="select * from categories order by categories desc";
$res=mysqli_query($con, $query);
?>

<div class="content">
<!--  clss pb-0 -->
<div class="orders">
<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card-body">
<h4 class="box-title  text-center">التصنيفات </h4>
<h4 class="box-link  text-center"><a href="manage_categories.php">اضافة صنف</a> </h4>
</div>
<div class="card-body--">
<div class="table-stats order-table ov-h">
    <!-- stsrt cat table -->
<table class="table ">
<thead>
<tr>
<th class="serial">الترتيب</th>
<th>ID</th>
<th>التصنيفات</th>
<th></th>
</tr>
</thead>
<tbody>

<?php 
$i=1;
while($row=mysqli_fetch_assoc($res)){
    ?>
<tr>
<td class="serial"><?php echo  $i++;?></td>
<td><?php echo $row['id']?></td>
<td><?php echo $row['categories']?></td>
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
    <!-- end cat table -->

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