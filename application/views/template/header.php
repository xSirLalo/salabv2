<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (isset($this->session->userdata['logged_in'])) {
$idUsuario = ($this->session->userdata['logged_in']['idUsuario']);
$nombre_usr = ($this->session->userdata['logged_in']['nombre_usr']);
$aPaterno_usr = ($this->session->userdata['logged_in']['aPaterno_usr']);
$email = ($this->session->userdata['logged_in']['email']);
$idTipoUsuario = ($this->session->userdata['logged_in']['idTipoUsuario']);
} else {
redirect('login');
}
?><!DOCTYPE html>
<html lang="es">
<head>
<style type="text/css" media="screen">
	body, html {
    height: 100%;
    background-repeat: no-repeat;
    background: url(<?php echo base_url(); ?>assets/img/pinlayer4.jpg);
    /*background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
}
</style>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="icon" href="<?=base_url()?>assets/favicon.ico" type="image/ico">
	<title>SALAB - <?=$titulo?></title>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/moment.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/libraries/bootstrap-3.3.7/js/transition.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/libraries/bootstrap-3.3.7/js/collapse.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/libraries/bootstrap-3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/data.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/libraries/stacktable/stacktable.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/libraries/stacktable/stacktable.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/libraries/bootstrap-3.3.7/css/bootstrap.min.css">
</head>
<body data-spy="scroll" data-target="myNavbar">
	<nav id="" class="navbar navbar-default navbar-fixed-top" role="navigation">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#" id="menu-toggle" data-toggle="modal" data-target="#myModal">SALAB</a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">

	      <ul class="nav navbar-nav">
		      <li class="active"><a href="<?php echo base_url();?>">Home</a></li>
		      <li class=""><a href="<?php echo base_url();?>controllab/agregar">Control</a></li>
			<li class="dropdown">
		        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu
		        <span class="caret"></span></a>
		        <ul class="dropdown-menu">
				<li><a href="<?php echo base_url(); ?>alumno" 
					<?php if($this->uri->segment(1)=="alumno"){echo 'class="p-3 mb-2 bg-info text-white"';}?> >Alumnos</a></li>
				<li><a href="<?php echo base_url(); ?>profesor" 
					<?php if($this->uri->segment(1)=="profesor"){echo 'class="p-3 mb-2 bg-info text-white"';}?> >Profesores</a></li>
				<li><a href="<?php echo base_url(); ?>asignatura" 
					<?php if($this->uri->segment(1)=="asignatura"){echo 'class="p-3 mb-2 bg-info text-white"';}?> >Asignaturas</a></li>
				<li><a href="<?php echo base_url(); ?>horario" 
					<?php if($this->uri->segment(1)=="horario"){echo 'class="p-3 mb-2 bg-info text-white"';}?> >Horarios</a></li>
				<li><a href="<?php echo base_url(); ?>computadora" 
					<?php if($this->uri->segment(1)=="computadora"){echo 'class="p-3 mb-2 bg-info text-white"';}?> >Computadoras</a></li>
				<li><a href="<?php echo base_url(); ?>dispositivo" 
					<?php if($this->uri->segment(1)=="dispositivo"){echo 'class="p-3 mb-2 bg-info text-white"';}?> >Dispositivos</a></li>

				<?php if($idTipoUsuario==1) { ?>
				<li><a href="<?php echo base_url(); ?>usuario" 
					<?php if($this->uri->segment(1)=="usuario"){echo 'class="p-3 mb-2 bg-danger text-white"';}?> >Usuarios</a></li>
				<?php } ?>
				
				<li><a href="<?php echo base_url(); ?>incidencia" 
					<?php if($this->uri->segment(1)=="incidencia"){echo 'class="p-3 mb-2 bg-warning text-white"';}?> >Incidencias</a></li>
					<li role="separator" class="divider"></li>
				<li><a href="<?php echo base_url(); ?>controllab/agregar" 
					<?php if($this->uri->segment(1)=="controllab"){echo 'class="p-3 mb-2 bg-primary text-white"';}?> >Control Lab</a></li>
		        </ul>
      		</li>

	      </ul>

	      <ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
		        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $nombre_usr.' '.$aPaterno_usr ?>
		        <span class="caret"></span></a>
		        <ul class="dropdown-menu">
		          <li><a href='<?php echo base_url(); ?>usuario/modificar/<?php echo $idUsuario ?>'><span class="glyphicon glyphicon-cog"></span> Configuracion</a></li>
		          <li role="separator" class="divider"></li>
		          <li><a href="<?php echo base_url(); ?>login/loguot"><span class=" glyphicon glyphicon-log-in"></span> Cerrar Session</a></li>
		        </ul>
		    </li>
	        
	      </ul>
	    </div>
	  </div>
	</nav>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
	      <div class="modal-body">
			<?php
			echo "Hello <b id='welcome'><i>" . $nombre_usr . "</i> !</b>";
			echo "<br/>";
			echo "<br/>";
			echo "Welcome to Admin Page";
			echo "<br/>";
			echo "<br/>";
			echo "Your Name is " . $nombre_usr;
			echo "<br/>";
			echo "Your Email is " . $email;
			echo "<br/>";
			echo "Your ID Type is " . $idTipoUsuario;
			echo "<br/>";
			?>
	        <p style="text-align: center"><img src="<?php echo base_url(); ?>assets/img/back.jpg" width="100%" height="100%"/></p>
	        <p style="text-align: center">Elige un trabajo que te guste y no tendrás que trabajar ni un día de tu vida.</p>
	      </div>
	      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->

	<div class="container"><!--container-->
		<div class="jumbotron"><!--jumbotron-->
			<div class="page-header"><p class="h1 text-center"><?=$titulo?></p></div>
			<!-- Control de Mensajes de error -->		
				<div class="container">
				<?php if ($this->session->flashdata('success')) { ?>
				        <?php echo $this->session->flashdata('success'); ?>
				<?php } ?>
				<?php if ($this->session->flashdata('error')) { ?>
				        <?php echo $this->session->flashdata('error'); ?>
				<?php } ?>	
				</div>
