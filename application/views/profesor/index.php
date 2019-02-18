<div class="container-fluid">
  <div class="row">
        <div class="col-md-6">
            <div class="btn-group btn-group-md">
                <a href="<?php echo base_url(); ?>profesor/agregar" ><button type='button' class='btn btn-primary' title="Agregar profesor"><span class="glyphicon glyphicon-plus"></span> Agregar profesor</button></a>
            </div>
        </div>
        <div class="col-md-6 text-right">
            <form action="" class="search-form">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="search" id="search" title="Buscar" placeholder="Nombre o Apellido">
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
            </form>
        </div>
  </div>
</div>

<table id="card-table" class="table table-striped">
    <thead>
      <tr>
        <th>NOMBRE</th>
        <th>APELLIDO PATERNO</th>
        <th>APELLIDO MATERNO</th>
        <th>OPCIONES</th>
      </tr>
    </thead>
    <tbody>
<?php if($resultado){
      foreach($resultado->result() as $row){ ?>
        <tr>
            <td><?= $row->nombre_pr; ?></td>
            <td><?= $row->aPaterno_pr; ?></td>
            <td><?= $row->aMaterno_pr; ?></td>
            <td>
                <div class="btn-group">
                <a href="<?= base_url().'profesor/modificar/'.$row->idProfesor ?>" class='btn btn-warning' title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="#" data-href='<?= base_url().'profesor/eliminar/'.$row->idProfesor ?>' data-toggle="modal" data-target="#confirm-delete" class='btn btn-danger' title="Eliminar"><i class="glyphicon glyphicon-remove"></i></a>
                </div>
            </td>
		</tr>
<?php  }	

}?>
    </tbody>
</table>
	<p><center><?=$pagination?></center></p>