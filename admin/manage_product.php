<?php
require('include/header.inc.php');
$categories_id='';
$name='';
$shipping_price='';
$price='';
$qty='';
$image='';
$short_desc	='';
$description	='';
$meta_title	='';
$meta_desc	='';
$meta_keyword='';
$best_seller='';
$sub_categories_id='';

$msg='';
$image_required='required';
      if(isset($_GET['id']) && $_GET['id']!=''){
            $image_required='';
            $id=get_safe_value($con,$_GET['id']);
            $res=mysqli_query($con,"select * from product where id='$id'");
            $check=mysqli_num_rows($res);
            if($check>0){
            $row=mysqli_fetch_assoc($res);
            $categories_id=$row['categories_id'];
            $sub_categories_id=$row['sub_categories_id'];
            $name=$row['name'];
            $shipping_price=$row['shipping_price'];
            $price=$row['price'];
            $qty=$row['qty'];
            $short_desc=$row['short_desc'];
            $description=$row['description'];
            $meta_title=$row['meta_title'];
            $meta_desc=$row['meta_desc'];
            $meta_keyword=$row['meta_keyword'];
            $best_seller=$row['best_seller'];
     }else{
        header('location:product.php');
        die();
     }
  }

        
if(isset($_POST['submit'])){
        $categories_id=get_safe_value($con,$_POST['categories_id']);
        $sub_categories_id=get_safe_value($con,$_POST['sub_categories_id']);
        $name=get_safe_value($con,$_POST['name']);
        $shipping_price=get_safe_value($con,$_POST['shipping_price']);
        $price=get_safe_value($con,$_POST['price']);
        $qty=get_safe_value($con,$_POST['qty']);
        $short_desc=get_safe_value($con,$_POST['short_desc']);
        $description=get_safe_value($con,$_POST['description']);
        $meta_title=get_safe_value($con,$_POST['meta_title']);
        $meta_desc=get_safe_value($con,$_POST['meta_desc']);
        $meta_keyword=get_safe_value($con,$_POST['meta_keyword']);
        $best_seller=get_safe_value($con,$_POST['best_seller']);
        $query="select * from product where name='$name'";
        $res=mysqli_query($con,$query);
        $check=mysqli_num_rows($res);
 if($check>0){
if(isset($_GET['id']) && $_GET['id']!=''){
        $getData=mysqli_fetch_assoc($res);
if($id==$getData['id']){

        }
 }else{
        $msg="هذا المنتج موجود";
 }
}
// start add image
if(isset($_GET['id']) && $_GET['id']==0){
if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
        $msg="الرجاء اضافة  تنسيق png,jpg and jpeg فقط للصور";
      }
     }else{
     if($_FILES['image']['type']!=''){
     if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
        $msg="الرجاء اختيار تنسيق  من png,jpg and jpeg  ";
   }
  }
 }
     if($msg==''){
     if(isset($_GET['id']) && $_GET['id']!=''){
if($_FILES['image']['name']!=''){
        $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],'../media/product/'.$image);
        $update_sql="update product set categories_id='$categories_id',name='$name',shipping_price=' $shipping_price',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',image='$image',best_seller='$best_seller',sub_categories_id='$sub_categories_id' where id='$id'";
  }else{
        $update_sql="update product set categories_id='$categories_id',name='$name',shipping_price='$shipping_price',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword',best_seller='$best_seller',sub_categories_id='$sub_categories_id' where id='$id'";
     }
        mysqli_query($con,$update_sql);
 }else{
        $image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],'../media/product/'.$image);
        $query="insert into product(categories_id,name,shipping_price,price,qty,short_desc,description,meta_title,meta_desc,meta_keyword,status,image,best_seller,sub_categories_id) values('$categories_id','$name','$shipping_price','$price','$qty','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword',1,'$image','$best_seller','$sub_categories_id')";
        mysqli_query($con,$query);
}
        header('location:product.php');
        die();
}

}
?>
    <div class="content pb-0">
    <div class="animated fadeIn">
    <div class="row">
    <div class="col-lg-12">
    <div class="card">
    <div class="card-header text-center"><strong> اضافة المنتجات </strong></div>

    <form method="post" enctype="multipart/form-data">
    <div class="card-body card-block">
    <div class="form-group">

    <label for="categories" class=" form-control-label">الاصناف</label>
    <select class="form-control" name="categories_id" id="categories_id" onchange="get_sub_cat('')" required>
    <option>تحديد صنف</option>
        <?php
        $query="select id,categories from categories order by categories asc";
            $res=mysqli_query($con,$query);
     while($row=mysqli_fetch_assoc($res)){

     if($row['id']==$categories_id){
            echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
     }else{
            echo "<option value=".$row['id'].">".$row['categories']."</option>";
     }

     }
        ?>
    </select>
    </div>

    <div class="form-group">
    <label for="categories" class=" form-control-label">صنف فرعي</label>
    <select class="form-control" name="sub_categories_id" id="sub_categories_id">
    <option>تحديد صنف فرعي</option>
    </select>
    </div>

    <div class="form-group">
    <label for="categories" class=" form-control-label">اسم المنتج</label>
    <input type="text" name="name" placeholder="ادخل اسم المنتج" class="form-control" required value="<?php echo $name?>">
    </div>

    <div class="form-group">
    <label for="categories" class=" form-control-label">افضل المبيعات</label>
    <select class="form-control" name="best_seller" required>
    <option value=''>تحديد</option>
    <?php
    if($best_seller==1){
    echo '<option value="1" selected>Yes</option>
    <option value="0">No</option>';
    }elseif($best_seller==0){
    echo '<option value="1">Yes</option>
    <option value="0" selected>No</option>';
    }else{
    echo '<option value="1">Yes</option>
    <option value="0">No</option>';
    }
    ?>
    </select>
    </div>
<div class="form-group">
<label for="categories" class=" form-control-label">سعر الشحن</label>
<input type="text" name="shipping_price" placeholder="Enter product mrp" class="form-control" required value="<?php echo $shipping_price?>">
</div>

<div class="form-group">
<label for="categories" class=" form-control-label">السعر</label>
<input type="text" name="price" placeholder="ادحل سعر المنتج" class="form-control" required value="<?php echo $price?>">
</div>

<div class="form-group">
<label for="categories" class=" form-control-label">الكمية</label>
<input type="text" name="qty" placeholder="ادخل عدد الكمية" class="form-control" required value="<?php echo $qty?>">
</div>

<div class="form-group">
<label for="categories" class=" form-control-label">الصورة</label>
<input type="file" name="image" class="form-control" <?php echo  $image_required?>>
</div>

<div class="form-group">
<label for="categories" class=" form-control-label">وصف قصير</label>
<textarea name="short_desc" placeholder="ادخل وصف قصير للمنتج" class="form-control" required><?php echo $short_desc?></textarea>
</div>

<div class="form-group">
<label for="categories" class=" form-control-label">الوصف</label>
<textarea name="description" placeholder="ادخل الوصف الكامل" class="form-control" required><?php echo $description?></textarea>
</div>

<div class="form-group">
<label for="categories" class=" form-control-label">Meta Title</label>
<textarea name="meta_title" placeholder="Enter product meta title" class="form-control"><?php echo $meta_title?></textarea>
</div>

<div class="form-group">
<label for="categories" class=" form-control-label">Meta Description</label>
<textarea name="meta_desc" placeholder="Enter product meta description" class="form-control"><?php echo $meta_desc?></textarea>
</div>

<div class="form-group">
<label for="categories" class=" form-control-label">Meta Keyword</label>
<textarea name="meta_keyword" placeholder="Enter product meta keyword" class="form-control"><?php echo $meta_keyword?></textarea>
</div>


<button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
<span id="payment-button-amount">اضافة</span>
</button>
<div class="field_error"><?php echo $msg?></div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>

        <script>
        function get_sub_cat(sub_cat_id){
        var categories_id=jQuery('#categories_id').val();
        jQuery.ajax({
        url:'get_sub_cat.php',
        type:'post',
        data:'categories_id='+categories_id+'&sub_cat_id='+sub_cat_id,
        success:function(result){
        jQuery('#sub_categories_id').html(result);
        }
        });
        }
        </script>

        <?php
        require('include/footer.inc.php');
        ?>
        <script>
        <?php
        if(isset($_GET['id'])){
        ?>
        get_sub_cat('<?php echo $sub_categories_id?>');
        <?php } ?>
        </script>