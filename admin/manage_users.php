<?php
require('include/header.inc.php');
isAdmin();


$msg='';
if(isset($_POST['submit'])){

	$name=get_safe_value($con,$_POST['name']);
	$email=get_safe_value($con,$_POST['email']);
	$mobile=get_safe_value($con,$_POST['mobile']);
	$password=get_safe_value($con,md5($_POST['password']));

	$query="select * from users where name='$name'";
	$check_user=mysqli_num_rows(mysqli_query($con,$query));
	$query="select * from users where email='$email'";
	$check_mobile=mysqli_num_rows(mysqli_query($con,$query));
	$query="select * from users where mobile='$mobile'";
	$check_email=mysqli_num_rows(mysqli_query($con,$query));
	if($check_user>0){
		$msg=" الاسم موجود مسبقا";
	}elseif($check_mobile>0){
		$msg= "الايميل موجود مسبقا";
		
	}
	elseif($check_email>0){
     $msg = "الموبايل موجود مسيقا";
	}
	else{
		$added_on=date('Y-m-d h:i:s');
		$query="insert into users(name,email,mobile,password,status,added_on) values('$name','$email','$mobile','$password',1,'$added_on')";
		mysqli_query($con,$query);
		$msg=  "تم اضافة المستخدم";
	// 	header('location:users.php');
	// 	die();
	
}





}
		

?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header  text-center"><strong>ادارة المستخدمين </strong></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   
								
								<div class="form-group">
									<label for="username" class=" form-control-label ">الاسم</label>
									<input type="text" name="name"  placeholder="اسم المستخدم" class="form-control" required>
								</div>
								<div class="form-group">
									<label for="password" class=" form-control-label">كلمة السر</label>
									<input type="password" name="password" placeholder="كلمة السر" class="form-control" >
								</div>
								
								<div class="form-group">
									<label for="password" class=" form-control-label">الايميل</label>
									<input type="email" name="email" placeholder="ادخل الايميل" class="form-control" >
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">الموبايل</label>
									<input type="text" name="mobile" placeholder="الموبايل" class="form-control" required>
								</div>
								
								<div class="field_error"><?php echo $msg?></div>

							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">اضافة</span>
							   </button>
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