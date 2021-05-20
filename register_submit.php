<?php
require('include/connection.inc.php');
require('include/functions.inc.php');

$name=get_safe_value($con,$_POST['name']);
$email=get_safe_value($con,$_POST['email']);
$mobile=get_safe_value($con,$_POST['mobile']);
$password=get_safe_value($con,$_POST['password']);
$pass = md5($password);
$query="select * from users where email='$email'";
$qyr=mysqli_query($con,$query);
$check_email=mysqli_num_rows($qyr);

$query="select * from users where mobile='$mobile'";
$qyr=mysqli_query($con,$query);

$check_mobile=mysqli_num_rows($qyr);
if($check_email>0){
	echo "email_present";
}elseif($check_mobile>0){
	echo "mobile_present";
}else{
	$added_on=date('Y-m-d h:i:s');
	$query="insert into users(name,email,mobile,password,status,added_on) values('$name','$email','$mobile','$pass',1,'$added_on')";

	mysqli_query($con,	$query);
	echo "insert";
}
?>