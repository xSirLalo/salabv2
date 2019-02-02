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
    top: 15%;
    left: 30%;
    transform: translate(-50%, -50%);
}
</style>
<div class="container-fluid">
  <div class="row">
 <div class="btn-group">
        <a href="<?php echo base_url(); ?>controllab" class='btn btn-primary btn-lg' title="Asignar equipo"><i class="glyphicon glyphicon-check"></i></a>
        <a href="<?php echo base_url(); ?>controllab/reporte" class='btn btn-primary btn-lg' title="Reporte"><i class="glyphicon glyphicon-stats"></i></a>
</div> 
  </div>
</div>
<br>

<?php foreach($resultado->result() as $row){ ?>
<div class="contenedor">
    <?php  if($row->control==2){ ?>
    <a href="<?= base_url().'controllab/modificar/'.$row->idControlLab ?>">
    <?php }?>    
    <img src="<?php echo base_url(); ?>assets/img/pc.png" alt="<?= $row->idControlLab; ?>" width="196" height="196"></a>

    <div class="texto-encima centrado"><h2>
    <b <?php 
            if($row->control==2){echo 'class="text-primary"';}
            if($row->idEstatus==3){echo 'class="text-success"';}
            if($row->idEstatus==4){echo 'class="text-danger"';}
        ?> ><?= $row->comp_numero; ?></b></h2></div>
    </div>	
<?php } ?>

