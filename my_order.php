<?php 
require('include/header.inc.php');
if(!isset($_SESSION['USER_LOGIN'])){
?>
<script>
window.location.href='index.php';
</script>
<?php
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
                <span class="breadcrumb-item active">Thank You</span>
            </nav>
        </div>
    </div>
</div>
</div>
</div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="wishlist-area ptb--100 bg__white">
<div class="container">
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="wishlist-content">
        <form action="#">
            <div class="wishlist-table table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th class="product-thumbnail">تفاصيل الطلب</th>
                            <th class="product-name"><span class="nobr">تاريخ  الطلب</span></th>
                            <th class="product-price"><span class="nobr"> العنوان </span></th>
                            <th class="product-stock-stauts"><span class="nobr"> اسم البائع  </span></th>

                            <th class="product-stock-stauts"><span class="nobr"> نوع الدفع </span></th>
                            <th class="product-stock-stauts"><span class="nobr"> حالة الدفع</span></th>
                            <th class="product-stock-stauts"><span class="nobr"> حالة الطلب</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $uid=$_SESSION['USER_ID'];
                        $query="select `order`.*,order_status.name as order_status_str,users.name from `order`,order_status,users where `order`.user_id='$uid' and order_status.id=`order`.order_status";
                        $res=mysqli_query($con,$query);
                        while($row=mysqli_fetch_assoc($res)){
                        ?>
                        <tr>
                            <td class="product-add-to-cart"><a href="my_order_details.php?id=<?php echo $row['id']?>"> <?php echo $row['id']. "تفاصيل الطلب"?></a>
                            <br/>
                            <a href="order_pdf.php?id=<?php echo $row['id']?>"> <i class="glyphicon glyphicon-print"></i>    استخراج فاتورة</a>
                            </td>
                            <td class="product-name"><?php echo $row['added_on']?></td>
                            <td class="product-name">
                            <?php echo $row['address']?><br/>
                            <?php echo $row['Housing_area']?><br/>
                            <?php echo $row['home_no']?>
                            </td>
                            <td class="product-name"><?php echo $row['name']?></td>

                            <td class="product-name"><?php echo $row['payment_type']?></td>
                            <td class="product-name"><?php echo ucfirst($row['payment_status'])?></td>
                            <td class="product-name"><?php echo $row['order_status_str']?></td>
                            
                        </tr>
                        <?php } ?>
                    </tbody>
                    
                </table>
            </div>  
        </form>
    </div>
</div>
</div>
</div>
</div>

            
<?php require('include/footer.inc.php')?>        