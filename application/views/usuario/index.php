<div class="container-fluid">
  <div class="row">
        <div class="col-md-6">
            <div class="btn-group btn-group-md">
                <a href="<?php echo base_url(); ?>usuario/agregar" ><button type='button' class='btn btn-success' title="Agregar usuario"><span class="glyphicon glyphicon-plus"></span> Agregar usuario</button></a>
            </div>
        </div>
        <div class="col-md-6 text-right">
            <form action="" class="search-form">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="search" id="search" title="Buscar" placeholder="Usuario">
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
            </form>
        </div>
  </div>
</div>

<table id="card-table" class="table table-striped">
    <thead>
      <tr>
        <th>idUsuario</th>
        <th>nombre_al</th>
        <th>aPaterno_al</th>
        <th>aMaterno_al</th>
		<th>email</th>
        <th>telefono</th>
        <th>fechaCreacion</th>
        <th>estatus</th>
        <th>Opciones</th>
      </tr>
    </thead>
    <tbody>
<?php if($resultado){
      foreach($resultado->result() as $row){ ?>
        <tr>
            <?php 
            $fechaC = strtotime($row->fechaCreacion);
            ?>
            <td><?= $row->idUsuario; ?></td>
            <td><?= $row->nombre_usr; ?></td>
            <td><?= $row->aPaterno_usr; ?></td>
            <td><?= $row->aMaterno_usr; ?></td>
            <td><?= $row->email; ?></td>
            <td><?= $row->telefono; ?></td>
            <td><?= $FormatoFechaCreacion = date("d/F/Y", $fechaC); ?></td>
            <td><?= $row->idEstatus; ?></td>
            <td>
            <a href='<?= base_url().'usuario/modificar/'.$row->idUsuario ?>'><button type='button' class='btn btn-warning' title="Modificar"><span class="glyphicon glyphicon-pencil"></span></button></a>
            <a href="#" data-href='<?= base_url().'usuario/eliminar/'.$row->idUsuario ?>' data-toggle="modal" data-target="#confirm-delete"><button type='button' class='btn btn-danger' title="Eliminar"><span class="glyphicon glyphicon-remove"></span></button></a>
            </td>
		</tr>
<?php  }	

}?>
    </tbody>
</table>
	<p><center><?=$pagination?></center></p>