<center>
<?php if ($Opciones) { ?>
	<?php foreach ($Opciones as $opcion){ ?>
		<?php echo form_open(base_url().'home/guardar/'.$opcion->idOpcion, 'class="form-horizontal" role="form" id="form1"'); ?>
			    <div class="form-group">
			        <label for="opt_java" class="col-lg-auto control-label">JAVA</label>
			        <div class="col-lg-auto">
			              <label class="radio-inline">
			                <input type="radio" name="opt_java" value="0" <?=($opcion->opt_java == '0' ?'checked':'')?> >DESACTIVADO
			              </label>
			              <br>
			              <label class="radio-inline">
			                <input type="radio" name="opt_java" value="1" <?=($opcion->opt_java == '1' ?'checked':'')?> >ACTIVADO
			              </label><?php echo form_error('opt_java'); ?>
			        </div>
			    </div>
		    <div class="form-group text-center">
		    <?=form_submit(array('type' => 'submit', 'class' => 'btn btn-primary', 'value' => 'Guardar'));?>
		    </div>
		<?php echo form_close(); ?>
	<?php } ?>
<?php } ?>
<hr>
<?php $file_name1 = 'ControlServer_setup.exe'; ?>
<?php $file_name2 = 'ControlClient_setup.exe'; ?>
<h1 class="text-center">Descargas</h1>
<br>
<a class="btn btn-info" title="Click to download" href="<?php echo base_url() ?>home/ControlServerDownload/<?php echo $file_name1; ?>" >ControlServer</a>
<a class="btn btn-primary" title="Click to download" href="<?php echo base_url() ?>home/ControlClientDownload/<?php echo $file_name2; ?>" >ControlClient</a>	
</center>

