<?php foreach ($resultados->result() as $resultado){ ?>
<?php echo form_open(base_url().'usuario/actualizar/'.$idUsuario, 'class="form-horizontal" role="form" id="form"'); ?>

  <div class="form-group">
    <label for="nombre_usr" class="col-lg-2 control-label">Nombre</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="nombre_usr" name="nombre_usr" value="<?=$resultado->nombre_usr?>"
             placeholder="Nombre">
      <?php echo form_error('nombre_usr'); ?>
    </div>
  </div>

  <div class="form-group">
    <label for="aPaterno_usr" class="col-lg-2 control-label">Apellido Paterno</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="aPaterno_usr" name="aPaterno_usr" value="<?=$resultado->aPaterno_usr?>"
             placeholder="Apellido Paterno">
      <?php echo form_error('aPaterno_usr'); ?>
    </div>
  </div>

  <div class="form-group">
    <label for="aMaterno_usr" class="col-lg-2 control-label">Apellido Materno</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="aMaterno_usr" name="aMaterno_usr" value="<?=$resultado->aMaterno_usr?>"
             placeholder="Apellido Paterno">
      <?php echo form_error('aMaterno_usr'); ?>
    </div>
  </div>

<div class="form-group">
    <label for="email" class="col-lg-2 control-label">Correo electronico</label>
      <div class="col-lg-10">
    <div class="col-md-6">
      <input type="text" class="form-control" id="email" name="email" value="<?=$resultado->email?>"
             placeholder="Correo electronico">
      <?php echo form_error('email');?>
    </div>
    <div class="col-md-6">
      <input type="text" class="form-control" id="emailconf" name="emailconf" value="<?=$resultado->email?>"
             placeholder="Repetir Correo electronico">
      <?php echo form_error('emailconf');?>
    </div>
      </div>
</div>

  <div class="form-group">
    <label for="telefono" class="col-lg-2 control-label">Telefono</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="telefono" name="telefono" value="<?=$resultado->telefono?>"
             placeholder="Telefono">
      <?php echo form_error('telefono'); ?>
    </div>
  </div>

  <div class="form-group">
    <label for="reset_field" class="col-lg-2 control-label"></label>
    <div class="col-lg-10">
        <input type="checkbox" id="reset_field" name="reset_field" onchange="res()">
        <span style="visibility: hidden;" id="div_conf"></span>
        <label class="form-check-label" for="inlineCheckbox1">Reiniciar Contraseña</label>
    </div>
  </div>

    <span id="group_ncontrasena" style="display: none;">
       <div class="form-group">
        <label for="password" class="col-lg-2 control-label">Nueva Contraseña</label>
          <div class="col-lg-10">
        <div class="form-group col-md-5">
          <input type="password" data-toggle="tooltip" data-trigger="manual" data-title="Caps lock is on" class="form-control" id="password" name="password" value=""
                       placeholder="Contraseña">
          <?php echo form_error('password'); ?>
        </div>
        <div class="form-group col-lg-5">
          <input type="password" data-toggle="tooltip" data-trigger="manual" data-title="Caps lock is on" class="form-control" id="passwordconf" name="passwordconf" value=""
                       placeholder="Repetir Contraseña">
         <?php echo form_error('passwordconf'); ?>
        </div>
          </div>
    </div>
    </span>

<?php if ($this->session->userdata['logged_in']['idUsuario'] == 1) { ?>
  <div class="form-group">
    <label for="idTipoUsuario" class="col-lg-2 control-label">Tipo de Usuario</label>
    <div class="col-lg-10">
        <?php echo "<select name='idTipoUsuario' id='idTipoUsuario' class='form-control'>";
            foreach($tipoUsuario as  $row){
                $selectvalue = $resultado->idTipoUsuario;
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
                $selectvalue = $resultado->idEstatus;
                $selected = "";
                if($selectvalue == $row->idEstatus){
                $selected = 'selected'; 
                }
                echo '<option value="'.$row->idEstatus.'" '.$selected.'>'.$row->nombre_estatus."</option>";
            }
            echo "</select>"; ?><?php echo form_error('idEstatus'); ?>
      </div>
  </div>
  <?php } ?>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-warning" title="Actualizar">Actualizar</button>
      <a href="<?php echo base_url(); ?>" class="btn btn-primary" title="Cancelar">Cancelar</a>
    </div>
  </div>

<?php echo form_close(); ?>
<?php } ?>

<script type="text/javascript">
    function res()
    {
        var st = document.getElementById('reset_field').checked;
        var conf = document.getElementById("div_conf");
        var ncon = document.getElementById("group_ncontrasena");

        if(st)
        {   console.log(st);
            conf.style.visibility='visible';
            ncon.style.display='block';
        }
        else {
            conf.style.visibility='hidden';
            ncon.style.display='none';
        }
    }
</script>