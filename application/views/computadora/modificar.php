<script type="text/javascript">
    function getNewVal()
    { 
      var idaula = document.getElementById("idAula").value;
      var ncon = document.getElementById("group_control");

      if (idaula === '1') {
        ncon.style.display='block';
      }else{
        ncon.style.display='none';
      }
    }
</script>

<?php foreach ($resultados->result() as $resultado){ ?>
<?php echo form_open(base_url().'computadora/actualizar/'.$idComputadora, 'class="form-horizontal" role="form" id="form"'); ?>

    <div class="form-group">
    <label for="fabricante" class="col-lg-2 control-label">Fabricante</label>
          <div class="col-lg-10">
            <input type='text' class="form-control" id='fabricante' name='fabricante' value="<?=$resultado->fabricante?>"
            />
            <?php echo form_error('fabricante'); ?>
          </div>          
    </div>

    <div class="form-group">
    <label for="procesador" class="col-lg-2 control-label">Procesador</label>
          <div class="col-lg-10">
            <input type='text' class="form-control" id='procesador' name='procesador' value="<?=$resultado->procesador?>"
            />
            <?php echo form_error('procesador'); ?>
          </div>          
    </div>

      <div class="form-group">
          <label for="memoriaInstalada" class="col-lg-2 control-label">Memoria RAM instalada</label>
          <div class="col-lg-10">
              <select class="form-control" id="memoriaInstalada" name="memoriaInstalada" >
                  <option value="1 GB" <?=($resultado->memoriaInstalada == '1 GB' ?'selected':'')?>>1 GB</option>
                  <option value="2 GB" <?=($resultado->memoriaInstalada == '2 GB' ?'selected':'')?>>2 GB</option>
                  <option value="3 GB" <?=($resultado->memoriaInstalada == '3 GB' ?'selected':'')?>>3 GB</option>
                  <option value="4 GB" <?=($resultado->memoriaInstalada == '4 GB' ?'selected':'')?>>4 GB</option>
                  <option value="5 GB" <?=($resultado->memoriaInstalada == '5 GB' ?'selected':'')?>>5 GB</option>
                  <option value="6 GB" <?=($resultado->memoriaInstalada == '6 GB' ?'selected':'')?>>6 GB</option>
                  <option value="8 GB" <?=($resultado->memoriaInstalada == '8 GB' ?'selected':'')?>>8 GB</option>
              </select><?php echo form_error('memoriaInstalada'); ?>
          </div>
      </div>
      <div class="form-group">
          <label for="discoDuro" class="col-lg-2 control-label">Disco Duro</label>
          <div class="col-lg-10">
              <select class="form-control" id="discoDuro" name="discoDuro" >
                  <option value="160 GB" <?=($resultado->discoDuro == '160 GB' ?'selected':'')?>>160 GB</option>
                  <option value="250 GB" <?=($resultado->discoDuro == '250 GB' ?'selected':'')?>>250 GB</option>
                  <option value="320 GB" <?=($resultado->discoDuro == '320 GB' ?'selected':'')?>>320 GB</option>
                  <option value="500 GB" <?=($resultado->discoDuro == '500 GB' ?'selected':'')?>>500 GB</option>
                  <option value="640 GB" <?=($resultado->discoDuro == '640 GB' ?'selected':'')?>>640 GB</option>
                  <option value="750 GB" <?=($resultado->discoDuro == '750 GB' ?'selected':'')?>>750 GB</option>
                  <option value="1 TB" <?=($resultado->discoDuro == '1 TB' ?'selected':'')?>>1 TB</option>
              </select><?php echo form_error('discoDuro'); ?>
          </div>
      </div>
      <div class="form-group">
          <label for="soVersion" class="col-lg-2 control-label">Sistema Operativo</label>
          <div class="col-lg-10">
              <select class="form-control" id="soVersion" name="soVersion" >
                  <option value="WINDOWS" <?=($resultado->soVersion == 'WINDOWS' ?'selected':'')?>>WINDOWS</option>
                  <option value="LINUX" <?=($resultado->soVersion == 'LINUX' ?'selected':'')?>>LINUX</option>
              </select><?php echo form_error('soVersion'); ?>
          </div>
      </div>

    <div class="form-group">
        <label for="tipoSistema" class="col-lg-2 control-label">Tipo de Sistema</label>
        <div class="col-lg-10">
              <label class="radio-inline">
                <input type="radio" name="tipoSistema" value="32 BITS" <?=($resultado->tipoSistema == '32 BITS' ?'checked':'')?> >32 BITS
              </label>
              <label class="radio-inline">
                <input type="radio" name="tipoSistema" value="64 BITS" <?=($resultado->tipoSistema == '64 BITS' ?'checked':'')?> >64 BITS
              </label><?php echo form_error('tipoSistema'); ?>
        </div>
    </div>

    <div class="form-group">
    <label for="numeroSerie" class="col-lg-2 control-label">Numero de Serie</label>
          <div class="col-lg-10">
            <input type='text' class="form-control" id='numeroSerie' name='numeroSerie' value="<?=$resultado->numeroSerie?>"
            />
            <?php echo form_error('numeroSerie'); ?>
          </div>          
    </div>

    <div class="form-group">
    <label for="comentarios" class="col-lg-2 control-label">Comentarios</label>
          <div class="col-lg-10">
            <textarea class="form-control" id='comentarios' name='comentarios' rows="3"><?=$resultado->comentarios?></textarea>
            <?php echo form_error('comentarios'); ?>
          </div>          
    </div>

<div class="form-group">
    <label for="idAula" class="col-lg-2 control-label">Aulas</label>
    <div class="col-lg-10">
        <?php echo "<select name='idAula' id='idAula' class='form-control' onclick='getNewVal();'>";
            foreach($aulas as  $row){
                $selectvalue = $resultado->idAula; 
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
                <input type="radio" name="control" value="1" <?=($resultado->control == '1' ?'checked':'')?> >LIBRE
              </label>
              <label class="radio-inline">
                <input type="radio" name="control" value="2" <?=($resultado->control == '2' ?'checked':'')?> >OCUPADA
              </label><?php echo form_error('control'); ?>
        </div>
        
        <div class="col-lg-2">
          <label for="comp_ip" class="control-label">IP</label>
          <input type='text' class="form-control" id='comp_ip' name='comp_ip' value="<?=$resultado->comp_ip?>"/>
          <?php echo form_error('comp_ip'); ?>
        </div>
        
        <div class="col-lg-2">
          <label for="comp_numero" class="control-label">Computadora N°</label>
          <input type='text' class="form-control" id='comp_numero' name='comp_numero' value="<?=$resultado->comp_numero?>"/>
          <?php echo form_error('comp_numero'); ?>
        </div>

    </div>
</span>

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

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-warning" title="Actualizar">Actualizar</button>
      <a href="<?php echo base_url(); ?>computadora" class="btn btn-primary" title="Cancelar">Cancelar</a>
    </div>
  </div>

<?php echo form_close(); ?>
<?php } ?>
