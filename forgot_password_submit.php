<?php
require('include/connection.inc.php');
require('include/functions.inc.php');

$email=get_safe_value($con,$_POST['email']);

$query="select * from users where email='$email'";
$res=mysqli_query($con,$query);
$check_user=mysqli_num_rows($res);

if($check_user>0){
	$row=mysqli_fetch_assoc($res);
	$pwd=$row['password'];
	$html="كلمة السر هي <strong>$pwd</strong>";
	include('smtp/PHPMailerAutoload.php');
	$mail=new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host="smtp.gmail.com";
	$mail->Port=587;
	$mail->SMTPSecure="tls";
	$mail->SMTPAuth=true;
	$mail->Username="wadmahdiinfo@gmail.com";
	$mail->Password="PASSWORD";
	$mail->SetFrom("wadmahdiinfo@gmail.com");
	$mail->addAddress($email);
	$mail->IsHTML(true);
	$mail->Subject="Your Password";
	$mail->Body=$html;
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if($mail->send()){
		echo "الرجاء مراجهة الايميل تم ارسال كلمة السر";
	}else{
		//echo "Error occur";
	}
}else{
	echo "هذا الايميل غير صحيح";
	die();
}
?>