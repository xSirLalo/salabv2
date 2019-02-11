<?php foreach ($resultados->result() as $resultado){ ?>
<?php echo form_open(base_url().'controllab/sesion_iniciada/', 'class="form-horizontal" role="form" id="form"'); ?>
  <div class="form-group">
    <label for="noControl" class="col-lg-2 control-label">Alumno</label>
      <div class="col-lg-10">
          <input type="text" class="form-control" id="noControl" name='noControl' value="<?php echo $resultado->noControl; ?>" placeholder="Número de Control" autofocus required readonly>
    </div>
  </div>
  <div class="form-group"> <!--Inicio Grupo de Botones-->
    <div class="col-lg-offset-2 col-lg-12">
      <button type="submit" class="btn btn-danger" title="Terminar Uso">Terminar Sesion</button>
    </div>
  </div><!--Fin Grupo de Botones-->
<?php echo form_close(); ?>

<?php echo form_open(base_url().'controllab/actualizar/'.$idControlLab, 'class="form-horizontal" role="form" id="form"'); ?>

  <div class="form-group">
    <label for="idControlLab" class="col-lg-2 control-label">idControlLab</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="idControlLab" name="idControlLab" value="<?=$resultado->idControlLab?>" readonly>
      <?php echo form_error('idControlLab'); ?>
    </div>
  </div>

  <div class="form-group">
    <label for="OldComputer" class="col-lg-2 control-label">Computadora Actual</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" value="<?=$resultado->comp_numero?>" placeholder="Computadora Actual" readonly>
             <!--Oculto el Campo que muestra el ID de la computadora Actual-->
      <input type="hidden" id="OldComputer" name="OldComputer" value="<?=$resultado->comp_numero?>">
      <?php echo form_error('OldComputer'); ?>
    </div>
  </div>

  <div class="form-group">
    <label for="NewComputer" class="col-lg-2 control-label">Cambiar a la</label>
    <div class="col-lg-10">
        <?php echo "<select name='NewComputer' id='NewComputer' class='form-control'>";
            foreach($Computadoras as  $row){
                $selectvalue = $resultado->comp_numero;
                $selected = "";
                if($selectvalue == $row->comp_numero){
                $selected = 'selected'; 
                }
                echo '<option value="'.$row->comp_numero.'" '.$selected.'>'.$row->comp_numero."</option>";
            }
            echo "</select>"; ?><?php echo form_error('NewComputer'); ?>
  </div>
  </div>

  <div class="form-group"> <!--Inicio Grupo de Botones-->
    <div class="col-lg-offset-2 col-lg-12">
      <button type="submit" class="btn btn-warning" title="Cambiar">Cambiar de Equipo</button>
      <a href="<?php echo base_url(); ?>controllab" class="btn btn-primary" title="Volver a Inicio">Volver</a>
    </div>
  </div><!--Fin Grupo de Botones-->
<?php echo form_close(); ?>
<?php } ?>
