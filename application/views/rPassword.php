<?php
// Check for tokens
$selector = filter_input(INPUT_GET, 'selector');
$validator = filter_input(INPUT_GET, 'validator');
//echo time();
if ( false !== ctype_xdigit( $selector ) && false !== ctype_xdigit( $validator ) ) : 
?>
		<div class="container">
			<div class="card card-container">
				<div class="main-login main-center">
            	<p id="profile-name" class="profile-name-card"></p>
					<?php echo form_open(base_url().'login/reset_password', 'accept-charset="UTF-8" role="form" id="form" method="GET"'); ?>

						<input type="hidden" class="form-control" name="selector" id="selector" value="<?php echo set_value('selector',$selector); ?>"/>
						<input type="hidden" class="form-control" name="validator" id="validator" value="<?php echo set_value('validator',$validator); ?>"/>

						<div class="form-group">
							<div class="cols-sm-10">
									<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your new Password" required/>
								</div><?php echo !isset($_GET["password"]) ? "" : form_error('password');?>
						</div>
						<div class="form-group">
							<div class="cols-sm-10">
									<input type="password" class="form-control" name="passwordconf" id="passwordconf"  placeholder="Repeat Password" required/>
								</div><?php echo !isset($_GET["passwordconf"]) ? "" : form_error('passwordconf');?>
							<?php 
								echo '<div class="text-warning text-center">';
								if (isset($message_display)){
								echo $message_display.'';}
								echo '</div>';
							?>
						</div>
						<div class="form-group ">
							<button type="submit" class="btn btn-success btn-block login-button">Reiniciar contraseña</button>
						</div>
						<div class="login-register">
				            <a href=<?php echo base_url() ?>>For Login Click Here</a>
				        </div>
            		<?php echo form_close(); ?>
				</div>
			</div>
		</div>
		<?php else: redirect('login'); ?>
<?php endif; ?>
    <footer class="page-footer font-small blue pt-4 mt-4">
        <div class="footer-copyright navbar-fixed-bottom text-center"">
            © 2018 Copyright:
            <a href="https://facebook.com/pckonect" target="_blank" class="text-primary"> Eduardo Cauich</a>
        </div>
    </footer>
</body>
</html>