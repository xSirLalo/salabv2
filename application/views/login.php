<div class="container">
    <div class="card card-container">
        <div class="main-login main-center">
            <img id="profile-img" class="profile-img-card" src="<?php echo base_url(); ?>assets/img/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <?php echo form_open(base_url().'login', 'class="form-signin" accept-charset="UTF-8" role="form" id="form"'); ?>
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email'); ?>" required autofocus >
                <?php echo form_error('email'); ?>
                <input type="password" data-toggle="tooltip" data-trigger="manual" data-title="Caps lock is on" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                <?php
                echo "<div class='text-muted'>";
                if (isset($error_message)) {
                    echo $error_message.'';}
                    echo "</div>";
                    echo form_error('password');
                ?>
                <div class="wrapper">
                    <span class="group-btn  col-lg-6"> 
                        <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
                    </span>
                </div>
            <?php echo form_close(); ?>
            <div class="text-center">
                <a href="<?php echo base_url() ?>login/new_user_registration" class="link-help">Create an account </a>|
                <a href="<?php echo base_url() ?>login/forgot_password" class="link-help">Forgot password</a>
            </div>
            </div>
    </div><!-- /card-container -->
</div><!-- /container -->

<!--DETECTAR LA ENTRADA DE MAYUSCULAS-->
<script type="text/javascript">
$('[type=password]').keypress(function(e) {
  var $password = $(this),
      tooltipVisible = $('.tooltip').is(':visible'),
      s = String.fromCharCode(e.which);
  
  //Check if capslock is on. No easy way to test for this
  //Tests if letter is upper case and the shift key is NOT pressed.
  if ( s.toUpperCase() === s && s.toLowerCase() !== s && !e.shiftKey ) {
    if (!tooltipVisible)
        $password.tooltip('show');
  } else {
    if (tooltipVisible)
        $password.tooltip('hide');
  }
  
  //Hide the tooltip when moving away from the password field
  $password.blur(function(e) {
    $password.tooltip('hide');
  });
});
</script>