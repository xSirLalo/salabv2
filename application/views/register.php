<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registration Form</title>
	<link rel="icon" href="<?=base_url()?>assets/favicon.ico" type="image/ico">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/libraries/bootstrap-3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/libraries/bootstrap-3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/login.css" media="all">
</head>
<body>
		<div class="container">
			<div class="card card-container">
				<div class="panel-heading">
	               <!-- <div class="panel-title text-center">
	               		<h1 class="title">Company Name</h1>
	               		<hr />
	               	</div>-->
	            </div> 
				<div class="main-login main-center">
					<img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
					<?php echo form_open(base_url().'login/new_user_registration', 'accept-charset="UTF-8" role="form" id="form"'); ?>
						<div class="form-group">
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="nombre_usr" id="nombre_usr"  placeholder="Enter your Name" 
									value="<?php echo set_value('nombre_usr'); ?>"/>
								</div><?php echo form_error('nombre_usr'); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="aPaterno_usr" id="aPaterno_usr"  placeholder="Enter your Middle Name" 
									value="<?php echo set_value('nombre_usr'); ?>"/>
								</div><?php echo form_error('aPaterno_usr'); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="aMaterno_usr" id="aMaterno_usr"  placeholder="Enter your Last Name" 
									value="<?php echo set_value('aMaterno_usr'); ?>"/>
								</div><?php echo form_error('aMaterno_usr'); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-phone" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="telefono" id="telefono"  placeholder="Enter your Phone" 
									value="<?php echo set_value('telefono'); ?>"/>
								</div><?php echo form_error('telefono'); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i></span>
									<input type="email" class="form-control" name="email" id="email"  placeholder="Enter your Email" 
									value="<?php echo set_value('email'); ?>"/>
								</div><?php 
								echo '<div class="text-danger">';
								if (isset($message_display)){
								echo $message_display.'';}
								echo '</div>';
								echo form_error('email'); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password" 
									value="<?php echo set_value('password'); ?>"/>
								</div><?php echo form_error('password'); ?>
							</div>
						</div>
						<div class="form-group ">
							<button type="submit" class="btn btn-primary btn-block login-button">Register</button>
						</div>
						<div class="login-register">
				            <a href=<?php echo base_url() ?>>For Login Click Here</a>
				         </div>
            		<?php echo form_close(); ?>
				</div>
			</div>
		</div>

    <footer class="page-footer font-small blue pt-4 mt-4">
        <div class="footer-copyright navbar-fixed-bottom text-center"">
            © 2018 Copyright:
            <a href="https://facebook.com/pckonect" target="_blank" class="text-primary"> Eduardo Cauich</a>
        </div>
    </footer>

</body>
</html>
<html>