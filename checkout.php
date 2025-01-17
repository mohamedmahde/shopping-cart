<?php 
require('include/header.inc.php');
if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){
?>
<script>
window.location.href='index.php';
</script>
<?php
}

$cart_total=0;

if(isset($_POST['submit'])){
$address=get_safe_value($con,$_POST['address']);
$Housing_area=get_safe_value($con,$_POST['Housing_area']);
$pincode=get_safe_value($con,$_POST['home_no']);
$payment_type=get_safe_value($con,$_POST['payment_type']);
$user_id=$_SESSION['USER_ID'];
foreach($_SESSION['cart'] as $key=>$val){
$productArr=get_product($con,'','',$key);
$price=$productArr[0]['price'];
$shipping_price=$productArr[0]['shipping_price'];
$qty=$val['qty'];
$cart_total=$cart_total+($price*$qty);

}
$total_price=$cart_total;
$payment_status='pending';
if($payment_type=='cod'){
$payment_status='success';
}
$order_status='1';
$added_on=date('Y-m-d h:i:s');

$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

$query="insert into `order`(user_id,address,Housing_area,home_no,payment_type,payment_status,order_status,added_on,total_price,txnid) 
values('$user_id','$address','$Housing_area','$home_no','$payment_type','$payment_status','$order_status','$added_on','$total_price','$txnid')";
mysqli_query($con,$query);

$order_id=mysqli_insert_id($con);

foreach($_SESSION['cart'] as $key=>$val){
$productArr=get_product($con,'','',$key);
$price=$productArr[0]['price'];
$qty=$val['qty'];

$query="insert into `order_detail`(order_id,product_id,qty,price) values('$order_id','$key','$qty','$price')";
mysqli_query($con,$query);
}

unset($_SESSION['cart']);

if($payment_type=='payu'){
$MERCHANT_KEY = "gtKFFx"; 
$SALT = "eCwWELxi";
$hash_string = '';
//$PAYU_BASE_URL = "https://secure.payu.in";
$PAYU_BASE_URL = "https://test.payu.in";
$action = '';
$posted = array();
if(!empty($_POST)) {
foreach($_POST as $key => $value) {    
$posted[$key] = $value; 
}
}

$userArr=mysqli_fetch_assoc(mysqli_query($con,"select * from users where id='$user_id'"));

$formError = 0;
$posted['txnid']=$txnid;
$posted['amount']=$total_price;
$posted['firstname']=$userArr['name'];
$posted['email']=$userArr['email'];
$posted['phone']=$userArr['mobile'];
$posted['productinfo']="productinfo";
$posted['key']=$MERCHANT_KEY ;
$hash = '';
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
if(
empty($posted['key'])
|| empty($posted['txnid'])
|| empty($posted['amount'])
|| empty($posted['firstname'])
|| empty($posted['email'])
|| empty($posted['phone'])
|| empty($posted['productinfo'])

) {
$formError = 1;
} else {    
$hashVarsSeq = explode('|', $hashSequence);
foreach($hashVarsSeq as $hash_var) {
$hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
$hash_string .= '|';
}
$hash_string .= $SALT;
$hash = strtolower(hash('sha512', $hash_string));
$action = $PAYU_BASE_URL . '/_payment';
}
} elseif(!empty($posted['hash'])) {
$hash = $posted['hash'];
$action = $PAYU_BASE_URL . '/_payment';
}


$formHtml ='<form method="post" name="payuForm" id="payuForm" action="'.$action.'">
<input type="hidden" name="key" value="'.$MERCHANT_KEY.'" />
<input type="hidden" name="hash" value="'.$hash.'"/>
<input type="hidden" name="txnid" value="'.$posted['txnid'].'" />
<input name="amount" type="hidden" value="'.$posted['amount'].'" />
<input type="hidden" name="firstname" id="firstname" value="'.$posted['firstname'].'" />
<input type="hidden" name="email" id="email" value="'.$posted['email'].'" />
<input type="hidden" name="phone" value="'.$posted['phone'].'" />
<textarea name="productinfo" style="display:none;">'.$posted['productinfo'].'</textarea><
input type="hidden" name="surl" value="'.SITE_PATH.'payment_complete.php" />
<input type="hidden" name="furl" value="'.SITE_PATH.'payment_fail.php"/>
<input type="submit" style="display:none;"/></form>';
echo $formHtml;
echo '<script>document.getElementById("payuForm").submit();</script>';
}else{	

?>
<script>
window.location.href='thank_you.php';
</script>
<?php
}	

}
?>

<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
<div class="ht__bradcaump__wrap">
<div class="container">
<div class="row">
<div class="col-xs-12">
<div class="bradcaump__inner">
<nav class="bradcaump-inner">
<a class="breadcrumb-item" href="index.php">الرئيسية</a>
<span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
<span class="breadcrumb-item active">عمليات الدفع</span>
</nav>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="checkout-wrap ptb--100">
<div class="container">
<div class="row">
<div class="col-md-8">
<div class="checkout__inner">
<div class="accordion-list">
<div class="accordion">

<?php 
$accordion_class='accordion__title';
if(!isset($_SESSION['USER_LOGIN'])){
?>

<div class="accordion__body">
<div class="accordion__body__form">
<div class="row">
<div class="col-md-6">
<div class="checkout-method__login">
<form id="login-form" method="post">
<h2>تسجيل دخول</h2>

<div class="single-input">
<input type="text" name="login_email" id="login_email" placeholder="الايميل*" style="width:100%">
<span class="field_error" id="login_email_error"></span>
</div>

<div class="single-input">
<input type="password" name="login_password" id="login_password" placeholder="كلمة السر*" style="width:100%">
<span class="field_error" id="login_password_error"></span>
</div>

<p class="require"></p>
<div class="dark-btn">
<button type="button" class="fv-btn" onclick="user_login()">دخول</button>
</div>
<div class="form-output login_msg">
<p class="form-messege field_error"></p>
</div>
</form>
</div>
</div>
<div class="col-md-6">

</div>
</div>
</div>
</div>
<?php } ?>
<h2>  عناوين السكن</h2>
<form method="post">
<div class="accordion__body">
<div class="bilinfo">

<div class="row">
<div class="col-md-12">
<div class="single-input">
<input type="text" name="address" placeholder="  العنوان " required>
</div>
</div>
<div class="col-md-6">
<div class="single-input">
<input type="text" name="Housing_area" placeholder="اسم الحي" required>
</div>
</div>
<div class="col-md-6">
<div class="single-input">
<input type="text" name="home_no" placeholder="رقم  المنزل" required>
</div>
</div>

</div>

</div>
</div>
<h2>طرق الدفع</h2>
<div class="accordion__body">
<div class="paymentinfo">
<div class="single-method">
 الدفع عند الاستلام  <input type="radio" name="payment_type" value="COD" required/><br><br>
PayUعن طريق بوابة <input type="radio" name="payment_type" value="payu" required/>
</div>
<div class="single-method">

</div>
</div>
</div>
<input type="submit"  class='btn btn-primary' name="submit"/>
</form>
</div>
</div>
</div>
</div>
<div class="col-md-4">
<div class="order-details">
<h5 class="order-details__title">طلباتي</h5>
<div class="order-details__item">
<?php
$cart_total=0;
foreach($_SESSION['cart'] as $key=>$val){
$productArr=get_product($con,'','',$key);
$pname=$productArr[0]['name'];
$shipping_price=$productArr[0]['shipping_price'];
$price=$productArr[0]['price'];
$image=$productArr[0]['image'];
$qty=$val['qty'];
$cart_total=$cart_total+($price*$qty+$shipping_price);
?>
<div class="single-item">
<div class="single-item__thumb">
<img src="<?php echo 'media/product/'.$image?>"  />
</div>
<div class="single-item__content">
<a href="#"><?php echo ' اسم المنتج    :'.$pname?></a>
<span class="price"><?php echo '  السعر   :'. $price*$qty?></span><br>
<span class="price"><?php echo  ' سعر الشحن   :'. $shipping_price?></span>
</div>
<hr>
<div class="single-item__remove">
<a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')"><i class="icon-trash icons"></i></a>
</div>
</div>
<?php } ?>
</div>
<div class="ordre-details__total">
<h5>مجموع السعر</h5>
<span class="price"><?php echo $cart_total?></span>
</div>
</div>
</div>
</div>
</div>
</div>

<?php require('include/footer.inc.php')?>        