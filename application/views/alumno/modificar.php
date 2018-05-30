<?php foreach ($resultados->result() as $resultado){ ?>
<?php echo form_open(base_url().'alumno/actualizar/'.$noControl, 'class="form-horizontal" role="form" id="form"'); ?>

  <div class="form-group">
    <label for="noControl" class="col-lg-2 control-label">Numero de control</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="noControl" name="noControl" value="<?=$resultado->noControl?>"
             placeholder="Numero de control">
      <?php echo form_error('noControl'); ?>
    </div>
  </div>

  <div class="form-group">
    <label for="nombre_al" class="col-lg-2 control-label">Nombre</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="nombre_al" name="nombre_al" value="<?=$resultado->nombre_al?>"
             placeholder="Nombre">
      <?php echo form_error('nombre_al'); ?>
    </div>
  </div>

  <div class="form-group">
    <label for="aPaterno_al" class="col-lg-2 control-label">Apellido Paterno</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="aPaterno_al" name="aPaterno_al" value="<?=$resultado->aPaterno_al?>"
             placeholder="Apellido Paterno">
      <?php echo form_error('aPaterno_al'); ?>
    </div>
  </div>

  <div class="form-group">
    <label for="aMaterno_al" class="col-lg-2 control-label">Apellido Materno</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="aMaterno_al" name="aMaterno_al" value="<?=$resultado->aMaterno_al?>"
             placeholder="Apellido Paterno">
      <?php echo form_error('aMaterno_al'); ?>
    </div>
  </div>

  <div class="form-group">
    <label for="idCarrera" class="col-lg-2 control-label">Carrera</label>
    <div class="col-lg-10">
        <?php echo "<select name='idCarrera' id='idCarrera' class='form-control'>";
          echo "<option value=''>Seleccione una Carrera</option>";
            foreach($carreras as  $row){
                $selectvalue =  $resultado->idCarrera;
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
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-warning" title="Actualizar">Actualizar</button>
      <a href="<?php echo base_url(); ?>alumno" class="btn btn-primary" title="Cancelar">Cancelar</a>
    </div>
  </div>

<?php echo form_close(); ?>
<?php } ?>