<?php echo form_open(base_url().'dispositivo/guardar', 'class="form-horizontal" role="form" id="form"'); ?>
    <div class="form-group">
    <label for="fabricante" class="col-lg-2 control-label">Fabricante</label>
          <div class="col-lg-10">
            <input type='text' class="form-control" id='fabricante' name='fabricante' value="<?php echo set_value('fabricante'); ?>"
            />
            <?php echo form_error('fabricante'); ?>
          </div>          
    </div>

    <div class="form-group">
    <label for="modelo" class="col-lg-2 control-label">Modelo</label>
          <div class="col-lg-10">
            <input type='text' class="form-control" id='modelo' name='modelo' value="<?php echo set_value('modelo'); ?>"
            />
            <?php echo form_error('modelo'); ?>
          </div>          
    </div>


    <div class="form-group">
    <label for="numeroSerie" class="col-lg-2 control-label">Numero de Serie</label>
          <div class="col-lg-10">
            <input type='text' class="form-control" id='numeroSerie' name='numeroSerie' value="<?php echo set_value('numeroSerie'); ?>"
            />
            <?php echo form_error('numeroSerie'); ?>
          </div>          
    </div>

  <div class="form-group">
    <label for="idTipoDispositivo" class="col-lg-2 control-label">Tipo dispositivo</label>
    <div class="col-lg-10">
        <?php echo "<select name='idTipoDispositivo' id='idTipoDispositivo' class='form-control'>";
          echo "<option value=''>Seleccione un tipo de dispositivo</option>";
            foreach($tipoDispositivo as  $row){
                $selectvalue = set_value('idTipoDispositivo');
                $selected = "";
                if($selectvalue == $row->idTipoDispositivo){
                $selected = 'selected'; 
                }
                echo '<option value="'.$row->idTipoDispositivo.'" '.$selected.'>'.$row->nombre_tipdis."</option>";
            }
            echo "</select>"; ?><?php echo form_error('idTipoDispositivo'); ?>
  </div>
  </div>

    <div class="form-group">
    <label for="fechaIngreso" class="col-lg-2 control-label">Fecha de Ingreso</label>
        <div class='input-group date' id='datetimepicker3'>
          <div class="col-lg-10">
            <input type='text' class="form-control" id='fechaIngreso' name='fechaIngreso' value="<?php echo set_value('fechaIngreso'); ?>"
            />
           <script type="text/javascript">
                $(function () {
                    $('#fechaIngreso').datetimepicker({
                          format: 'YYYY-MM-DD'
                    });
                });
            </script>
            <?php echo form_error('fechaIngreso'); ?>
          </div>          
        </div>
    </div>

    <div class="form-group">
    <label for="comentarios" class="col-lg-2 control-label">Comentarios</label>
          <div class="col-lg-10">
            <textarea class="form-control" id='comentarios' name='comentarios' rows="3"><?php echo set_value('comentarios'); ?></textarea>
            <?php echo form_error('comentarios'); ?>
          </div>          
    </div>
<div class="form-group">
    <label for="idAula" class="col-lg-2 control-label">Aulas</label>
    <div class="col-lg-10">
        <?php echo "<select name='idAula' id='idAula' class='form-control' onchange='getNewVal(this);'>";
          echo "<option value=''>Seleccione una Aula</option>";
            foreach($aulas as  $row){
                $selectvalue = set_value('idAula');
                $selected = "";
                if($selectvalue == $row->idAula){
                $selected = 'selected';
                }
                echo '<option value="'.$row->idAula.'" '.$selected.'>'.$row->nombre_au."</option>";
            }
            echo "</select>"; ?><?php echo form_error('idAula'); ?>
  </div>
</div>
<div class="form-group">
    <label for="idEstatus" class="col-lg-2 control-label">Estatus</label>
    <div class="col-lg-10">
        <?php echo "<select name='idEstatus' id='idEstatus' class='form-control'>";
            foreach($estatus as  $row){
                $selectvalue = set_value('idEstatus');
                $selected = "";
                if($selectvalue == $row->idEstatus){
                $selected = 'selected'; 
                }
                echo '<option value="'.$row->idEstatus.'" '.$selected.'>'.$row->nombre_estatus."</option>";
            }
            echo "</select>"; ?><?php echo form_error('idEstatus'); ?>
  </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-success" title="Agregar">Agregar</button>
      <a href="<?php echo base_url(); ?>dispositivo" class="btn btn-primary" title="Cancelar">Cancelar</a>
    </div>
  </div>

<?php echo form_close(); ?>

