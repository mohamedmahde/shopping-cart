<?php
require('include/header.inc.php');
isAdmin();

$categories='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
$id=get_safe_value($con,$_GET['id']);
$query="select * from categories where id='$id'";
$res=mysqli_query($con,$query);
$check=mysqli_num_rows($res);
if($check>0){
$row=mysqli_fetch_assoc($res);
$categories=$row['categories'];
}else{
header('location:categories.php');
die();
}
}
// التحقق من وجود الصنف 
if(isset($_POST['submit'])){
$categories=get_safe_value($con,$_POST['categories']);
$query="select * from categories where categories='$categories'";
$res=mysqli_query($con,$query);
$check=mysqli_num_rows($res);
if($check>0){
if(isset($_GET['id']) && $_GET['id']!=''){
$getData=mysqli_fetch_assoc($res);
if($id==$getData['id']){

}
}else{
	$msg="<script> alert('الصنف موجود بالفعل') </script>";
}
}
// edit page update
if($msg==''){
if(isset($_GET['id']) && $_GET['id']!=''){
	$query="update categories set categories='$categories' where id='$id'";
mysqli_query($con,$query);
}else{
	$query="insert into categories(categories,status) values('$categories','1')";
mysqli_query($con,$query);
}
header('location:categories.php');
die();
}
}
?>
<div class="content pb-0">
<div class="animated fadeIn">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header  text-center"><strong>اضافة الاصناف</strong></div>
<!-- اضافة الاصناف  -->
<form method="post">
<div class="card-body card-block">
<div class="form-group">
<label for="categories" class=" form-control-label text-center">اضافة الاصناف</label>
<input type="text" name="categories" placeholder="ادخل اسم الصنف" class="form-control" required value="<?php echo $categories?>">
</div>
<button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">اضافة</button>

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