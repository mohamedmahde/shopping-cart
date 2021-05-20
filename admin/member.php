<?php
require('include/header.inc.php');
isAdmin();
// get request
if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($con,$_GET['operation']);
		$id=get_safe_value($con,$_GET['id']);
		
		// active page
		if($operation=='active'){
		$status='1';
		}else{
		$status='0';
		}
		$update_status_query="update admin_users set status='$status' where id='$id'";
		mysqli_query($con,$update_status_query);
		}
	// delete page
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$query="delete from admin_users where id='$id'";
		mysqli_query($con,$query);
	}
}

$sql="select * from admin_users where role=1 order by id DESC";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title text-center">ادارة المشرفين </h4>
				   <h4 class="box-link  text-center" ><a href="manage_member.php">اضافة مشرف</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">

					  <table class="table ">
						 <thead>
							<tr>
							   <th >#</th>
							   <th >ID</th>
							   <th >الاسم</th>
							   <th >كلمة السر</th>
							   <th >الايميل</th>
							   <th >الموبايل</th>
							   <th > التحكم</th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td class="serial"><?php echo $i++?></td>
							   <td><?php echo $row['id']?></td>
							   <td><?php echo $row['username']?></td>
							   <td><?php echo $row['password']?></td>
							   <td><?php echo $row['email']?></td>
							   <td><?php echo $row['mobile']?></td>
							  
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