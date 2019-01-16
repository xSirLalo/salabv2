<style type="text/css">
.contenedor{
    position: relative;
    display: inline-block;
    text-align: center;
}
 
.texto-encima{
    position: absolute;
    top: 10px;
    left: 10px;
    line-height: 0.5px;
}
.centrado{
    position: absolute;
    top: 28%;
    left: 55%;
    transform: translate(-50%, -50%);
}
.alert-fixed {
    position:fixed; 
    top: 0px; 
    left: 0px; 
    width: 100%;
    z-index:9999; 
    border-radius:0px
}
</style>

<?php echo form_open(base_url().'controllab/sesion_iniciada', 'class="form-inline" role="form" id="form"'); ?>
<div class="row">
    <div class="col-md-6 col-md-offset-4">
      <div class="form-group">
        <input type="text" class="form-control input-lg" id="noControl" name='noControl' value="<?php echo set_value('noControl'); ?>" placeholder="Número de Control" autofocus required>
      </div>

      <button type="submit" class="btn btn-primary" title="Disponibles <?=$totaE?>"><span style="font-size: 25px" class="glyphicon glyphicon-triangle-right"></span></button>
      <a href="<?php echo base_url(); ?>controllab/bitacora" class="btn btn-info" title="Bitacora"><span style="font-size: 25px" class="glyphicon glyphicon-list"></span></a>
<?php echo form_error('noControl'); ?>
    </div>
</div>
<?php echo form_close(); ?>
<br>
<hr>
<?php 
    if($resultado){
echo '<div class="row">';
     foreach($resultado->result() as $columna){
     echo '<div class="contenedor col-md-2">';
        if($totaE!=0){ 
            if($columna->control==2){
            echo '<a href='.base_url().'controllab/modificar/'.$columna->idControlLab.'>';
        } 
    }    
    echo '<img src="'.base_url().'assets/img/pc.png" alt="'.$columna->idControlLab.'" width="160" height="160"></a>';
        echo '<div class="texto-encima centrado"><h2>';
                    if($columna->control==2){echo '<b class="text-primary"';}
                    if($columna->idEstatus==3){echo '<b class="text-success"';}
                    if($columna->idEstatus==4){echo '<b class="text-danger"';}
                echo '>'.$columna->comentarios.'</b></h2>';
                if($columna->control==2){
            echo '<b>'.$columna->noControl.'</b>';
             }   
        echo '</div>';// texto-encima centrado
     echo '</div>';//contenedor
        }//foreach
 echo '</div>';//contenedor
    } //if
?>

