<?php echo form_open(base_url().'controllab/guardar', 'class="form-inline" role="form" id="form"'); ?>
<center>
  <div class="form-group mb-2">
  </div>
  <div class="form-group mx-sm-3 mb-2">
    <input type="text" class="form-control input-lg" id="noControl" name='noControl' value="<?php echo set_value('noControl'); ?>" placeholder="Numero de Control" autofocus required>
  </div>
  <button type="submit" class="btn btn-primary" title="Disponibles <?=$totaE?>"><span style="font-size: 25px" class="glyphicon glyphicon-triangle-right"></span></button>
  <a href="<?php echo base_url(); ?>controllab" class="btn btn-info" title="Lista"><span style="font-size: 25px" class="glyphicon glyphicon-list"></span></a>
</center>
<?php echo form_close(); ?>