      <?php
      require('include/connection.inc.php');
      require('include/functions.inc.php');
      $msg='';
      if(isset($_POST['submit'])){
      $username=get_safe_value($con,$_POST['username']);
      $password=get_safe_value($con,md5($_POST['password']));
      $query="select * from admin_users where username='$username' and password='$password' and status='1'";
      $res=mysqli_query($con, $query);
      $count=mysqli_num_rows($res);
      if($count>0){

      $row=mysqli_fetch_assoc($res);
      $_SESSION['ADMIN_LOGIN']='yes';
      $_SESSION['ADMIN_ID']=$row['id'];
      $_SESSION['ADMIN_USERNAME']=$username;
      $_SESSION['ADMIN_ROLE']=$row['role'];
      
      header('location:index.php');
      die();
      
      }else{
      $msg="الرجاء ادخال بيانات الدخول الصحيحة";	
      }

      }
      ?>
      <!doctype html>
      <html class="no-js" lang="ar">
      <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
      <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>تسجيل الدخول</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/normalize.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/bootstrap-rtl.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    
      </head>
      <body class="bg-dark">
      <div class="sufee-login d-flex align-content-center flex-wrap">
      <div class="container">
      <div class="login-content">
      <div class="login-form mt-150">
      <form method="post">
      <div class="form-group">
      <label for="username" >الاسم</label>
      <input type="text" name="username" class="form-control" id="username" placeholder="اسم الادمن" required>
      </div>
      <div class="form-group">
      <label for="Password">كلمة السر</label>
      <input type="password" name="password" class="form-control"  id="Password"placeholder="كلمة السر" required>
      </div>
      <button type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30">تسجيل الدخول</button>
      </form>
      <?php echo "<div class='alert alert-danger'>".$msg."</div>"?>
      </div>
      </div>
      </div>
      </div>
      <script src="assets/js/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <!-- <script src="assets/js/main.js" type="text/javascript"></script> -->
      </body>
      </html>