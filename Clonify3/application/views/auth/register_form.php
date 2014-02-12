<?php

if ($use_username) {
	$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value' => set_value('username'),
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'class' => 'form-control',
		'placeholder' => 'Enter username ...'
	);
}
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'class' => 'form-control',
	'placeholder' => 'Enter email ...'
);

$first_name = array(
  'name'  => 'first_name',
  'id'	=> 'first_name',
  'value'	=> set_value('first_name'),
  'maxlength'	=> 100,
  'class' => 'form-control',
  'placeholder' => 'Enter first name...'
);

$last_name = array(
  'name'  => 'last_name',
  'id'	=> 'last_name',
  'value'	=> set_value('last_name'),
  'maxlength'	=> 100,
  'class' => 'form-control',
  'placeholder' => 'Enter last name...'
);

$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => set_value('password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'class' => 'form-control',
	'placeholder' => 'Enter password ...'
);
$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
	'value' => set_value('confirm_password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'class' => 'form-control',
	'placeholder' => 'Retype password ...'
);
$agree_terms_condition = array(
	'name'	=> 'terms_conditions',
	'id'	=> 'terms_conditions',
	'value' => set_value('terms_conditions'),
	'class' => 'form-control',	
);
$captcha = array(
  'name'  => 'recaptcha_response_field',
  'id'    => 'recaptcha_response_field',
  'class' => 'form-control',
  'placeholder' => 'Enter the words above'  
        
);
?>
    <div class="container">
    	<div class="loginHeader"><h2>Sign Up</h2></div>
        <div class="loginContainer">

        	<?php echo form_open($this->uri->uri_string(),array('class' => 'form-horizontal', 'id' => 'registerForm', 'role' => 'form')); ?>
                <div class="form-group">
                      <label class="col-lg-12 control-label" for="first name"><?php echo form_label('Fisrt Name', $first_name['id']); ?>:</label>
                      <div class="col-lg-12">
                          <?php echo form_input($first_name); ?>                          
                      </div>
                </div>
          
                <div class="form-group">
                  <label class="col-lg-12 control-label" for="last name"><?php echo form_label('Last Name', $last_name['id']); ?>:</label>
                    <div class="col-lg-12">
                      <?php echo form_input($last_name); ?>                      
                    </div>
                </div>
                  
                <?php if ($use_username){?>
                  <div class="form-group">
                      <label class="col-lg-12 control-label" for="username"><?php echo form_label('Username', $username['id']); ?>:</label>
                      <div class="col-lg-12">
                          <?php echo form_input($username); ?>                          
                      </div>
                  </div>
                <?php }?>
                <div class="form-group">
                    <label class="col-lg-12 control-label" for="Email Address">
                    	<?php echo form_label('Email Address', $email['id']); ?>:
                    </label>
                    <div class="col-lg-12">
                        <?php echo form_input($email); ?>                        
                    </div>
                </div><!-- End .form-group  -->
                
                <div class="form-group">
                    <label class="col-lg-12 control-label" for="password">
                    	<?php echo form_label('Password', $password['id']); ?>:
                    </label>
                    <div class="col-lg-12">
                        <?php echo form_password($password); ?>
                    </div>
                </div><!-- End .form-group  -->
                <div class="form-group">
                    <label class="col-lg-12 control-label" for="confirm password">
                    	<?php echo form_label('Confirm Password', $confirm_password['id']); ?>:</label>
                    <div class="col-lg-12">
                        <?php echo form_password($confirm_password); ?>
                    </div>
                </div>
                <?php if ($captcha_registration) {
		if ($use_recaptcha) { ?>
                <div class="form-group">
                    <div id="recaptcha_image" class="col-lg-12"></div>
                    <label class="col-lg-12 control-label" for="Update CAPTCHA">
                      <a href="javascript:void(0)" onclick="Recaptcha.reload()">
                        Update Captcha
                      </a>
                      &nbsp;&nbsp;
                      <a href="javascript:Recaptcha.switch_type('audio')">
                        Audio Captcha
                      </a>
                      &nbsp;&nbsp;
                      <a href="javascript:Recaptcha.switch_type('image')">
                        Image Captcha
                      </a>
                    </label>                                                        
                    <div class="col-lg-12">
                        <?php echo form_input($captcha); ?>
                    </div>
                    <div class="col-lg-12">
                      <?php echo form_label(form_error('recaptcha_response_field'), 'error', array('class' => 'error')); ?>                      
                    </div>
                </div>                                
               <?php } }?>
                <div class="form-group">                    
                  <div class="col-lg-12">
                        <?php echo form_checkbox($agree_terms_condition); ?>
                    I agree to the <?php echo $site_name;?> 
                    <a href="/general/terms_condistions" target="_blank">Terms of Service</a>
                  </div>
                </div>
                <br/>
                <div class="form-group">
                    <div class="col-lg-12 clearfix form-actions">
                    	<a href="<?php echo site_url('auth/login');?>" class="btn btn-danger center" style="margin-bottom:10px;"> <span class="fa fa-times white"> Cancel</a>
                        <button type="submit" class="btn btn-info center" id="loginBtn" ><span class="fa fa-upload white"></span> Sign Up</button>
                        
                    </div>
                </div><!-- End .form-group  -->
            </form>
    </div><!-- End .container -->
<?php echo $recaptcha_html; ?>

     <script type="text/javascript">
        // document ready function
        $(document).ready(function() {
            
            $("input, textarea, select").not('.nostyle').uniform();
           
            validator = $("#registerForm").validate({
                
                rules: {
                    first_name: {
                        required: true                        
                    },
                    last_name: {
                        required: true                       
                    },
                    username: {
                        required: true,
                        minlength: 4
                    },
                    email  : {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    terms_conditions: {
                        required: true                        
                    },
                    recaptcha_response_field:{
                      required: true
                    },
                    confirm_password: {
                        required: true,
                    	equalTo: "#password"
                    }
                },
                messages: {
                    first_name: {
                        required: "First Name is required"
                    },
                    last_name: {
                        required: "Last Name is required"
                    },
                    email: {
                        required: "Email is required",
                        email: "Please enter correct email"
                    },
                    username: {
                        required: "Username is required",
                        minlength: "Username mustbe atleast 4 chracters"
                    },
                    password: {
                        required: "Password is required",
                        minlength: "Password mustbe atleast 6 charcters"
                    },
                    confirm_password: {
                        required: "Confirm password is required"                        
                    },
                    terms_conditions:{
                      required: "Please accept terms of service"
                    },
                    recaptcha_response_field: {
                      required: "Please enter captcha"
                    }
                }   
            });
			<?php if(validation_errors()){?>
				validator.showErrors({
					<?php if(form_error('first_name')){?>
				  		"first_name": "<?php echo form_error('first_name');?>",
				  	<?php }?>
                                        <?php if(form_error('last_name')){?>
				  		"last_name": "<?php echo form_error('last_name');?>",
				  	<?php }?>  
                                        <?php if(form_error('username')){?>
				  		"username": "<?php echo form_error('username');?>",
				  	<?php }?>
				  	<?php if(form_error('email')){?>
				  		"email": "<?php echo form_error('email');?>",
				  	<?php }?>
				  	<?php if(form_error('password')){?>
				  		"password": "<?php echo form_error('password');?>",
				  	<?php }?>	
				  	<?php if(form_error('confirm_password')){?>
				  		"confirm_password": "<?php echo form_error('confirm_password');?>"
				  	<?php }?>

				});
			<?php }?>
            <?php if(isset($errors)){?>
                 validator.showErrors({
                <?php foreach ($errors as $key => $value){?>
                    "<?php echo $key;?>": "<?php echo $value;?>",

                <?php }?>
                });
            <?php } ?>
        });
    </script>
