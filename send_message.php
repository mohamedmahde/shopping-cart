<?php
require('include/connection.inc.php');
require('include/functions.inc.php');
$name=get_safe_value($con,$_POST['name']);
$email=get_safe_value($con,$_POST['email']);
$mobile=get_safe_value($con,$_POST['mobile']);
$comment=get_safe_value($con,$_POST['message']);
$added_on=date('Y-m-d h:i:s');
$query="insert into contact_us(name,email,mobile,comment,added_on) values('$name','$email','$mobile','$comment','$added_on')";
mysqli_query($con,$query);
echo "شكرا تم الرسال الطلب";
?>