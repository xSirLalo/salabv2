<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (isset($this->session->userdata['logged_in'])) {
$idUsuario = ($this->session->userdata['logged_in']['idUsuario']);
} else {
redirect('login');
}
?>
<?php echo form_open(base_url().'incidencia/guardar', 'class="form-horizontal" role="form" id="form"'); ?>
  <div class="form-group">
      <label for="idAula" class="col-lg-2 control-label">Aulas</label>
      <div class="col-lg-10">
          <?php echo "<select name='idAula' id='idAula' class='form-control' onchange='getNewVal(this);'>";
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
    <label for="asunto" class="col-lg-2 control-label">Asunto</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="asunto" name="asunto" value="<?php echo set_value('asunto'); ?>"
             placeholder="Asunto">
      <?php echo form_error('asunto'); ?>
    </div>
  </div>

  <div class="form-group">
  <label for="descripcion" class="col-lg-2 control-label">Descripcion</label>
        <div class="col-lg-10">
          <textarea class="form-control" id='descripcion' name='descripcion' rows="3" style="resize: none;"><?php echo set_value('descripcion'); ?></textarea>
          <?php echo form_error('descripcion'); ?>
        </div>          
  </div>

<!--Este campo solo esta diponible para el adminitrador-->
  <?php  if($this->session->userdata['logged_in']['idTipoUsuario']==1){ ?>
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
  <?php }?>

  <div class="form-group">
    <div class="col-lg-10">
      <input type="hidden" class="form-control" id="idUsuario" name="idUsuario" value="<?php echo $idUsuario ?>"
             placeholder="ID Usuario">
      <?php echo form_error('idUsuario'); ?>
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-success" title="Agregar">Agregar</button>
      <a href="<?php echo base_url(); ?>incidencia" class="btn btn-primary" title="Cancelar">Cancelar</a>
    </div>
  </div>

<?php echo form_close(); ?>