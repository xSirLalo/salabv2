<?php echo form_open(base_url().'usuario/guardar', 'class="form-horizontal" role="form" id="form"'); ?>

  <div class="form-group">
    <label for="nombre_usr" class="col-lg-2 control-label">Nombre</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="nombre_usr" name="nombre_usr" value="<?php echo set_value('nombre_usr'); ?>"
             placeholder="Nombre">
      <?php echo form_error('nombre_usr'); ?>
    </div>
  </div>

  <div class="form-group">
    <label for="aPaterno_usr" class="col-lg-2 control-label">Apellido Paterno</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="aPaterno_usr" name="aPaterno_usr" value="<?php echo set_value('aPaterno_usr'); ?>"
             placeholder="Apellido Paterno">
      <?php echo form_error('aPaterno_usr'); ?>
    </div>
  </div>

  <div class="form-group">
    <label for="aMaterno_usr" class="col-lg-2 control-label">Apellido Materno</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="aMaterno_usr" name="aMaterno_usr" value="<?php echo set_value('aMaterno_usr'); ?>"
             placeholder="Apellido Paterno">
      <?php echo form_error('aMaterno_usr'); ?>
    </div>
  </div>

<div class="form-group">
    <label for="password" class="col-lg-2 control-label">Correo electronico</label>
      <div class="col-lg-10">
    <div class="form-group col-md-5">
      <input type="text" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>"
             placeholder="Correo electronico">
      <?php echo form_error('email');?>
    </div>
    <div class="form-group col-md-5">
      <input type="text" class="form-control" id="emailconf" name="emailconf" value="<?php echo set_value('emailconf'); ?>"
             placeholder="Repetir Correo electronico">
      <?php echo form_error('emailconf');?>
    </div>
      </div>
</div>

<div class="form-group">
    <label for="password" class="col-lg-2 control-label">Contraseña</label>
      <div class="col-lg-10">
    <div class="form-group col-md-5">
      <input type="password" class="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>"
                   placeholder="Contraseña">
      <?php echo form_error('password'); ?>
    </div>

    <div class="form-group col-lg-5">
      <input type="password" class="form-control" id="passwordconf" name="passwordconf" value="<?php echo set_value('passwordconf'); ?>"
                   placeholder="Repetir Contraseña">
     <?php echo form_error('passwordconf'); ?>
    </div>
      </div>
</div>

  <div class="form-group">
    <label for="telefono" class="col-lg-2 control-label">Telefono</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo set_value('telefono'); ?>"
             placeholder="Telefono">
      <?php echo form_error('telefono'); ?>
    </div>
  </div>

  <div class="form-group">
    <label for="idTipoUsuario" class="col-lg-2 control-label">Tipo de Usuario</label>
    <div class="col-lg-10">
        <?php echo "<select name='idTipoUsuario' id='idTipoUsuario' class='form-control'>";
            foreach($tipoUsuario as  $row){
                $selectvalue = set_value('idTipoUsuario');
                $selected = "";
                if($selectvalue == $row->idTipoUsuario){
                $selected = 'selected'; 
                }
                echo '<option value="'.$row->idTipoUsuario.'" '.$selected.'>'.$row->nombre_tipusr."</option>";
            }
            echo "</select>"; ?><?php echo form_error('idTipoUsuario'); ?>
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
      <a href="<?php echo base_url(); ?>usuario" class="btn btn-primary" title="Cancelar">Cancelar</a>
    </div>
  </div>

<?php echo form_close(); ?>