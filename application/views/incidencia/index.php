<div class="container-fluid">
  <div class="row">
        <div class="col-md-6">
            <div class="btn-group btn-group-md">
                <a href="<?php echo base_url(); ?>incidencia/agregar" ><button type='button' class='btn btn-primary' title="Agregar incidencia"><span class="glyphicon glyphicon-pushpin"></span> Agregar incidencia</button></a>
            </div>
        </div>
        <div class="col-md-6 text-right">
            <form action="" class="search-form">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="search" id="search" title="Buscar" placeholder="ID de incidencia">
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
            </form>
        </div>
  </div>
</div>

<table id="card-table" class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>asunto</th>
        <th>fechaAlta</th>
        <th>fechaModificacion</th>
        <th>idEstatus</th>
        <th>Opciones</th>
      </tr>
    </thead>
    <tbody>
<?php if($resultado){
      foreach($resultado->result() as $row){ ?>
        <tr>
            <?php 
            $fechaA = strtotime($row->fechaAlta);
            $fechaM = strtotime($row->fechaModificacion);
            ?>     
            <td><?= $row->idIncidencia; ?></td>
            <td><?= $row->asunto; ?></td>
            <td><?= $FormatoFechaAlta = date("d/F/Y h:i A", $fechaA); ?></td>
            <td><?= $FormatoFechaModificacion = date("d/F/Y h:i A", $fechaM); ?></td>
            <td><?= $row->nombre_estatus; ?></td>
            <td>
            <button class="btn btn-info" onclick="ver(<?php echo $row->idIncidencia;?>)"><i class="glyphicon glyphicon-folder-open"></i></button>
            <a href='<?= base_url().'incidencia/modificar/'.$row->idIncidencia ?>''><button type='button' class='btn btn-default' title="Atender"><span class=" glyphicon glyphicon-edit "></span></button></a>
            <?php  if($row->idEstatus==5){ ?>
              <a href="#" data-href='<?= base_url().'incidencia/eliminar/'.$row->idIncidencia ?>' data-toggle="modal" data-target="#confirm-delete"><button type='button' class='btn btn-primary' title="Finalizar"><span class="glyphicon glyphicon-thumbs-up"></span></button></a>
            <?php }?>
            </td>
		</tr>
<?php  }	

}?>
    </tbody>
</table>
	<p><center><?=$pagination?></center></p>

<script type="text/javascript">
    function ver(id)
    {
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('incidencia/ajax_ver/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="idIncidencia"]').val(data.idIncidencia);
            $('[name="asunto"]').val(data.asunto);
            $('[name="descripcion"]').val(data.descripcion);
            $('[name="idUsuario"]').val(data.idUsuario);
            $('[name="idEstatus"]').val(data.idEstatus);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Incidencia'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }
</script>

<!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Incidencia</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="book_id"/>
          <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3">ID Incidencia</label>
                <div class="col-md-9">
                    <input id="idIncidencia" name="idIncidencia" placeholder="ID Incidencia" class="form-control" type="text" readonly="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Asunto</label>
              <div class="col-md-9">
                    <input name="asunto" placeholder="Asunto" class="form-control" type="text" readonly="">
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Descripcion</label>
                <div class="col-md-9">
                    <textarea class="form-control" name='descripcion' rows="3" readonly="" style="resize: none;"><?php echo set_value('descripcion'); ?></textarea>
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">IdEstatus</label>
                <div class="col-md-9">
                    <input name="idEstatus" placeholder="ID Estatus" class="form-control" type="text" readonly="">

                </div>
            </div>
          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
