<?php
require('include/header.inc.php');
isAdmin();
$username='';
$password='';
$email='';
$mobile='';

$msg='';

if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from admin_users where id='$id' ");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$username=$row['username'];
		$password=$row['password'];
		$email=$row['email'];
		$mobile=$row['mobile'];
	}else{
		header('location:member.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$username=get_safe_value($con,$_POST['username']);
	$password=get_safe_value($con,md5($_POST['password']));
	$email=get_safe_value($con,$_POST['email']);
	$mobile=get_safe_value($con,$_POST['mobile']);
	$query="select * from admin_users where username='$username' ";
	$res=mysqli_query($con,$query);
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$row=mysqli_fetch_assoc($res);
			if($id==$row['id']){
			
			}
		}else{
			$msg="<script> alert(' موجود مسبقا') </script>";

		}
	}
	
	// edite page update
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){

			$update_sql="update admin_users set username='$username',password='$password',email='$email',mobile='$mobile' where id='$id'";
			mysqli_query($con,$update_sql);
		}else{
			// insert page
			$query="insert into admin_users(username,password,email,mobile,role,status) values('$username','$password','$email','$mobile',1,1)";
			mysqli_query($con,$query);
		}
		header('location:member.php');
		die();
	}
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header text-center"><strong>ااضافة المشرفين</strong></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   
								
								<div class="form-group">
									<label for="username" class=" form-control-label">الاسم</label>
									<input type="text" name="username" placeholder="اسم المشرف" class="form-control" required value="<?php echo $username?>">
								</div>
								<div class="form-group">
									<label for="password" class=" form-control-label">كلمة السر</label>
									<input type="password" name="password" placeholder="كلمة السر" class="form-control" required value="<?php echo $password?>">
								</div>
								
								<div class="form-group">
									<label for="password" class=" form-control-label">الايميل</label>
									<input type="email" name="email" placeholder="ادخل الايميل" class="form-control" required value="<?php echo $email?>">
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">الموبايل</label>
									<input type="text" name="mobile" placeholder="الموبايل" class="form-control" required value="<?php echo $mobile?>">
								</div>
								
								
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
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