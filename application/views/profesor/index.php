<div class="container-fluid">
  <div class="row">
        <div class="col-md-6">
            <div class="btn-group btn-group-md">
                <a href="<?php echo base_url(); ?>profesor/agregar" ><button type='button' class='btn btn-success' title="Agregar profesor"><span class="glyphicon glyphicon-plus"></span> Agregar profesor</button></a>
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
        <th>idProfesor</th>
        <th>nombre_pr</th>
        <th>aPaterno_pr</th>
        <th>aMaterno_pr</th>
        <th>Opciones</th>
      </tr>
    </thead>
    <tbody>
<?php if($resultado){
      foreach($resultado->result() as $row){ ?>
        <tr>
            <td><?= $row->idProfesor; ?></td>
            <td><?= $row->nombre_pr; ?></td>
            <td><?= $row->aPaterno_pr; ?></td>
            <td><?= $row->aMaterno_pr; ?></td>
            <td>
            <a href='<?= base_url().'profesor/modificar/'.$row->idProfesor ?>'><button type='button' class='btn btn-warning' title="Modificar"><span class="glyphicon glyphicon-pencil"></span></button></a>
            <a href="#" data-href='<?= base_url().'profesor/eliminar/'.$row->idProfesor ?>' data-toggle="modal" data-target="#confirm-delete"><button type='button' class='btn btn-danger' title="Eliminar"><span class="glyphicon glyphicon-remove"></span></button></a>
            </td>
		</tr>
<?php  }	

}?>
    </tbody>
</table>
	<p><center><?=$pagination?></center></p>