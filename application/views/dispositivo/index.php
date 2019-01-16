<div class="container-fluid">
  <div class="row">
    <div class="col-md-5">
        <a href="<?php echo base_url(); ?>dispositivo/agregar" ><button type='button' class='btn btn-primary' title="Agregar dispositivo"><span class="glyphicon glyphicon-plus"></span> Agregar dispositivo</button></a>
    </div>
    <div class="col-md-7">
        <div class="btn-group">
            <?php echo form_open(base_url().'dispositivo/index', 'class="form-horizontal" role="form" id="form"');
                echo "<select class='btn btn-default' name='idAula' id='idAula'>";
                    echo "<option value=''>TODAS</option>";
                        foreach($aulas as  $row){
                            $selectvalue = set_value('idAula');
                            $selected = "";
                            if($selectvalue == $row->idAula){$selected = 'selected';}
                            echo '<option value="'.$row->idAula.'" '.$selected.'>'.$row->nombre_au."</option>";}
                    echo "</select>";

                    echo "<select class='btn btn-default' name='idTipoDispositivo' id='idTipoDispositivo'>";
                    echo "<option value=''>TODAS</option>";
                        foreach($tipoDispositivo as  $row){
                            $selectvalue = set_value('idTipoDispositivo');
                            $selected = "";
                            if($selectvalue == $row->idTipoDispositivo){$selected = 'selected';}
                            echo '<option value="'.$row->idTipoDispositivo.'" '.$selected.'>'.$row->nombre_tipdis."</option>";}
                    echo "</select>";

                    echo "<select class='btn btn-default' name='idEstatus' id='idEstatus'>";
                    echo "<option value=''>TODAS</option>";
                        foreach($estatus as  $row){
                            $selectvalue = set_value('idEstatus');
                            $selected = "";
                            if($selectvalue == $row->idEstatus){$selected = 'selected';}
                            echo '<option value="'.$row->idEstatus.'" '.$selected.'>'.$row->nombre_estatus."</option>";}
                    echo "</select>";
                    echo "<button type='submit' class='btn btn-default' title='Filtrar'><span class='glyphicon glyphicon-search'></span> Buscar</button>";
            echo form_close();?>
        </div>
    </div>
</div>
<table id="card-table" class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Fabricante</th>
        <th>Modelo</th>
        <th>N° Serie</th>
        <th>idTipo</th>
        <th>fechaAlta</th>
        <th>fechaIngreso</th>
        <th>Estatus</th>
        <th>Opciones</th>
      </tr>
    </thead>
    <tbody>
<?php if($resultado){
      foreach($resultado->result() as $row){ ?>
        <tr>
            <?php
            //Formato a la fecha mostrada en la lista
            $fechaA = strtotime($row->fechaAlta);
            $fechaI = strtotime($row->fechaIngreso);
            ?>
            <td><?= $row->idDispositivo; ?></td>
            <td><?= $row->fabricante; ?></td>
            <td><?= $row->modelo; ?></td>
            <td><?= $row->numeroSerie; ?></td>
            <td><?= $row->idTipoDispositivo; ?></td>
            <td><?= $FormatoFechaAlta = date("d/F/Y h:i A", $fechaA); ?></td>
            <td><?= $FormatoFechaIngreso = date("d/F/Y g:i A", $fechaI); ?></td>
            <td><?= $row->idEstatus; ?></td>
            <td>
            <a href='<?= base_url().'dispositivo/modificar/'.$row->idDispositivo ?>'><button type='button' class='btn btn-warning' title="Modificar"><span class="glyphicon glyphicon-pencil"></span></button></a>
            <?php  if($row->idEstatus==3){ ?>
              <a href="#" data-href='<?= base_url().'dispositivo/eliminar/'.$row->idDispositivo ?>' data-toggle="modal" data-target="#confirm-delete"><button type='button' class='btn btn-danger' title="Dar de baja"><span class="glyphicon glyphicon-thumbs-down"></span></button></a>
            <?php }?>
            </td>
		</tr>
        <?php }
}?>
    </tbody>
</table>
	<p><center><?=$pagination?></center></p>

