<?php echo form_open(base_url().'asignatura/guardar', 'class="form-horizontal" role="form" id="form1"'); ?>

  <div class="form-group">
    <label for="nombre_as" class="col-lg-2 control-label">Nombre de Asignatura</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="nombre_as" name="nombre_as" value="<?php echo set_value('nombre_as'); ?>"
             placeholder="Nombre de Asignatura">
      <?php echo form_error('nombre_as'); ?>
    </div>
  </div>

  <div class="form-group">
    <label for="clave" class="col-lg-2 control-label">Clave</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="clave" name="clave" value="<?php echo set_value('clave'); ?>"
             placeholder="Clave">
      <?php echo form_error('clave'); ?>
    </div>
  </div>

  <div class="form-group">
    <label for="idCarrera" class="col-lg-2 control-label">Carrera</label>
    <div class="col-lg-10">
        <?php echo "<select name='idCarrera' id='idCarrera' class='form-control'>";
          echo "<option value=''>Seleccione una Carrera</option>";
            foreach($carreras as  $row){
                $selectvalue = set_value('idCarrera');
                $selected = "";
                if($selectvalue == $row->idCarrera){
                $selected = 'selected'; 
                }
                echo '<option value="'.$row->idCarrera.'" '.$selected.'>'.$row->nombre_ca."</option>";
            }
            echo "</select>"; ?><?php echo form_error('idCarrera'); ?>
  </div>
  
  </div>
  <div class="form-group">
    <label for="idProfesor" class="col-lg-2 control-label">Profesor</label>
    <div class="col-lg-10">
        <?php echo "<select name='idProfesor' id='idProfesor' class='form-control'>";
          echo "<option value=''>Seleccione un profesor</option>";
            foreach($profesores as  $row){
                $selectvalue = set_value('idProfesor');
                $selected = "";
                if($selectvalue == $row->idProfesor){
                $selected = 'selected'; 
                }
                echo '<option value="'.$row->idProfesor.'" '.$selected.'>'.$row->nombre_pr.' '.$row->aPaterno_pr.' '.$row->aMaterno_pr."</option>";
            }
            echo "</select>"; ?><?php echo form_error('idProfesor'); ?>
  </div>
  </div>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-success" title="Agregar">Agregar</button>
      <a href="<?php echo base_url(); ?>asignatura" class="btn btn-primary" title="Cancelar">Cancelar</a>
    </div>
  </div>

<?php echo form_close(); ?>