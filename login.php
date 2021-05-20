<?php 
require('include/header.inc.php');
if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']=='yes'){
?>
<script>
window.location.href='my_order.php';
</script>
<?php
}
?>
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
<div class="ht__bradcaump__wrap">
<div class="container">
<div class="row">
<div class="col-xs-12">
<div class="bradcaump__inner">
<nav class="bradcaump-inner">
<a class="breadcrumb-item" href="index.php">الرئيسية</a>
<span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
<span class="breadcrumb-item active">تسجيل</span>
</nav>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- End Bradcaump area -->

<!-- Start Contact Area -->
<section class="htc__contact__area ptb--100 bg__white" >
<div class="container">
<div class="row">
<div class="col-md-6">
<div class="contact-form-wrap mt--60">
<div class="col-xs-12">
<div class="contact-title">
<h2 class="title__line--6">تسجيل دخول</h2>
</div>
</div>
    <!-- form user login -->

<div class="col-xs-12">
<form id="login-form" method="post">
<div class="single-contact-form">
<div class="contact-box name">
<input type="text" name="login_email" id="login_email" placeholder="الايميل*" style="width:100%">
</div>
<span class="field_error" id="login_email_error"></span>
</div>

<div class="single-contact-form">
<div class="contact-box name">
<input type="password" name="login_password" id="login_password" placeholder="كلمة السر*" style="width:100%">
</div>
<span class="field_error" id="login_password_error"></span>
</div>

<div class="contact-btn">
<button type="button" class="fv-btn" onclick="user_login()">تسجيل دخول</button>
<a href="forgot_password.php" class="forgot_password">نسيت كلمة السر</a>
</div>
</form>
<div class="form-output login_msg">
<p class="form-messege field_error"></p>
</div>
</div>
    <!-- end user login -->

</div> 

</div>

<!-- start user regester -->
<div class="col-md-6"  >
<div class="contact-form-wrap mt--60">
<div class="col-xs-12">
<div class="contact-title">
<h2 class="title__line--6">تسجيل  </h2>
</div>
</div>
<div class="col-xs-12">
<form id="register-form" method="post">
<div class="single-contact-form">
<div class="contact-box name">
<input type="text" name="name" id="name" placeholder="الاسم*" style="width:100%">
</div>
<span class="field_error" id="name_error"></span>
</div>

<div class="single-contact-form">
<div class="contact-box name">
<input type="text" name="email" id="email" placeholder="الايميل*" style="width:45%">
<button type="button" class="fv-btn email_sent_otp height_60px" onclick="email_sent_otp()">Send OTP</button>
<input type="text" id="email_otp" placeholder="OTP" style="width:45%" class="email_verify_otp">
<button type="button" class="fv-btn email_verify_otp height_60px" onclick="email_verify_otp()">Verify OTP</button>
<span id="email_otp_result"></span>
</div>
<span class="field_error" id="email_error"></span>
</div>


<div class="single-contact-form">
<div class="contact-box name">
<input type="text" name="mobile" id="mobile" placeholder="الموبايل*" style="width:45%">
<button type="button" class="fv-btn mobile_sent_otp height_60px" onclick="mobile_sent_otp()">Send OTP</button>
<input type="text" id="mobile_otp" placeholder="OTP" style="width:45%" class="mobile_verify_otp">
<button type="button" class="fv-btn mobile_verify_otp height_60px" onclick="mobile_verify_otp()">Verify OTP</button>
<span id="mobile_otp_result"></span>
</div>
<span class="field_error" id="mobile_error"></span>
</div>


<div class="single-contact-form">
<div class="contact-box name">
<input type="password" name="password" id="password" placeholder="كلمة السر*" style="width:100%">
</div>
<span class="field_error" id="password_error"></span>
</div>

<div class="contact-btn">
<button type="button" class="fv-btn" onclick="user_register()" disabled id="btn_register">تسجيل</button>
</div>
</form>

<div class="form-output register_msg">
<p class="form-messege field_error"></p>

</div>
</div>
</div> 
</div>
</div>
</section>
<input type="hidden" id="is_email_verified"/>
<input type="hidden" id="is_mobile_verified"/>
<!-- end user regester -->

<script>
function email_sent_otp(){
            jQuery('#email_error').html('');
var email=jQuery('#email').val();
if(email==''){
            jQuery('#email_error').html('الرجاء ادخال الايميل');
}else{
            jQuery('.email_sent_otp').html('الرجاء الانتظار..');
            jQuery('.email_sent_otp').attr('disabled',true);
jQuery.ajax({
url:'send_otp.php',
type:'post',
data:'email='+email+'&type=email',
success:function(result){
if(result=='done'){
            jQuery('#email').attr('disabled',true);
            jQuery('.email_verify_otp').show();
            jQuery('.email_sent_otp').hide();

}else if(result=='email_present'){
jQuery('.email_sent_otp').html('Send OTP');
jQuery('.email_sent_otp').attr('disabled',false);
jQuery('#email_error').html('الايميل موجود');
}else{
            jQuery('.email_sent_otp').html('Send OTP');
            jQuery('.email_sent_otp').attr('disabled',false);
            jQuery('#email_error').html('الرجاء المحاولة مرة اخري');
}
}
});
}
}


function email_verify_otp(){
jQuery('#email_error').html('');
var email_otp=jQuery('#email_otp').val();
if(email_otp==''){
            jQuery('#email_error').html('الرجاء ادخال رقم التحقق');
}else{
jQuery.ajax({
url:'check_otp.php',
type:'post',
data:'otp='+email_otp+'&type=email',
success:function(result){
if(result=='done'){
            jQuery('.email_verify_otp').hide();
            jQuery('#email_otp_result').html('Email id verified');
            jQuery('#is_email_verified').val('1');
if(jQuery('#is_mobile_verified').val()==1){
            jQuery('#btn_register').attr('disabled',false);
}
}else{
            jQuery('#email_error').html('الرجاء ادخال رقم التحقق الصحيح');
}
}

});
}
}

function mobile_sent_otp(){
jQuery('#mobile_error').html('');
var mobile=jQuery('#mobile').val();
if(mobile==''){
jQuery('#mobile_error').html('الرجاء ادخال رقم الموبايل');
}else{
            jQuery('.mobile_sent_otp').html('الرجاء الانتظار..');
            jQuery('.mobile_sent_otp').attr('disabled',true);
            jQuery('.mobile_sent_otp');
jQuery.ajax({
url:'send_otp.php',
type:'post',
data:'mobile='+mobile+'&type=mobile',
success:function(result){
if(result=='done'){
            jQuery('#mobile').attr('disabled',true);
            jQuery('.mobile_verify_otp').show();
            jQuery('.mobile_sent_otp').hide();
}else if(result=='mobile_present'){
            jQuery('.mobile_sent_otp').html('Send OTP');
            jQuery('.mobile_sent_otp').attr('disabled',false);
            jQuery('#mobile_error').html('رقم الموبايل موجود');
}else{
            jQuery('.mobile_sent_otp').html('Send OTP');
            jQuery('.mobile_sent_otp').attr('disabled',false);
            jQuery('#mobile_error').html('الرجاء المحالولة مرة اخري');
}
}
});
}
}
function mobile_verify_otp(){
            jQuery('#mobile_error').html('');
var mobile_otp=jQuery('#mobile_otp').val();
if(mobile_otp==''){
            jQuery('#mobile_error').html('Please enter OTP');
}else{
jQuery.ajax({
url:'check_otp.php',
type:'post',
data:'otp='+mobile_otp+'&type=mobile',
success:function(result){
if(result=='done'){
            jQuery('.mobile_verify_otp').hide();
            jQuery('#mobile_otp_result').html('تم التحقق من رقم الموبايل');
            jQuery('#is_mobile_verified').val('1');
if(jQuery('#is_email_verified').val()==1){
jQuery('#btn_register').attr('disabled',false);
}
}else{
            jQuery('#mobile_error').html('Please enter valid OTP');
}
}

});
}
}
</script>
<?php require('include/footer.inc.php')?>        