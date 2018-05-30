<div class="container-fluid">
  <div class="row">
 <div class="btn-group">
        <a href="<?php echo base_url(); ?>controllab/agregar" class='btn btn-primary btn-lg' title="Asignar equipo"><i class="glyphicon glyphicon-check"></i></a>
        <a href="<?php echo base_url(); ?>controllab/reporte" class='btn btn-primary btn-lg' title="Reporte"><i class="glyphicon glyphicon-stats"></i></a>
</div> 
  </div>
</div>
<br>
<table id="card-table" class="table">
    <thead>
      <tr class="warning">
        <th>idControlLab</th>
        <th>fechaInicio</th>
        <th>fechaFin</th>
        <th>noControl</th>
        <th>idComputadora</th>
        <th>idEstatus</th>
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
            <td><?= $row->idControlLab; ?></td>
            <td><?= $FormatoFechaIncio = date("d/F/Y h:i A", $fechaI); ?></td>
            <td><?= $FormatoFechaFin = date("d/F/Y h:i A", $fechaF); ?></td>
            <td><?= $row->noControl; ?></td>
            <td><?= $row->comentarios; ?></td>
            <td><?= $row->asignado; ?></td>
		</tr>
<?php  }	

}?>
    </tbody>
</table>
	<p><center><?=$pagination?></center></p>
