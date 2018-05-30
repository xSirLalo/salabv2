<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SALAB</title>
    <link rel="icon" href="<?=base_url()?>assets/favicon.ico" type="image/ico">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/libraries/bootstrap-3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/libraries/bootstrap-3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/login.css" media="all">
</head>
<body>

    <div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <?php echo form_open(base_url().'login', 'class="form-signin" accept-charset="UTF-8" role="form" id="form"'); ?>

                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" name="email" class="form-control" 
                placeholder="Email" value="<?php echo set_value('email'); ?>" required autofocus >
                <?php echo form_error('email'); ?>

                <input type="password" data-toggle="tooltip" data-trigger="manual" data-title="Caps lock is on" 
                id="inputPassword" name="password" class="form-control" 
                placeholder="Password" required>
                <?php echo form_error('password'); ?>

                <?php
                echo "<div class='error_msg'>";
                if (isset($error_message)) {
                echo $error_message;
                }
                echo "</div>";
                ?>

                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Recordar contraseña
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
            
            <?php echo form_close(); ?>
            <a href="<?php echo base_url() ?>login/new_user_registration" class="forgot-password">
                Create an account
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->

    <footer class="page-footer font-small blue pt-4 mt-4">
        <div class="footer-copyright navbar-fixed-bottom text-center"">
            © 2018 Copyright:
            <a href="https://facebook.com/pckonect" target="_blank" class="text-primary"> Eduardo Cauich</a>
        </div>
    </footer>

</body>
</html>
<!DOCTYPE html>

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