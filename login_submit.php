<?php
require('include/connection.inc.php');
require('include/functions.inc.php');

$email=get_safe_value($con,$_POST['email']);
$password=get_safe_value($con,md5($_POST['password']));
$query="select * from users where email='$email' and password='$password' and status= 1  ";
$res=mysqli_query($con,$query);
$check_user=mysqli_num_rows($res);
if($check_user>0){
	$row=mysqli_fetch_assoc($res);
	$_SESSION['USER_LOGIN']='yes';
	$_SESSION['USER_ID']=$row['id'];
	$_SESSION['USER_NAME']=$row['name'];
	
	if(isset($_SESSION['WISHLIST_ID']) && $_SESSION['WISHLIST_ID']!=''){
		wishlist_add($con,$_SESSION['USER_ID'],$_SESSION['WISHLIST_ID']);
		unset($_SESSION['WISHLIST_ID']);
	}
	
	echo "valid";
}else{
	echo "wrong";
}
?>