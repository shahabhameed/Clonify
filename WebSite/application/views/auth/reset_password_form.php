
<?php
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> 80,
	'placeholder' 	=> 'Enter New Password ...',
	'class' => 'form-control',
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> 80,
	'placeholder' 	=> 'Retype New Password ...',
	'class' => 'form-control',
);
?>

    <div class="container">
            <div class="loginHeader"><h2>Reset Password</h2></div>
        <div class="loginContainer">


            <?php echo form_open($this->uri->uri_string(),array('class' => 'form-horizontal', 'id' => 'loginForm', 'role' => 'form')); ?>
                <div class="form-group">
                    <label class="col-lg-12 control-label" for="username">New Password:</label>
                    <div class="col-lg-12">
                        <?php echo form_password($new_password); ?>
                    </div>
                </div><!-- End .form-group  -->

                <div class="form-group">
                    <label class="col-lg-12 control-label" for="username">Confirm New Password:</label>
                    <div class="col-lg-12">
                        <?php echo form_password($confirm_new_password); ?>
                    </div>
                </div><!-- End .form-group  -->
                
                <div class="form-group">
                    <div class="col-lg-12 clearfix form-actions">
                        <button type="submit" class="btn btn-info center" id="reset"><span class="fa fa-sign-in white"></span> Get a new password</button>
                    </div>
                </div><!-- End .form-group  -->
            </form>
        </div>

    </div><!-- End .container -->

     <script type="text/javascript">
        // document ready function
        $(document).ready(function() {
            
            $("input, textarea, select").not('.nostyle').uniform();
             <?php if(isset_flash_data('display')){?>
                    $.pnotify({
                                type: '<?=flash_message_type("display");?>',
                                text: '<?=flash_message("display");?>',
                                opacity: 0.95,
                                history: false,
                                sticker: false
                            });
                            
            <?php }?>       
            validator = $("#loginForm").validate({
             
                rules: {
                    new_password: {
                        required: true,
                        minlength: 6
                    },
                    confirm_new_password: {
                    	equalTo: "#new_password"
                    },  
                }
            });
            <?php if(validation_errors()){?>
                validator.showErrors({
                    <?if(form_error('new_password')){?>
                        "new_password": "<?=form_error('new_password');?>",
                    <?}?>
                    <?if(form_error('confirm_new_password')){?>
                        "confirm_new_password": "<?=form_error('confirm_new_password');?>",
                    <?}?>
         
                });
            <?php }?>
        });
    </script>