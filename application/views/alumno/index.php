<div class="container-fluid">
  <div class="row">
    <div class="col-sm-6">
     <div class="btn-group btn-group-justified">
            <a href="<?php echo base_url(); ?>alumno/agregar" class='btn btn-primary' title="Agregar alumno"><i class="glyphicon glyphicon-plus"></i> Agregar Alumno</a>
            <a href="<?php echo base_url(); ?>alumno/exportCSV" class='btn btn-success' title="Exportar a Excel"><i class="glyphicon glyphicon-list-alt"></i> Exportar</a>
    </div>
    </div>
        <div class="col-sm-6">
            <form action="" class="search-form">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="search" id="search" title="Buscar" placeholder="Numero de Control">
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
            </form>
        </div>
  </div>
</div>
<table id="card-table" class="table table-striped">
    <thead>
      <tr>
        <th>noControl</th>
        <th>nombre_al</th>
        <th>aPaterno_al</th>
        <th>aMaterno_al</th>
		<th>idCarrera</th>
        <th>Opciones</th>
      </tr>
    </thead>
    <tbody>
<?php if($resultado){
      foreach($resultado->result() as $row){ ?>
        <tr>
            <td><?= $row->noControl; ?></td>
            <td><?= $row->nombre_al; ?></td>
            <td><?= $row->aPaterno_al; ?></td>
            <td><?= $row->aMaterno_al; ?></td>
            <td><?= $row->nombre_ca; ?></td>
            <td>
            <div class="btn-group">
            <a href="<?= base_url().'alumno/modificar/'.$row->noControl ?>" class='btn btn-warning' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
            <a href="#" data-href='<?= base_url().'alumno/eliminar/'.$row->noControl ?>' data-toggle="modal" data-target="#confirm-delete" class='btn btn-danger' title="Eliminar"><i class="glyphicon glyphicon-remove"></i></a>
            </div>
            </td>
		</tr>
<?php  }	

}?>
    </tbody>
</table>
	<p><center><?=$pagination?></center></p>
