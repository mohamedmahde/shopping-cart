<?php
require('include/header.inc.php');
		$categories='';
		$msg='';
		$sub_categories='';
		if(isset($_GET['id']) && $_GET['id']!=''){
			
				$id=get_safe_value($con,$_GET['id']);
				$query="select * from sub_categories where id='$id'";
				$res=mysqli_query($con,$query);
				$check=mysqli_num_rows($res);
				if($check>0){
				$row=mysqli_fetch_assoc($res);
				$sub_categories=$row['sub_categories'];
				$categories=$row['categories_id'];
				}else{
				header('location:sub_categories.php');
				die();
				}
		}

		if(isset($_POST['submit'])){
				$categories=get_safe_value($con,$_POST['categories_id']);
				$sub_categories=get_safe_value($con,$_POST['sub_categories']);
				$query="select * from sub_categories where categories_id='$categories' and sub_categories='$sub_categories'";
				$res=mysqli_query($con,$query);
				$check=mysqli_num_rows($res);
				if($check>0){
				if(isset($_GET['id']) && $_GET['id']!=''){
				$getData=mysqli_fetch_assoc($res);
				if($id==$getData['id']){

				}
				}else{
					$msg="<script> alert('الصنف  الفرعي موجود بالفعل') </script>";
				}
		}  

if($msg==''){
if(isset($_GET['id']) && $_GET['id']!=''){
$query="update sub_categories set categories_id='$categories',sub_categories='$sub_categories' where id='$id'";
mysqli_query($con,$query);
}else{
$query="insert into sub_categories(categories_id,sub_categories,status) values('$categories','$sub_categories','1')";
mysqli_query($con,$query);
}
header('location:sub_categories.php');
die();
}
}
?>


<div class="content pb-0">
<div class="animated fadeIn">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header  text-center"><strong>الاصناف الفرعية</strong></div>
<!-- فورم اضافة صنف فرعي -->
<form method="post">
<div class="card-body card-block">
<div class="form-group">
<label for="categories" class=" form-control-label">الاصناف</label>
	<select name="categories_id" required class="form-control">
	<option value="">اختيار صنف</option>
	<?php
	$query="select * from categories where status='1'";
	$res=mysqli_query($con,$query);
	while($row=mysqli_fetch_assoc($res)){
	if($row['id']==$categories){
	echo "<option value=".$row['id']." selected>".$row['categories']."</option>";
	}else{
	echo "<option value=".$row['id'].">".$row['categories']."</option>";
	}
	}
	?>
	</select>
</div>
<div class="form-group">
<label for="categories" class=" form-control-label">الاصناف الفرعية</label>
<input type="text" name="sub_categories" placeholder="اضافة سنف فرعي" class="form-control" required value="<?php echo $sub_categories?>">
</div>
<button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-danger btn-block">
<span id="payment-button-amount">اضافة</span>
</button>
<?php echo $msg?>
</div>
</form>

</div>
</div>
</div>
</div>
</div>

<?php
require('include/footer.inc.php');
?>