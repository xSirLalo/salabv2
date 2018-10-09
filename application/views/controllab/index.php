<style type="text/css">
.contenedor{
    position: relative;
    display: inline-block;
    text-align: center;
}
 
.texto-encima{
    position: absolute;
    top: 10px;
    left: 10px;
}
.centrado{
    position: absolute;
    top: 25%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.alert-fixed {
    position:fixed; 
    top: 0px; 
    left: 0px; 
    width: 100%;
    z-index:9999; 
    border-radius:0px
}
</style>

<?php echo form_open(base_url().'controllab/sesion_iniciada', 'class="form-inline" role="form" id="form"'); ?>
<center>
  <div class="form-group mb-2">
  </div>
  <div class="form-group mx-sm-3 mb-2">
    <input type="text" class="form-control input-lg" id="noControl" name='noControl' value="<?php echo set_value('noControl'); ?>" placeholder="Número de Control" autofocus required>
  </div>
  <button type="submit" class="btn btn-primary" title="Disponibles <?=$totaE?>"><span style="font-size: 25px" class="glyphicon glyphicon-triangle-right"></span></button>
  <a href="<?php echo base_url(); ?>controllab/bitacora" class="btn btn-info" title="Bitacora"><span style="font-size: 25px" class="glyphicon glyphicon-list"></span></a>
  <?php echo form_error('noControl'); ?>
</center>
<?php echo form_close(); ?>
<br>

<?php foreach($resultado->result() as $row){ ?>
<div class="contenedor">
    <?php  if($totaE!=0){ if($row->control==2){ ?>
    <a href="<?= base_url().'controllab/modificar/'.$row->idControlLab ?>">
    <?php } }?>    
    <img src="<?php echo base_url(); ?>assets/img/pc.png" alt="<?= $row->idControlLab; ?>" width="196" height="196"></a>

    <div class="texto-encima centrado"><h2>
    <b <?php 
            if($row->control==2){echo 'class="text-primary"';}
            if($row->idEstatus==3){echo 'class="text-success"';}
            if($row->idEstatus==4){echo 'class="text-danger"';}
        ?> ><?= $row->comentarios; ?></b></h2>
    <?php  if($row->control==2){ ?>
    <b><?= $row->noControl; ?></b>
    <?php }?>   
    </div>
 </div>	
<?php } ?>