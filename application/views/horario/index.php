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
                    echo "<button type='submit' class='btn btn-default' title='Filtrar'><span class='glyphicon glyphicon-search'></span></button>";
            echo form_close();?>
        </div>
    </div>
  </div>
</div>
<br>
<table id="card-table" class="table table-hover table-bordered">
    <thead>
      <tr>
        <th class="text-center">AULA</th>
        <th class="text-center">HORA</th>
        <th class="text-center">LUNES</th>
        <th class="text-center">MARTES</th>
        <th class="text-center">MIERCOLES</th>
        <th class="text-center">JUEVES</th>
        <th class="text-center">VIERNES</th>
      </tr>
    </thead>
    <tbody>
        <?php if($resultado){
            for ($i=07; $i <= 22; $i++) {
                $i = str_pad($i, 2, '0', STR_PAD_LEFT);
                foreach($resultado->result() as $row){
                    $temp=explode(', ',$row->dia);
                    $dias=array('LUNES','MARTES','MIERCOLES','JUEVES','VIERNES');
                    echo ($row->idAula==2)?'<tr class="active">':'';
                    echo ($row->idAula==3)?'<tr class="success">':'';
                    echo ($row->idAula==4)?'<tr class="warning">':'';
                    echo ($row->idAula==5)?'<tr class="danger">':'';
                    echo ($row->idAula==6)?'<tr class="info">':'';
                    //foreach($dias as $dia)
                    $horaI = strtotime($row->horaInicio);
                    $horaF = strtotime($row->horaFin);
                        if(date("H:i", $horaI)==$i.":00"){
                            echo '<td class="text-center"><small><a href="#" onclick="ver('.$row->idAula.')" >'.$row->nombre_au.'<a></small></td>';
                            echo '<td  class="text-center">';
                            echo $FormatoHoraInicio = date("H:i", $horaI).' - '.$FormatoHoraFin = date("H:i", $horaF);
                            echo '</td>';
                            //echo date("H:i", $horaI)==$i.":00"? '<td>'.$FormatoHoraInicio.'</td>':'<td></td>';
                            foreach($dias as $dia)
                            echo in_array($dia,$temp)?'<td class="text-center"><small><a href="'.base_url().'horario/modificar/'.$row->idHorario.'">'.$row->nombre_as.'</a></small></td>':'<td class="text-center text-primary"><b></b></td>';
                        }
                    echo '</tr> ';
                }
            }
         }?>
    </tbody>
</table>
<style type="text/css">
    
@media print {
    /* on modal open bootstrap adds class "modal-open" to body, so you can handle that case and hide body */
    body.modal-open {
        visibility: hidden;
    }

    body.modal-open .modal .modal-lg .modal-header,
    body.modal-open .modal .modal-lg .modal-body {
        visibility: visible; /* make visible modal body and header */
        position:absolute;
        left:0;
        top:0;
        width: 100%;
        height: 100%;
    }
}

</style>
<script type="text/javascript">
    function ver(id)
    {
      $('#form')[0].reset(); // reset form on modals
      dias = [];
      dias[0] = 'LUNES';
      dias[1] = 'MARTES';
      dias[2] = 'MIERCOLES';
      dias[3] = 'JUEVES';
      dias[4] = 'VIERNES';
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('horario/ajax_ver/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(datos)
        {
            if (datos == null)
             { alert('Error');} 
             else {
            var fila =''
            $.each(datos,function(index) {
                var diasDB = datos[index].dia;
                var arr = diasDB.split(', ');

                fila += '<tr><td width="15%" class="text-center">'+datos[index].HI+' - '+datos[index].HF+'</td>';
                for (var i = 0; i < dias.length; i++) {
                    if($.inArray(dias[i], arr) > -1)
                    {
                        //alert(dias[i]);
                        fila += '<td width="17%" class="active text-center"><small>'+datos[index].nombre_as+'</small></td>';
                    }else{
                        fila += '<td width="17%" class="text-center"></td>';
                    }
                }
                fila += '</td></tr>';

                // Set title to Bootstrap modal title
                $('.modal-title').text('Horario del '+datos[index].nombre_au);
            });
            $('#tbodyProducto').html(fila);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
                   alert('Error get data from ajax: ' + errorThrown);
                   alert('Error get data from ajax: ' + textStatus);
                   alert('Error get data from ajax: ' + jqXHR);
        }
    });
    }
</script>

<!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Horario</h3>
      </div>
      <div class="modal-body modal-lg form">
            <form action="#" id="form">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center">HORA</th>
                        <th class="text-center">LUNES</th>
                        <th class="text-center">MARTES</th>
                        <th class="text-center">MIERCOLES</th>
                        <th class="text-center">JUEVES</th>
                        <th class="text-center">VIERNES</th>
                      </tr>
                    </thead>
                    <tbody id="tbodyProducto">
                    </tbody>
                </table>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" onclick="js:window.print()">print modal content</button>
            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->