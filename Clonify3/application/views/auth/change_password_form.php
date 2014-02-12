<?php
$old_password = array(
	'name'	=> 'old_password',
	'id'	=> 'old_password',
	'value' => set_value('old_password'),
        'class' => "form-control",
	'placeholder' => 'Enter Old Password ...',
	'size' 	=> 30,
);
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
        'class' => "form-control",
	'placeholder' => 'Enter New Password ...',
	'size'	=> 30,
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
        'class' => "form-control",
	'placeholder' => 'Enter Confirm New Password ...',
	'size' 	=> 30,
);
?>
    <div class="container">
      <div class="loginHeader"><h2>Change Password</h2></div>
        <div class="loginContainer">
          <?php echo form_open($this->uri->uri_string(),array('class' => 'form-horizontal', 'id' => 'changePasswordForm', 'role' => 'form')); ?>
            
            <div class="form-group">
              <label class="col-lg-12 control-label" for="Old Password">Old Password:</label>
              <div class="col-lg-12">
                <?php echo form_password($old_password); ?>
              </div>
            </div>
          
            <div class="form-group">
              <label class="col-lg-12 control-label" for="New Password">New Password:</label>
              <div class="col-lg-12">
                <?php echo form_password($new_password); ?>
              </div>
            </div>
          
            <div class="form-group">
              <label class="col-lg-12 control-label" for="Confirm New Password">Confirm New Password:</label>
              <div class="col-lg-12">
                <?php echo form_password($confirm_new_password); ?>
              </div>
            </div>          
            <div class="form-group">
              <div class="col-lg-12 clearfix form-actions">
                <a href="<?php echo site_url('auth/login');?>" class="btn btn-danger center" style="margin-bottom:10px;"> <span class="fa fa-times white"> Cancel</a>
                <button type="submit" class="btn btn-info center" id="loginBtn"><span class="fa fa-sign-in white"></span> Change Password</button>                
               </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>


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
            validator = $("#changePasswordForm").validate({
             
                rules: {                    
                    old_password: {
                        required: true,
                        minlength: 6
                    },
                    new_password: {
                        required: true,
                        minlength: 6
                    },
                    confirm_new_password: {
                        required: true,
                        minlength: 6
                    }
                },
                messages: {                    
                    old_password: {
                        required: "Please provide old password",
                        minlength: "Password mustbe atleast 6 charcters"
                    },
                    new_password: {
                        required: "Please provide new password",
                        minlength: "Password mustbe atleast 6 charcters"
                    },
                    confirm_new_password: {
                        required: "Please confirm new password",
                        minlength: "Password mustbe atleast 6 charcters"
                    }
                }   
            });
            <?php if(validation_errors()){?>
                validator.showErrors({
                    <?php if(form_error('old_password')){?>
                        "old_password": "<?php echo form_error('old_password');?>",
                    <?php }?>
                    
                    <?php if(form_error('new_password')){?>
                        "new_password": "<?php echo form_error('new_password');?>",
                    <?php }?>
                    <?php if(form_error('confirm_new_password')){?>
                        "confirm_new_password": "<?php echo form_error('confirm_new_password');?>",
                    <?php }?>
                });
            <?php }?>
            <?php if(isset($errors)){?>
                 validator.showErrors({
                <?php foreach ($errors as $key => $value){?>
                    "<?php echo $key?>": "<?php echo $value;?>",

                <?php }?>
                });
            <?php }?>
        });
    </script>