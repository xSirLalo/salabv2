<div>
<?php if ($Opciones) { ?>

<?php foreach ($Opciones as $opcion){ ?>
<?php 
$opt_java = array('name' => 'opt_java', 'id' => 'opt_java', 'class' => 'form_control', 'value' => set_value('opt_java', $opcion->opt_java) );
$idOpcion = array('name' => 'idOpcion', 'id' => 'idOpcion', 'class' => 'form_control', 'value' => set_value('idOpcion', $opcion->idOpcion) );

?>
<?php echo form_open(base_url().'home/guardar/'.$opcion->idOpcion, 'class="form-horizontal" role="form" id="form1"'); ?>
    
    <?=form_hidden($idOpcion);?>
    
    <div class="form-group">
        <?=form_label('JAVA', 'opt_java');?>
        <?=form_input($opt_java);?>
    </div>

    <div class="form-group">
    <?=form_submit(array('type' => 'submit', 'class' => 'btn btn-primary', 'value' => 'Guardar'));?>
    </div>

<?php echo form_close(); ?>
<?php } ?>
<?php } ?>
</div>