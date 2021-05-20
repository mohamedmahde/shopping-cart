<?php
session_start();
unset($_SESSION['ADMIN_LOGIN']);
unset($_SESSION['ADMIN_USERNAME']);
unset($_SESSION['ADMIN_ID']);
unset( $_SESSION['ADMIN_ROLE']);

header('location:login.php');
die();
?>