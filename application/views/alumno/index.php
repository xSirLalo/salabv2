<div class="container-fluid">
  <div class="row">
        <div class="col-md-4 col-lg-2">
                <a href="<?php echo base_url(); ?>alumno/agregar" ><button type='button' class='btn btn-success' title="Agregar asignatura"><span class="glyphicon glyphicon-plus"></span> Agregar alumno</button></a>
        </div>
        <div class="col-md-5">
                <a href="<?php echo base_url(); ?>alumno/exportCSV" ><button type='button' class='btn btn-default' title="Exportar a Excel"><span class="glyphicon glyphicon-list-alt"></span> Excel</button></a>
        </div>
        <div class="col-md-5 text-right">
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
            <a href='<?= base_url().'alumno/modificar/'.$row->noControl ?>'><button type='button' class='btn btn-warning' title="Modificar"><span class="glyphicon glyphicon-pencil"></span></button></a>
            <a href="#" data-href='<?= base_url().'alumno/eliminar/'.$row->noControl ?>' data-toggle="modal" data-target="#confirm-delete"><button type='button' class='btn btn-danger' title="Eliminar"><span class="glyphicon glyphicon-remove"></span></button></a>
            </td>
		</tr>
<?php  }	

}?>
    </tbody>
</table>
	<p><center><?=$pagination?></center></p>
