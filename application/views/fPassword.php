<div class="container">
	<div class="card card-container">
		<div class="main-login main-center">
    <p id="profile-name" class="profile-name-card"></p>
			<?php echo form_open(base_url().'login/forgot_password', 'accept-charset="UTF-8" role="form" id="form"'); ?>
				<div class="form-group">
					<div class="cols-sm-10">
							<input type="email" class="form-control" name="email" id="email"  placeholder="Enter your Email" value="<?php echo set_value('email'); ?>" required/>
					</div>
					<?php 
						echo '<div class="text-danger">';
						if (isset($message_display)){
						echo $message_display.'';}
						echo '</div>';
						echo form_error('email'); 
					?>
				</div>
				<div class="form-group ">
					<button type="submit" class="btn btn-warning btn-block login-button">Solicitar</button>
				</div>
				<div class="login-register">
		            <a href=<?php echo base_url() ?>>For Login Click Here</a>
		        </div>
    		<?php echo form_close(); ?>
		</div>
	</div>
</div><?php echo !isset($debug) ? "" : $debug;?>