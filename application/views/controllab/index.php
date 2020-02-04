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
    top: 35%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.alert-fixed {
    position:fixed; 
    top: 0px; 
    left: 0px; 
    width: 50%;
    z-index:9999; 
    border-radius:0px
}
</style>
<div class="text-center">  
    <?php echo form_open(base_url().'controllab/sesion_iniciada', 'class="form-inline" role="form" id="form"'); ?>
        <div class="form-group">
            <label class="sr-only" for="noControl">Número de Control</label>
            <input type="text" class="form-control input-lg" id="noControl" name='noControl' value="<?php echo set_value('noControl',$this->session->flashdata('noControl')); ?>" placeholder="Número de Control" autofocus required>
        </div>
        <button type="submit" class="btn btn-primary" title="Disponibles <?=$totaE?>"><span style="font-size: 25px" class="glyphicon glyphicon-triangle-right"></span></button>
        <a href="<?php echo base_url(); ?>controllab/bitacora" class="btn btn-info" title="Bitacora"><span style="font-size: 25px" class="glyphicon glyphicon-list"></span></a><?php echo form_error('noControl'); ?>
    <?php echo form_close(); ?>  
</div>
<br>
<hr>
<?php 
    if($Tablero){
        echo '<div class="row">';//row
             foreach($Tablero->result() as $PC){
                //$windows = exec("ping -n 1 -w 1 $columna->comp_ip", $outcome, $status);
                // $linux = exec("/bin/ping -q -c1 $columna_c->comp_ip", $outcome, $status);
             echo '<div class="contenedor col-md-2">';//contenedor
                if($totaE!=0){ 
                    if($PC->control==2){
                    echo '<a href='.base_url().'controllab/modificar/'.$PC->comp_numero.'>';
                } 
            }    
            echo '<img src="'.base_url().'assets/img/pc.png" alt="'.$PC->comp_numero.'" width="128" height="128"></a>';
                echo '<div class="texto-encima centrado"><h1>';// texto-encima centrado
                            if($PC->control==2){echo '<b class="text-primary"';}
                            if($PC->idEstatus==3){echo '<b class="text-success"';}
                            if($PC->idEstatus==4){echo '<b class="text-danger"';}
                            if($PC->idEstatus==8){echo '<b class="text-warning"';}
                        echo '>'.$PC->comp_numero.'</b></h1>';
                        if($PC->control==2){
                    //echo '<b>'.$columna->noControl.'</b>';
                     }   
                echo '</div>';// texto-encima centrado
             echo '</div>';//contenedor
                }//foreach
         echo '</div>';//row
    } //if
?>
