<?php echo form_open(base_url().'horario/guardar', 'class="form-horizontal" role="form" id="form1"'); ?>

    <div class="form-group">
    <label for="horaInicio" class="col-lg-2 control-label">Hora Inicial</label>
        <div class='input-group date' id='datetimepicker3'>
          <div class="col-lg-10">
            <input type='text' class="form-control" id='horaInicio' name='horaInicio' value="<?php echo set_value('horaInicio'); ?>"
            />
            <?php echo form_error('horaInicio'); ?>
          </div>
        </div>
    </div>

    <div class="form-group">
    <label for="horaFin" class="col-lg-2 control-label">Hora Final</label>
        <div class='input-group date' id='datetimepicker3'>
          <div class="col-lg-10">
            <input type='text' class="form-control" id='horaFin' name='horaFin' value="<?php echo set_value('horaFin'); ?>"
            />
            <?php echo form_error('horaFin'); ?>
          </div>
        </div>
    </div>

    <div class="form-group">
        <label for="dia" class="col-lg-2 control-label">Dia</label>
        <div class="col-lg-10">
          <?php
          $dias=array('LUNES','MARTES','MIERCOLES','JUEVES','VIERNES');
          foreach($dias as $dia)echo '<label class="checkbox-inline">
                <input type="checkbox" name="dia[]" value="'.$dia.'" '.(set_checkbox('dia[]', $dia)).' >'.$dia.'</label>';
          ?><?php echo form_error('dia[]'); ?>
        </div>
    </div>

  <div class="form-group">
    <label for="idAula" class="col-lg-2 control-label">Aulas</label>
    <div class="col-lg-10">
        <?php echo "<select name='idAula' id='idAula' class='form-control'>";
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
    <label for="idAsignatura" class="col-lg-2 control-label">Asignatura</label>
    <div class="col-lg-10">
        <?php echo "<select name='idAsignatura' id='idAsignatura' class='form-control'>";
          echo "<option value=''>Seleccione una asignatura</option>";
            foreach($asignaturas as  $row){
                $selectvalue = set_value('idAsignatura');
                $selected = "";
                if($selectvalue == $row->idAsignatura){
                $selected = 'selected';
                }
                echo '<option value="'.$row->idAsignatura.'" '.$selected.'>'.$row->nombre_as."</option>";
            }
            echo "</select>"; ?><?php echo form_error('idAsignatura'); ?>
  </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-success" title="Agregar">Agregar</button>
      <a href="<?php echo base_url(); ?>horario" class="btn btn-primary" title="Cancelar">Cancelar</a>
    </div>
  </div>

<?php echo form_close(); ?>

<script type="text/javascript">
    $(function () {
        $('#horaInicio').datetimepicker({
            format: 'H:mm',

        });
        $('#horaFin').datetimepicker({
            format: 'H:mm'
        });
    });
</script>