<center>
	<h1>SALAB</h1>
	<h4>Password Changed</h4>
	<b>Hola Eduardo,</b>
	<p>Has solicitado un reinicio de contraseña.</p>
	<a href="">Clic Aqui</a>
	<footer>Sistema de Administracion del Laboratorio de Computo</footer>
	<?php echo time(); ?>
	<?php echo auto_link("https://www.formget.com"); ?>
	<?php echo anchor('controller/function/parameter', 'Link with Title attribute',array('title'=>'Link Title')); ?>
	<?php echo "http://".$_SERVER['HTTP_HOST']; ?>


</center>


<?php
function pingAddress($ip) {
	//$linux = exec("/bin/ping $ip -c 1", $outcome, $status);
    $windows = exec("ping -n 1 $ip", $outcome, $status);
    if (0 == $status) {
        $status = "<b class='text-success'>alive</b>";
    } else {
        $status = "<b class='text-danger'>dead</b>";
    }
    echo "<p>The IP address, $ip, is  ".$status."</p>";
}

pingAddress("192.168.1.99");
echo '<br>';
pingAddress("127.0.0.1");
?>