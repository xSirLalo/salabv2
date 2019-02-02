<script type="text/javascript">
    function getNewVal(item)
    {
      var ncon = document.getElementById("group_control");
      if (item.value==1) {
        ncon.style.display='block';
      }else{
        ncon.style.display='none';
      }
    }
</script>

<?php echo form_open(base_url().'computadora/guardar', 'class="form-horizontal" role="form" id="form"'); ?>

    <div class="form-group">
    <label for="fabricante" class="col-lg-2 control-label">Fabricante</label>
          <div class="col-lg-10">
            <input type='text' class="form-control" id='fabricante' name='fabricante' value="<?php echo set_value('fabricante'); ?>"
            />
            <?php echo form_error('fabricante'); ?>
          </div>          
    </div>

    <div class="form-group">
    <label for="procesador" class="col-lg-2 control-label">Procesador</label>
          <div class="col-lg-10">
            <input type='text' class="form-control" id='procesador' name='procesador' value="<?php echo set_value('procesador'); ?>"
            />
            <?php echo form_error('procesador'); ?>
          </div>          
    </div>

      <div class="form-group">
          <label for="memoriaInstalada" class="col-lg-2 control-label">Memoria RAM instalada</label>
          <div class="col-lg-10">
              <select class="form-control" id="memoriaInstalada" name="memoriaInstalada" >
                  <option value="">Seleccione Memoria RAM instalada</option>
                  <option value="1 GB" <?=(set_value('memoriaInstalada') == '1 GB' ?'selected':'')?>>1 GB</option>
                  <option value="2 GB" <?=(set_value('memoriaInstalada') == '2 GB' ?'selected':'')?>>2 GB</option>
                  <option value="3 GB" <?=(set_value('memoriaInstalada') == '3 GB' ?'selected':'')?>>3 GB</option>
                  <option value="4 GB" <?=(set_value('memoriaInstalada') == '4 GB' ?'selected':'')?>>4 GB</option>
                  <option value="5 GB" <?=(set_value('memoriaInstalada') == '5 GB' ?'selected':'')?>>5 GB</option>
                  <option value="6 GB" <?=(set_value('memoriaInstalada') == '6 GB' ?'selected':'')?>>6 GB</option>
                  <option value="8 GB" <?=(set_value('memoriaInstalada') == '8 GB' ?'selected':'')?>>8 GB</option>
              </select><?php echo form_error('memoriaInstalada'); ?>
          </div>
      </div>
      
      <div class="form-group">
          <label for="discoDuro" class="col-lg-2 control-label">Disco Duro</label>
          <div class="col-lg-10">
              <select class="form-control" id="discoDuro" name="discoDuro" >
                  <option value="">Seleccione capacidad de disco duro</option>
                  <option value="160 GB" <?=(set_value('discoDuro') == '160 GB' ?'selected':'')?>>160 GB</option>
                  <option value="250 GB" <?=(set_value('discoDuro') == '250 GB' ?'selected':'')?>>250 GB</option>
                  <option value="320 GB" <?=(set_value('discoDuro') == '320 GB' ?'selected':'')?>>320 GB</option>
                  <option value="500 GB" <?=(set_value('discoDuro') == '500 GB' ?'selected':'')?>>500 GB</option>
                  <option value="640 GB" <?=(set_value('discoDuro') == '640 GB' ?'selected':'')?>>640 GB</option>
                  <option value="750 GB" <?=(set_value('discoDuro') == '750 GB' ?'selected':'')?>>750 GB</option>
                  <option value="1 TB" <?=(set_value('discoDuro') == '1 TB' ?'selected':'')?>>1 TB</option>
              </select><?php echo form_error('discoDuro'); ?>
          </div>
      </div>
      <div class="form-group">
          <label for="soVersion" class="col-lg-2 control-label">Sistema Operativo</label>
          <div class="col-lg-10">
              <select class="form-control" id="soVersion" name="soVersion" >
                  <option value="">Seleccione Sistema Operatio</option>
                  <option value="WINDOWS" <?=(set_value('soVersion') == 'WINDOWS' ?'selected':'')?>>WINDOWS</option>
                  <option value="LINUX" <?=(set_value('soVersion') == 'LINUX' ?'selected':'')?>>LINUX</option>
              </select><?php echo form_error('soVersion'); ?>
          </div>
      </div>

    <div class="form-group">
        <label for="tipoSistema" class="col-lg-2 control-label">Tipo de Sistema</label>
        <div class="col-lg-10">
              <label class="radio-inline">
                <input type="radio" name="tipoSistema" value="32 BITS" <?=(set_value('tipoSistema') == '32 BITS' ?'checked':'')?> >32 BITS
              </label>
              <label class="radio-inline">
                <input type="radio" name="tipoSistema" value="64 BITS" <?=(set_value('tipoSistema') == '64 BITS' ?'checked':'')?> >64 BITS
              </label><?php echo form_error('tipoSistema'); ?>
        </div>
    </div>

    <div class="form-group">
    <label for="numeroSerie" class="col-lg-2 control-label">Numero de Serie</label>
          <div class="col-lg-10">
            <input type='text' class="form-control" id='numeroSerie' name='numeroSerie' value="<?php echo set_value('numeroSerie'); ?>"
            />
            <?php echo form_error('numeroSerie'); ?>
          </div>          
    </div>

    <div class="form-group">
    <label for="comentarios" class="col-lg-2 control-label">Comentarios</label>
          <div class="col-lg-10">
            <textarea class="form-control" id='comentarios' name='comentarios' rows="3"><?php echo set_value('comentarios'); ?></textarea>
            <?php echo form_error('comentarios'); ?>
          </div>
    </div>

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

 <span id="group_control" style="display: none;">
    <div class="form-group">
        <label for="control" class="col-lg-2 control-label">Control</label>
        <div class="col-lg-2">
              <label class="radio-inline">
                <input type="radio" name="control" value="1" <?=(set_value('control') == '1' ?'checked':'')?> >LIBRE
              </label>
              <label class="radio-inline">
                <input type="radio" name="control" value="2" <?=(set_value('control') == '2' ?'checked':'')?> >OCUPADA
              </label><?php echo form_error('control'); ?>
        </div>
        <label for="comp_numero" class="col-lg-auto control-label">Numero de Computadora</label>
        <div class="col-lg-1">
          <input type='text' class="form-control" id='comp_numero' name='comp_numero' value="<?php echo set_value('comp_numero'); ?>"/>
          <?php echo form_error('comp_numero'); ?>
        </div>
    </div>
</span>

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
      <a href="<?php echo base_url(); ?>computadora" class="btn btn-primary" title="Cancelar">Cancelar</a>
    </div>
  </div>

<?php echo form_close(); ?>


