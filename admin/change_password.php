<?php
require('include/header.inc.php');

?>

<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
                    <form method="post"  class="form-gruop" id="frmPassword">
                    <div class="single-contact-form">
                    <label class="password_label">كلمة السر الحالية</label>
                    <div class="contact-box name">
                    <input type="password" class="form-control" name="current_password" id="current_password" >
                    </div>
                    <span class="field_error" id="current_password_error"></span>
                    </div>
    
                    <div class="single-contact-form">
                    <label class="password_label">كلمة السر الجديدة</label>
                    <div class="contact-box name">
                    <input type="password" class=" form-control"name="new_password" id="new_password" >
                    </div>
                    <span class="field_error" id="new_password_error"></span>
                    </div>

                    <div class="single-contact-form">
                    <label class="password_label">تاكيد كلمة السر</label>
                    <div class="contact-box name">
                    <input type="password"class=" form-control" name="confirm_new_password" id="confirm_new_password" >
                    </div>
                    <span class="field_error" id="confirm_new_password_error"></span>
                    </div>

                    <div class="contact-btn">
                        <br>
                    <button type="button"  class="btn btn-lg btn-info btn-block"  onclick="update_password()" id="btn_update_password">تحديث</button>

                    </div>
                    </form>
                        

                <script>
                    function update_password(){
                    jQuery('.field_error').html('');
                    var current_password=jQuery('#current_password').val();
                    var new_password=jQuery('#new_password').val();
                    var confirm_new_password=jQuery('#confirm_new_password').val();
                    var is_error='';
                    if(current_password==''){
                    jQuery('#current_password_error').html('الرجاء ادخال كلمة السر');
                    is_error='yes';
                    }if(new_password==''){
                    jQuery('#new_password_error').html('الرجاء ادخال كلمة السر');
                    is_error='yes';
                    }if(confirm_new_password==''){
                    jQuery('#confirm_new_password_error').html('الرجاء ادخال كلمة السر');
                    is_error='yes';
                    }

                    if(new_password!='' && confirm_new_password!='' && new_password!=confirm_new_password){
                    jQuery('#confirm_new_password_error').html('كلمات السر غير متطابقة');
                    is_error='yes';
                    }

                    if(is_error==''){
                    jQuery('#btn_update_password').attr('disabled',true);
                    jQuery.ajax({
                    url:'update_password.php',
                    type:'post',
                    data:'current_password='+current_password+'&new_password='+new_password,
                    success:function(result){
                    jQuery('#current_password_error').html(result);
                    jQuery('#btn_update_password').html('Update');
                    jQuery('#btn_update_password').attr('disabled',false);
                    jQuery('#frmPassword')[0].reset();
                    }
                    })
                    }

                    }
                    </script>



				</div>
			</div>
		  </div>
	   </div>
	</div>
</div>
<?php
require('include/footer.inc.php');
?>