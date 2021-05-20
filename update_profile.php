<?php
require('include/connection.inc.php');
require('include/functions.inc.php');
if(!isset($_SESSION['USER_LOGIN'])){
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}
$name=get_safe_value($con,$_POST['name']);
$uid=$_SESSION['USER_ID'];
$query="update users set name='$name' where id='$uid'";
mysqli_query($con,$query);
$_SESSION['USER_NAME']=$name;
echo "تم تغير الاسم";
?>