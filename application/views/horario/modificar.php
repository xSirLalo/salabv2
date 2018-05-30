<?php foreach ($resultados->result() as $resultado){ ?>
<?php echo form_open(base_url().'horario/actualizar/'.$idHorario, 'class="form-horizontal" role="form" id="form1"'); ?>
<div class="container">
    <div class="form-group">
    <label for="horaInicio" class="col-lg-2 control-label">Hora Inicial</label>
        <div class='input-group date' id='datetimepicker3'>
          <div class="col-lg-10">
            <input type='text' class="form-control" id='horaInicio' name='horaInicio' value="<?=$resultado->horaInicio?>" />
            <?php echo form_error('horaInicio'); ?>
          </div>
        </div>
    </div>

    <div class="form-group">
    <label for="horaFin" class="col-lg-2 control-label">Hora Final</label>
        <div class='input-group date' id='datetimepicker3'>
          <div class="col-lg-10">
            <input type='text' class="form-control" id='horaFin' name='horaFin' value="<?=$resultado->horaFin?>" />
            <?php echo form_error('horaFin'); ?>
          </div>
        </div>
    </div>

<?php $temp=explode(', ',$resultado->dia); ?>
<?php //print_r($temp); ?>
    <div class="form-group">
        <label for="dia" class="col-lg-2 control-label">Dia</label>
        <div class="col-lg-10">
          <?php 
          $dias=array('LUNES','MARTES','MIERCOLES','JUEVES','VIERNES');
          foreach($dias as $dia)echo '<label class="checkbox-inline">
                <input type="checkbox" name="dia[]" value="'.$dia.'" '.(in_array($dia,$temp)?'checked="checked"':'').' >'.$dia.'</label>';
             ?><?php echo form_error('dia[]'); ?>
        </div>
    </div>

  <div class="form-group">
    <label for="idAula" class="col-lg-2 control-label">Aula</label>
      <div class="col-lg-10">
              <?php echo "<select name='idAula' id='idAula' class='form-control'>";
                  foreach($aulas as $row){
                      $selectvalue = $resultado->idAula;
                      $selected = "";
                      if($selectvalue==$row->idAula){
                      $selected = 'selected';
                      }
                      echo '<option value="'.$row->idAula.'" '.$selected.'>'.$row->nombre_au."</option>";
                  }
                  echo "</select>"; ?>
        </div>
  </div>

  <div class="form-group">
    <label for="idAsignatura" class="col-lg-2 control-label">Asignatura</label>
      <div class="col-lg-10">
              <?php echo "<select name='idAsignatura' id='idAsignatura' class='form-control'>";
                  foreach($asignaturas as  $row){
                      $selectvalue = $resultado->idAsignatura;
                      $selected = "";
                      if($selectvalue==$row->idAsignatura){
                      $selected = 'selected'; 
                      }
                      echo '<option value="'.$row->idAsignatura.'" '.$selected.'>'.$row->nombre_as."</option>";
                  }
                  echo "</select>"; ?>
        </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-warning" title="Actualizar">Actualizar</button>
      <a href="<?php echo base_url(); ?>horario" class="btn btn-primary" title="Cancelar">Cancelar</a>
    </div>
  </div>
</div>
<?php echo form_close(); ?>
<?php } ?>

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

