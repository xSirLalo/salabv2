<?php foreach ($resultados->result() as $resultado){ ?>
<?php echo form_open(base_url().'incidencia/actualizar/'.$idIncidencia, 'class="form-horizontal" role="form" id="form"'); ?>
  
  <div class="form-group">
    <label for="asunto" class="col-lg-2 control-label">Asunto</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="asunto" name="asunto" value="<?=$resultado->asunto?>"
             placeholder="Asunto" readonly>
      <?php echo form_error('asunto'); ?>
    </div>
  </div>
  
    <div class="form-group">
    <label for="descripcion" class="col-lg-2 control-label">Descripcion</label>
          <div class="col-lg-10">
            <textarea class="form-control" id='descripcion' name='descripcion' rows="3" style="resize: none;" readonly><?=$resultado->descripcion?></textarea>
            <?php echo form_error('descripcion'); ?>
          </div>          
    </div>

    <div class="form-group">
    <label for="comentario" class="col-lg-2 control-label">Comentario</label>
          <div class="col-lg-10">
            <textarea class="form-control" id='comentario' name='comentario' rows="3" style="resize: none;"><?=$resultado->comentario?></textarea>
            <?php echo form_error('comentario'); ?>
          </div>
    </div>

   <div class="form-group">
      <label for="idEstatus" class="col-lg-2 control-label">Estatus</label>
      <div class="col-lg-10">
          <?php echo "<select name='idEstatus' id='idEstatus' class='form-control'>";
              foreach($estatus as  $row){
                  if(6 == $row->idEstatus){
                  $selected = 'selected'; 
                  }
                  echo '<option value="'.$row->idEstatus.'" '.$selected.'>'.$row->nombre_estatus."</option>";
              }
              echo "</select>"; ?><?php echo form_error('idEstatus'); ?>
      </div>
    </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-warning" title="Actualizar">Actualizar</button>
      <a href="<?php echo base_url(); ?>incidencia" class="btn btn-primary" title="Cancelar">Cancelar</a>
    </div>
  </div>

<?php echo form_close(); ?>
<?php } ?>