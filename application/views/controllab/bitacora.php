<div class="container-fluid">
  <div class="row">
     <div class="btn-group btn-group-justified">
            <a href="<?php echo base_url(); ?>controllab" class='btn btn-primary btn-lg' title="Asignar equipo"><i class="glyphicon glyphicon-play"></i></a>
            <a href="<?php echo base_url(); ?>controllab/reporte" class='btn btn-info btn-lg' title="Graficas"><i class="glyphicon glyphicon-stats"></i></a>
    </div>
  </div>
</div>
<br>
<table id="card-table" class="table">
    <thead>
      <tr class="warning">
        <th class="text-center">Fecha/Hora Inicio</th>
        <th class="text-center">Fecha/Hora Fin</th>
        <th class="text-center">noControl</th>
        <th class="text-center">Computadora</th>
        <th class="text-center">Opciones</th>
      </tr>
    </thead>
    <tbody>
<?php if($resultado){
      foreach($resultado->result() as $row){ ?>
        <tr <?php if($row->asignado==1){echo 'class="bg-primary"';}if($row->asignado==2){echo 'class="bg-info"';}?>>
            <?php 
            $fechaI = strtotime($row->fechaInicio);
            $fechaF = strtotime($row->fechaFin);
            ?>     
            <td class="text-center"><?= $FormatoFechaIncio = date("d/F/Y h:i A", $fechaI); ?></td>
            <td class="text-center">
            <?php  if($row->asignado==2){ ?>
                <?= $FormatoFechaFin = date("d/F/Y h:i A", $fechaF); ?>
            <?php }?>
            </td>
            <td class="text-center"><?= $row->noControl; ?></td>
            <td class="text-center"><?= $row->comp_numero; ?></td>
            <td class="text-center">
            <?php  if($totaE!=0){ ?>
            <?php  if($row->asignado==1){ ?>
            <a href='<?= base_url().'controllab/modificar/'.$row->comp_numero ?>'><button type='button' class='btn btn-warning' title="Cambiar de Equipo"><i class="glyphicon glyphicon-retweet"></i></button></a>
            <?php }?>
            <?php }?>
            </td>
		</tr>
<?php  }	

}?>
    </tbody>
</table>
	<p><center><?=$pagination?></center></p>
