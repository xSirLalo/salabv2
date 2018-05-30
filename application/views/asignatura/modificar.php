<?php foreach ($resultados->result() as $resultado){ ?>
<?php echo form_open(base_url().'asignatura/actualizar/'.$idAsignatura, 'class="form-horizontal" role="form" id="form1"'); ?>

  <div class="form-group">
    <label for="clave" class="col-lg-2 control-label">Clave</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="clave" name="clave" value="<?=$resultado->clave?>" 
             placeholder="Apellido Paterno">
      <?php echo form_error('clave'); ?>
    </div>
  </div>

  <div class="form-group">
    <label for="nombre_as" class="col-lg-2 control-label">Nombre de asignatura</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="nombre_pr" name="nombre_as" value="<?=$resultado->nombre_as?>" 
             placeholder="Nombre de asignatura">
      <?php echo form_error('nombre_as'); ?>
    </div>
  </div>

  <div class="form-group">
  <label for="idCarrera" class="col-lg-2 control-label">Carrera</label>
  <div class="col-lg-10">
          <?php echo "<select name='idCarrera' id='idCarrera' class='form-control'>";
              foreach($carreras as  $row){
                  $selectvalue = $resultado->idCarrera;
                  $selected = "";
                  if($selectvalue==$row->idCarrera){
                  $selected = 'selected'; 
                  }
                  echo '<option value="'.$row->idCarrera.'" '.$selected.'>' . $row->nombre_ca . "</option>";
              }
              echo "</select>"; ?>
    </div>
    </div>

  <div class="form-group">
  <label for="idProfesor" class="col-lg-2 control-label">Profesor</label>
  <div class="col-lg-10">
          <?php echo "<select name='idProfesor' id='idProfesor' class='form-control'>";
              foreach($profesores as  $row){
                  $selectvalue = $resultado->idProfesor;
                  $selected = "";
                  if($selectvalue==$row->idProfesor){
                  $selected = 'selected'; 
                  }
                  echo '<option value="'.$row->idProfesor.'" '.$selected.'>'.$row->nombre_pr.' '.$row->aPaterno_pr.' '.$row->aMaterno_pr."</option>";
              }
              echo "</select>"; ?>
    </div>
    </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-warning" title="Actualizar">Actualizar</button>
      <a href="<?php echo base_url(); ?>asignatura" class="btn btn-primary" title="Cancelar">Cancelar</a>
    </div>
  </div>

<?php echo form_close(); ?>
<?php } ?>