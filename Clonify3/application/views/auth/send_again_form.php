<?php
$email = array(
  'name'  => 'email',
  'id'  => 'email',
  'value' => set_value('email'),
  'maxlength' => 80,
  'class' => 'form-control',
  'placeholder' => 'Enter Emailaddress...',
);
?>

<div class="container">
  <div class="loginHeader"><h2>Re-Send Activation Link</h2></div>
    <div class="loginContainer">
      <?php echo form_open($this->uri->uri_string(),array('class' => 'form-horizontal', 'id' => 'resend_activiation_link', 'role' => 'form')); ?>
        <div class="form-group">
          <label class="col-lg-12 control-label" for="username">Email:</label>
            <div class="col-lg-12">
              <?php echo form_input($email); ?>                        
            </div>
        </div>
         <div class="form-group">
          <div class="col-lg-12 clearfix form-actions">
            <button type="submit" class="btn btn-info center" id="resend_link"><span class="fa fa-sign-in white"></span> Send Activation Link</button>
          </div>
        </div>
      <?php echo form_close(); ?>
    </div>
</div>

 <script type="text/javascript">
    // document ready function
  $(document).ready(function() {
      $("input, textarea, select").not('.nostyle').uniform();
    <?php if (isset_flash_data('display')) { ?>
        $.pnotify({
        type: '<?php echo flash_message_type("display"); ?>',
                text: '<?php echo flash_message("display"); ?>',
                opacity: 0.95,
                history: false,
                sticker: false
                });
    <?php } ?>
      validator = $("#resend_activiation_link").validate({
        rules: {
          email  : {
            required: true,
            email: true
          },
          messages: {
            email: {
              required: "Email is required",
              email: "Please enter correct email"
            }
          }
        }
      });
    <?php if (validation_errors()) { ?>
        validator.showErrors({
      <?php if (form_error('email')) { ?>
          "email": "<?php echo form_error('login'); ?>",
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