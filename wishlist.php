        <?php 
        require('include/header.inc.php');
        if(!isset($_SESSION['USER_LOGIN'])){
        ?>
        <script>
        window.location.href='index.php';
        </script>
        <?php
        }
        $uid=$_SESSION['USER_ID'];

        $res=mysqli_query($con,"select product.name,product.image,product.price,product.mrp,product.id as pid,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid'");
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
        <span class="breadcrumb-item active">قائمة المفضلة</span>
        </nav>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area ptb--100 bg__white">
        <div class="container">
        <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
        <form action="#">               
        <div class="table-content table-responsive">
        <table>
        <thead>
        <tr>
        <th class="product-thumbnail">المنتجات</th>
        <th class="product-name">اسم المنتج</th>
        <th class="product-name">مسح</th>
        <th class="product-name"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        while($row=mysqli_fetch_assoc($res)){
        ?>
        <tr>
        <td class="product-thumbnail"><a href="#"><img src="<?php echo 'media/product/'.$row['image']?>"  /></a></td>
        <td class="product-name"><a href="#"><?php echo $row['name']?></a>
        <ul  class="pro__prize">
        <li class="old__prize"><?php echo $row['mrp']?></li>
        <li><?php echo $row['price']?></li>
        </ul>
        </td>

        <td class="product-remove"><a href="wishlist.php?wishlist_id=<?php echo $row['id']?>"><i class="icon-trash icons"></i></a></td>
        <td class="product-remove"><a href="javascript:void(0)" onclick="manage_cart('<?php echo $row['pid']?>','add')">اضافة للسلة</a></td>
        </tr>
        <?php } ?>
        </tbody>
        </table>
        </div>
        <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="buttons-cart--inner">
        <div class="buttons-cart">
        <a href="index.php">مواصلة التسوق</a>
        </div>
        <div class="buttons-cart checkout--btn">
        <a href="checkout.php">عمليات الدفع</a>
        </div>
        </div>
        </div>
        </div>
        </form> 
        </div>
        </div>
        </div>
        </div>

        <input type="hidden" id="qty" value="1"/>						
        <?php require('include/footer.inc.php')?>        