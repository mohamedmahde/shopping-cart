<?php
require('connection.inc.php');
require('functions.inc.php');
if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!=''){

}else{
header('location:login.php');
die();
}
?>
<!doctype html>
<html >
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>لوحة التحكم</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<!-- <link rel="stylesheet" href="assets/css/bootstrap-rtl.css"> -->
<link rel="stylesheet" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>


<body>
    <!-- start side bar -->
<aside id="left-panel" class="left-panel">
<nav class="navbar navbar-expand-sm navbar-default">
<div id="main-menu" class="main-menu collapse navbar-collapse">
<ul class="nav navbar-nav">
<li class="menu-title text-center">القائمة</li>
<?php if($_SESSION['ADMIN_ROLE']!=1){?>

<li class="menu-item-has-children dropdown">

<a href="categories.php" > التصنيفات</a>
</li>
<li class="menu-item-has-children dropdown">
<a href="sub_categories.php" > التصنيفات الفرعية</a>
</li>
<li class="menu-item-has-children dropdown">
<a href="member.php" >  ادارة المشرفين </a>
</li>
<li class="menu-item-has-children dropdown">
<a href="users.php" > ادارة المستخدمين</a>
</li><li class="menu-item-has-children dropdown">

<?php } ?>

<li class="menu-item-has-children dropdown">
<a href="product.php" > ادارة المنتجات</a>
</li>
<li class="menu-item-has-children dropdown">
<a href="order_master.php" > ادارة الطلبات</a>
</li>

<li class="menu-item-has-children dropdown">
<a href="contact_us.php" > التواصل مع العملاء</a>
</li>

</ul>
</div>
</nav>
</aside>

<!-- end side bar -->
<div id="right-panel" class="right-panel">
<header id="header" class="header">
<div class="top-left">
<div class="navbar-header">
<a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="Logo"></a>
<a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
</div>
</div>

<div class="top-right">
<div class="header-menu">
<div class="user-area dropdown float-left">
<a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<?php   
echo $_SESSION['ADMIN_USERNAME']   .  "مرحبا";
?> 
</a>

<div class="user-menu dropdown-menu">
<a class="nav-link" href="../index.php" target="_blank"><i class="fa fa-user"></i>  الموقع الرئيسي  </a>
<?php if($_SESSION['ADMIN_ROLE']!=1){?>

<a class="nav-link" href="change_password.php"><i class="fa fa-user"></i>تغير كلمة السر  </a>
<?php } ?>
<a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>تسجيل الخروج</a>
</div>

</div>
</div>
</div>
</header>