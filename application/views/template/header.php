<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (isset($this->session->userdata['logged_in'])) {
$idUsuario = ($this->session->userdata['logged_in']['idUsuario']);
$nombre_usr = ($this->session->userdata['logged_in']['nombre_usr']);
$aPaterno_usr = ($this->session->userdata['logged_in']['aPaterno_usr']);
$email = ($this->session->userdata['logged_in']['email']);
$idTipoUsuario = ($this->session->userdata['logged_in']['idTipoUsuario']);
$ip = $this->input->ip_address();
} else {
redirect('login');
}
$ci =& get_instance();
$ci->load->model('model_incidencia');
$incidencias = $ci->model_incidencia->incidencias_no_atendidas();
?>
<?php //Fondo de pantalla aleatorios...
   $bg = array('pinlayer1.jpg', 'pinlayer2.jpg', 'pinlayer3.jpg', 'pinlayer4.jpg', 'pinlayer5.jpg', 'pinlayer6.png' , 'pinlayer7.jpg' ); // array of filenames

  $i = rand(0, count($bg)-1); // generate random number size of the array
  $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
?>
<!DOCTYPE html>
<html lang="es">
<head>
<style type="text/css" media="screen">
body, html {
    /* height: 100%; */
    /*background-image: url(<?= base_url()?>assets/img/<?=$selectedBg; ?>);*/
    background-image: linear-gradient(to top right, Lavender, white);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
    background-size: cover;
    overflow-y: scroll;    
}
html {
    width:100vw;
    overflow-x:hidden;
}

</style>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de administracion del Laboratorio de Computo">
    <meta name="author" content="Ing. Eduardo Enrique Cauich Herrera">
	<link rel="icon" href="<?=base_url()?>assets/favicon.ico" type="image/ico">
	<title>SALAB - <?=$titulo?></title>
	<script type="text/javascript" src="<?=base_url()?>assets/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/moment.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/libraries/bootstrap-3.3.7/js/transition.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/libraries/bootstrap-3.3.7/js/collapse.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/libraries/bootstrap-3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/libraries/stacktable/stacktable.js"></script>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/libraries/stacktable/stacktable.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/libraries/bootstrap-3.3.7/css/bootstrap.min.css">
</head>
<body data-spy="scroll" data-target="myNavbar">
	<nav id="" class="navbar navbar-default" role="navigation">
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
		      <li class=""><a href="<?=base_url();?>">Home</a></li>
		      <li class=""><a href="<?=base_url();?>incidencia">Incidencias (<?= $incidencias?>)</a></li>
		      <li class=""><a href="<?=base_url();?>controllab">Control</a></li>
			<li class="dropdown">
		        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu
		        <span class="caret"></span></a>
		        <ul class="dropdown-menu">
				<li><a href="<?=base_url()?>controllab" 
					<?php if($this->uri->segment(1)=="controllab"){echo 'class="p-3 mb-2 bg-primary text-white"';}?> >Control Lab</a></li>
				<li><a href="<?=base_url()?>incidencia" 
					<?php if($this->uri->segment(1)=="incidencia"){echo 'class="p-3 mb-2 bg-warning text-white"';}?> >Incidencias</a></li>
					<li role="separator" class="divider"></li>
				<li><a href="<?=base_url()?>profesor" 
					<?php if($this->uri->segment(1)=="profesor"){echo 'class="p-3 mb-2 bg-info text-white"';}?> >1.- Profesores</a></li>
				<li><a href="<?=base_url()?>asignatura" 
					<?php if($this->uri->segment(1)=="asignatura"){echo 'class="p-3 mb-2 bg-info text-white"';}?> >2.- Asignaturas</a></li>
				<li><a href="<?=base_url()?>horario" 
					<?php if($this->uri->segment(1)=="horario"){echo 'class="p-3 mb-2 bg-info text-white"';}?> >3.- Horarios</a></li>
					<li role="separator" class="divider"></li>
				<li><a href="<?=base_url()?>computadora" 
					<?php if($this->uri->segment(1)=="computadora"){echo 'class="p-3 mb-2 bg-info text-white"';}?> >Computadoras</a></li>
				<li><a href="<?=base_url()?>dispositivo" 
					<?php if($this->uri->segment(1)=="dispositivo"){echo 'class="p-3 mb-2 bg-info text-white"';}?> >Dispositivos</a></li>
					<li role="separator" class="divider"></li>

				<li><a href="<?=base_url()?>alumno" 
					<?php if($this->uri->segment(1)=="alumno"){echo 'class="p-3 mb-2 bg-info text-white"';}?> >Alumnos</a></li>
					
				<?php if($idTipoUsuario==1) { ?>
				<li><a href="<?=base_url()?>usuario" 
					<?php if($this->uri->segment(1)=="usuario"){echo 'class="p-3 mb-2 bg-danger text-white"';}?> >Usuarios</a></li>
				<?php } ?>
		        </ul>
      		</li>
	      </ul>     

	      <ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
		        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?=$nombre_usr.' '.$aPaterno_usr?>
		        <span class="caret"></span></a>
		        <ul class="dropdown-menu">
		          <li><a href='<?=base_url()?>usuario/modificar/<?=$idUsuario?>'><span class="glyphicon glyphicon-cog"></span> Configuracion</a></li>
		          <li role="separator" class="divider"></li>
		          <li><a href="<?=base_url()?>login/loguot"><span class=" glyphicon glyphicon-log-in"></span> Cerrar Session</a></li>
		        </ul>
		    </li>
	        
	      </ul>
	    </div>
	  </div>
	</nav>
	<script type="text/javascript"> 
	$(document).ready(function () {
	        var url = window.location;
	        $('ul.nav a[href="'+ url +'"]').parent().addClass('active');
	        $('ul.nav a').filter(function() {
	             return this.href == url;
	        }).parent().addClass('active');
	    });
	</script><!--Actividad entre botones Home, Control, Incidencias-->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h1 class="modal-title">SALAB - Info!</h1>
      </div>
	      <div class="modal-body">
			
				<h5>Version de PHP: <?=phpversion();?></h5>
				<?=($idTipoUsuario==1?'<h5>Software de servidor '.$_SERVER['SERVER_SOFTWARE'].'</h5>':'');?>
				<div id="JqueryVersion"></div>
				<h5>Version de CI: <?=CI_VERSION;?></h5>
				<h5>Ambiente de CI: <?=ENVIRONMENT?></h5>
				<h5>Sesión CI: <?=$this->config->item('sess_cookie_name');?></h5>
				<h5>Nombre Servidor: <?=$_SERVER['SERVER_NAME'];?></h5>
				<h5>IP Servidor: <?=gethostbyname(gethostname());?></h5>
				<h5>Host: <?=gethostname()?></h5>
				<h5>Sistema operativo: <?=PHP_OS;?></h5>
				<h5>Version SO: <?=php_uname('r').' '.php_uname('v');
				/*
				'a' about all information below given
				's' Operating system
				'n' Host name
				'r' release name
				'v' version name
				'm' machine type*/?></h5>      
				<h5>Máximo de subida: <?=ini_get('upload_max_filesize');?></h5>
				<h5>Máximo de solicitud (subida y post): <?=ini_get('post_max_size');?></h5>
				<h5>Máximo de memoria disponible: <?=ini_get('memory_limit');?></h5>
				<h5>Fecha y Hora del sistema: <?=date('Y-m-d H:i:s');?></h5>
				<h5>IP Cliente: <?=$ip?></h5>
				<h5>MAC?: <?=$_SERVER['REMOTE_ADDR'];?></h5>
				<h5>Sesión PHP: <?=session_name();?></h5>
				<h5>Sesión ID: <?=session_id();?></h5>      
				<h5>Id - Usuario: <?=$idTipoUsuario?> - <?=$nombre_usr?></h5>

	      </div>
	      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
		<!-- Control de Mensajes -->	
		<div  style="float: left;position: fixed;z-index:9999; ">
		<?php if ($this->session->flashdata('success')) { ?>
		        <?=$this->session->flashdata('success'); ?>
		<?php } ?>
		<?php if ($this->session->flashdata('error')) { ?>
		        <?=$this->session->flashdata('error'); ?>
		<?php } ?>	
		</div>
<style type="text/css">
	.jumbotron {
    color: #404040;
    min-height: 550px !important;
    background-color: transparent;
    /*text-align: center;*/
    margin-top: 25;
    font-weight: 200;
}
</style>
	<div class="container-fluid"><!--container-->
		<div class="jumbotron"><!--jumbotron-->
			<div class="page-header"><p class="h1 text-center"><?=$titulo?></p></div>
				
