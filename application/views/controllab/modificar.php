<?php foreach ($resultados->result() as $resultado){ ?>
<?php echo form_open(base_url().'controllab/actualizar/'.$idControlLab, 'class="form-horizontal" role="form" id="form"'); ?>

  <div class="form-group">
    <label for="OldComputer" class="col-lg-2 control-label">Computadora Actual</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" value="<?=$resultado->comentarios?>"
             placeholder="Computadora Actual" readonly>
             <!--Oculto el Campo que muestra el ID de la computadora Actual-->
      <input type="hidden" id="OldComputer" name="OldComputer" value="<?=$resultado->idComputadora?>">
      <?php echo form_error('OldComputer'); ?>
    </div>
  </div>

  <div class="form-group">
    <label for="NewComputer" class="col-lg-2 control-label">Cambiar a</label>
    <div class="col-lg-10">
        <?php echo "<select name='NewComputer' id='NewComputer' class='form-control'>";
            foreach($Computadoras as  $row){
                $selectvalue = $resultado->idComputadora;
                $selected = "";
                if($selectvalue == $row->idComputadora){
                $selected = 'selected'; 
                }
                echo '<option value="'.$row->idComputadora.'" '.$selected.'>'.$row->comentarios."</option>";
            }
            echo "</select>"; ?><?php echo form_error('NewComputer'); ?>
  </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-warning" title="Cambiar">Cambiar de Equipo</button>
      <a href="<?php echo base_url(); ?>controllab" class="btn btn-primary" title="Cancelar">Cancelar</a>
    </div>
  </div>

<?php echo form_close(); ?>
<?php } ?>
