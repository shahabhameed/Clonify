<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'class' => 'form-control',
	'placeholder' => 'Enter User Name ...',
);
if ($login_by_username && $login_by_email) {
	$login_label = 'Email or login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'class' => "form-control",
	'placeholder' => 'Enter Password ...',

);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin:0;padding:0',
	'class' => 'styled',
);
$captcha = array(
  'name'  => 'recaptcha_response_field',
  'id'    => 'recaptcha_response_field',
  'class' => 'form-control',
  'placeholder' => 'Enter the words above'  
        
);
?>     

    <div class="container">
            <div class="loginHeader"><h2>Login</h2></div>
        <div class="loginContainer">


            <?php echo form_open($this->uri->uri_string(),array('class' => 'form-horizontal', 'id' => 'loginForm', 'role' => 'form')); ?>
                <div class="form-group">
                    <label class="col-lg-12 control-label" for="username">Username/Email:</label>
                    <div class="col-lg-12">
                        <?php echo form_input($login); ?>                        
                    </div>
                </div><!-- End .form-group  -->
                <div class="form-group">
                    <label class="col-lg-12 control-label" for="password">Password:</label>
                    <div class="col-lg-12">
                        <?php echo form_password($password); ?>
                        <div class="checkbox left">
                            <label style="font-size:11px;"><?php echo form_checkbox($remember); ?>Remember me</label>
                        </div>                        
                        <span class="forgot help-block"><a href="<?=site_url('/auth/forgot_password/')?>">Forgot your password?</a></span>
                    </div>
                </div>
                <?php if ($show_captcha) {
		if ($use_recaptcha) { ?>
                <div class="form-group">
                    <div id="recaptcha_image" class="col-lg-12"></div>
                    <label class="col-lg-12 control-label" for="Update CAPTCHA">
                      <a href="javascript:void(0)" onclick="Recaptcha.reload()">
                        Update Captcha
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
                    <div class="col-lg-12 clearfix form-actions">                      
                        <button type="submit" class="btn btn-info center" id="loginBtn"><span class="fa fa-sign-in white"></span> Login</button>
                        <?php if ($this->config->item('allow_registration', 'tank_auth')){?>
                        <a href="<?=site_url('auth/register');?>" class="btn btn-success center" style="margin-top:10px;"><span class="fa fa-upload white" ></span> Sign up</a>
                        <?php } ?>
                    </div>
                </div><!-- End .form-group  -->
            </form>
        </div>

    </div><!-- End .container -->    
    <?php echo $recaptcha_html; ?>
    <!-- Le javascript
    ================================================== -->
    <script type="text/javascript">
    // document ready function
              $(document).ready(function() {
      $("input, textarea, select").not('.nostyle').uniform();
    <?php if (isset_flash_data('display')) { ?>
        $.pnotify({
        type: '<?= flash_message_type("display"); ?>',
                text: '<?= flash_message("display"); ?>',
                opacity: 0.95,
                history: false,
                sticker: false
                });
    <?php } ?>
      validator = $("#loginForm").validate({
      rules: {
      login: {
      required: true,
              minlength: 4
              },
              password: {
              required: true,
                      minlength: 6
                      }
      },
              messages: {
              login: {
              required: "Username is required",
                      minlength: "Username mustbe atleast 4 chracters"
                      },
                      password: {
                      required: "Please provide a password",
                              minlength: "Password mustbe atleast 6 charcters"
                              }
              }
      });
    <?php if (validation_errors()) { ?>
        validator.showErrors({
      <?php if (form_error('login')) { ?>
          "login": "<?php echo form_error('login'); ?>",
      <?php } ?>
      <?php if (form_error('password')) { ?>
          "password": "<?php echo form_error('password'); ?>",
      <?php } ?>

        });
    <?php } ?>
    <?php if (isset($errors)) { ?>
        validator.showErrors({
      <?php foreach ($errors as $key => $value) { ?>
          "<?php echo $key ?>": "<?php echo $value; ?>",
      <?php } ?>
        });
    <?php } ?>
  });
</script>
<!-- <div id="fb-landing-page-data">
      <div id="fb-root"></div>
      <script type="text/javascript">
          
            window.fbAsyncInit = function() {
              FB.init({
                appId      : "240862889425196",
                status     : true, 
                cookie     : true,
                xfbml      : true,
                oauth      : true
              });
                  
            };

            (function(d){
               var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
               if (d.getElementById(id)) {return;}
               js = d.createElement('script'); js.id = id; js.async = true;
               js.src = "//connect.facebook.net/en_US/all.js";
               ref.parentNode.insertBefore(js, ref);
             }(document));
             
             function login_user(){
              FB.login(function(response) {
                 if (response.authResponse) {
                   console.log('Welcome!  Fetching your information.... ');
                   FB.api('/me', function(response) {
                      if(response.email){
                          window.location = "<?=base_url()?>auth/fb_login";
                      }else{
                           alert('You cancelled login or did not fully authorize.');
                      }
                   });
                 } else {
                   alert('You cancelled login or did not fully authorize.');
                 }
               }, {scope: 'email'});
             }
             function fb_invite(){
              FB.ui({
                  method: 'apprequests',
                  message: 'Invite You to Clonify'
                });
             }
      </script> 
  </div> -->