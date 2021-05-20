<?php

// use Mpdf\Tag\Div;

require('include/connection.inc.php');
require('include/functions.inc.php');


$current_password=get_safe_value($con,md5($_POST['current_password']));
$new_password=get_safe_value($con,md5($_POST['new_password']));
$admin_id=$_SESSION['ADMIN_ID'];

$row=mysqli_fetch_assoc(mysqli_query($con,"select password from admin_users where id='$admin_id' and role = 0" ));


if($row['password']!=$current_password){
	echo"كلمة السر غير صحيحة";
}

else{
	
	mysqli_query($con,"update admin_users set password='$new_password' where id='$admin_id'");
echo "تم تغير كلمة السر";
}

?>