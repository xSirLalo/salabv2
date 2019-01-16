<div class="container-fluid">
  <div class="row">
    <div class="col-md-4">
        <div class="btn-group btn-group-md">
            <a href="<?php echo base_url(); ?>horario/agregar" ><button type='button' class='btn btn-primary' title="Agregar horario"><span class=" glyphicon glyphicon-copy"></span> Agregar horario</button></a>
        </div>
    </div>
    <div class="col-md-8 text-right">
        <div class="btn-group">
            <?php echo form_open(base_url().'horario/index', 'class="form-horizontal" role="form" id="form"');
                    echo "<select class='btn btn-default' name='idAula' id='idAula'>";
                    echo "<option value=''>TODAS</option>";
                        foreach($aulas as  $row){
                            $selectvalue = set_value('idAula');
                            $selected = "";
                            if($selectvalue == $row->idAula){$selected = 'selected';}
                            echo '<option value="'.$row->idAula.'" '.$selected.'>'.$row->nombre_au."</option>";}
                    echo "</select>";

                    echo "<select style='max-width:25%;' class='btn btn-default' name='idAsignatura' id='idAsignatura'>";
                    echo "<option value=''>TODAS</option>";
                        foreach($asignaturas as  $row){
                            $selectvalue = set_value('idAsignatura');
                            $selected = "";
                            if($selectvalue == $row->idAsignatura){$selected = 'selected';}
                            echo '<option value="'.$row->idAsignatura.'" '.$selected.'>'.$row->nombre_as."</option>";}
                    echo "</select>";
                    
                    echo "<select type='button' class='btn btn-default' name='idEstatus' id='idEstatus'>";
                    echo "<option value=''>TODAS</option>";
                        foreach($estatus as  $row){
                            $selectvalue = set_value('idEstatus');
                            $selected = "";
                            if($selectvalue == $row->idEstatus){$selected = 'selected';}
                            echo '<option value="'.$row->idEstatus.'" '.$selected.'>'.$row->nombre_estatus."</option>";}
                    echo "</select>";
                    echo "<button type='submit' class='btn btn-default' title='Filtrar'><span class='glyphicon glyphicon-search'></span></button>";
            echo form_close();?>
        </div>
    </div>
  </div>
</div>

<table id="card-table" class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>horaInicio</th>
        <th>horaFin</th>
        <th>dia</th>
        <th>Aula</th>
        <th>Asignatura</th>
        <th>Estatus</th>
        <th>Opciones</th>
      </tr>
    </thead>
    <tbody>
<?php if($resultado){
      foreach($resultado->result() as $row){ ?>
      
        <tr>
            <?php 
            $horaI = strtotime($row->horaInicio);
            $horaF = strtotime($row->horaFin);
            ?>
            <td><?= $row->idHorario; ?></td>
            <td><?= $FormatoHoraInicio = date("g:i A", $horaI); ?></td>
            <td><?= $FormatoHoraFin = date("g:i A", $horaF); ?></td>
            <td><?= $row->dia; ?></td>
            <td><?= $row->nombre_au; ?></td>
            <td><?= $row->nombre_as; ?></td>
            <td><?= $row->EstatusH; ?></td>
	        <td>
	        <a href='<?= base_url().'horario/modificar/'.$row->idHorario ?>'><button type='button' class='btn btn-warning' title="Modificar"><span class="glyphicon glyphicon-pencil"></span></button></a>
            <?php  if($row->EstatusH==3){ ?>
              <a href="#" data-href='<?= base_url().'horario/eliminar/'.$row->idHorario ?>' data-toggle="modal" data-target="#confirm-delete"><button type='button' class='btn btn-danger' title="Dar de baja"><span class="glyphicon glyphicon-paste"></span></button></a>
            <?php }?>
	        </td>
		</tr>
        
        <?php }
}?>
    </tbody>
</table>
	<p><center><?=$pagination?></center></p>