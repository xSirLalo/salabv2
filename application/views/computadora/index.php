<div class="container-fluid">
  <div class="row">
    <div class="col-sm-6">
        <div class="btn-group">
           <a href="<?php echo base_url(); ?>computadora/agregar" type='button' class='btn btn-primary' title="Agregar computadora" ><span class="glyphicon glyphicon-plus"></span> Agregar computadora</a>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="btn-group">
            <?php echo form_open(base_url().'computadora/index', 'class="form-horizontal" role="form" id="form"');
                echo "<select type='button' class='btn btn-default' name='idAula' id='idAula'>";
                    echo "<option value=''>TODAS</option>";
                        foreach($aulas as  $row){
                            $selectvalue = set_value('idAula');
                            $selected = "";
                            if($selectvalue == $row->idAula){$selected = 'selected';}
                            echo '<option value="'.$row->idAula.'" '.$selected.'>'.$row->nombre_au."</option>";}
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


<table id="card-table" class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Fabricante</th>
        <th>Procesador</th>
        <th>RAM</th>
        <th>HDD</th>
        <th>Sistema</th>
        <th>Aula</th>
        <th>Coment.</th>
        <th>Control</th>
        <th>Estatus</th>
        <th>Opciones</th>
      </tr>
    </thead>
    <tbody>
<?php if($resultado){
      foreach($resultado->result() as $row){ ?>
        <tr>
            <td><?= $row->idComputadora; ?></td>
            <td><?= $row->fabricante; ?></td>
            <td><?= $row->procesador; ?></td>
            <td><?= $row->memoriaInstalada; ?></td>
            <td><?= $row->discoDuro; ?></td>
            <td><?= $row->soVersion; ?></td>
            <td><?= $row->nombre_au; ?></td>
            <td><?= $row->comentarios; ?></td>
            <td><?= $row->control; ?></td>
            <td><?= $row->idEstatus; ?></td>
	        <td>
	        <a href='<?= base_url().'computadora/modificar/'.$row->idComputadora ?>'><button type='button' class='btn btn-warning' title="Modificar"><span class="glyphicon glyphicon-pencil"></span></button></a>
            <?php  if($row->idEstatus==3){ ?>
              <a href="#" data-href='<?= base_url().'computadora/eliminar/'.$row->idComputadora ?>' data-toggle="modal" data-target="#confirm-delete"><button type='button' class='btn btn-danger' title="Dar de baja"><span class="glyphicon glyphicon-thumbs-down"></span></button></a>
            <?php }?>
	        </td>
		</tr>
        <?php }
}?>
    </tbody>
</table>
	<p><center><?=$pagination?></center></p>

