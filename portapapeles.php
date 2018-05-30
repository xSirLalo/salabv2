INSERT INTO `Aula` (`idAula`, `nombre_au`) VALUES
	(1, 'AULA 0'),
	(2, 'AULA 1'),
	(3, 'AULA 2'),
	(4, 'AULA 3'),
	(5, 'CONFERENCIAS'),
	(6, 'CISCO'),
	(7, 'UNIX'),
	(8, 'MICROPROCESADORES'),
	(9, 'OFICINA LAB');

INSERT INTO `Carrera` (`idCarrera`, `nombre_ca`) VALUES
	(1, 'INGENIERIA EN SISTEMAS COMPUTACIONALES'),
	(2, 'INGENIERIA EN ADMINISTRACION'),
	(3, 'INGENIERIA EN GESTION EMPRESARIAL'),
	(4, 'INGENIERIA INFORMATICA'),
	(5, 'INGENIERIA CIVIL'),
	(6, 'INGENIERIA MECATRONICA'),
	(7, 'INGENIERIA ELECTROMECANICA'),
	(8, 'LICENCIATURA EN ADMINISTRACION'),
	(9, 'CONTADOR PUBLICO');

INSERT INTO `Estatus` (`idEstatus`, `nombre_estatus`) VALUES
	(1, 'ACTIVO'),
	(2, 'INACTIVO');

INSERT INTO `TipoDispositivo` (`idTipoDispositivo`, `nombre_tipdis`) VALUES
	(1, 'MOUSE'),
	(2, 'TECLADO'),
	(3, 'MONITOR'),
	(4, 'CAÑON');

INSERT INTO `TipoUsuario` (`idTipoUsuario`, `nombre_tipusr`) VALUES
	(1, 'Admin'),
	(2, 'Tipo2'),
	(3, 'Tipo3');


INSERT INTO `Usuario` (`idUsuario`, `nombre_usr`, `aPaterno_usr`, `aMaterno_usr`, `email`, `username`, `password`, `telefono`, `fechaCreacion`, `idTipoUsuario`, `idEstatus`) VALUES
	(1, 'EDUARDO', 'CAUICH', 'HERRERA', 'lalo_lego@hotmail.com', '', '7815696ecbf1c96e6894b779456d330e', '1', '2018-04-18 16:21:09.587004', 1, 1);

<input type="checkbox"  name="dia[]"  value="LUNES"  <?php echo set_checkbox('dia[]', 'LUNES',set_value('dia[]') == 'LUNES'); ?>  >LUNES


<?php for ($i=0;$i<count($temp);$i++) { ?>
<?php print_r($temp[$i]) ?>
<?php } ?>

<?php $temp=explode(',',$resultado->dia); ?>
<?php $asd = 'LUNES' ?>
<?php $matches = []; ?>
<?php $asd2 = 'MARTES' ?>
<?php $matches2 = []; ?>
<?php $asd3 = 'MIERCOLES' ?>
<?php $matches3 = []; ?>
<?php foreach ($temp as $key => $value): ?>
<?php 
    if(strstr($value, $asd)){
        $matches[] = $value;
    }if(strstr($value, $asd2)){
        $matches2[] = $value;
    }if(strstr($value, $asd3)){
        $matches3[] = $value;
    }

 ?>
<?php endforeach ?>
<?php print_r($matches[0]); ?>
<?php print_r($matches2[0]); ?>
<?php print_r($matches3[0]); ?>

<?php for ($i=0;$i<count($temp);$i++) { ?>
<?php $qwe = strstr($temp[$i],'MARTES',TRUE) ?>
<?php } ?>
<?php $zxc = strstr($resultado->dia,'MARTES, '); ?>
<?php print_r($zxc); ?>


<?php $temp=explode(',',$resultado->dia); ?>
<?php foreach (explode(',',$resultado->dia) as $key => $value): ?>
<?php endforeach ?>

    <div class="form-group">
    <label for="" class="col-lg-2 control-label">Dias</label>
          <div class="col-lg-10">
            <input type='text' class="form-control" id='' name='' value="<?php print_r($temp) ?>" readonly/>
          </div>
    </div>

    <label><input type="checkbox" <?php if($matches3[0] === 'MIERCOLES'){echo 'checked="checked"';}?> >Option 3</label>


<?php $temp=explode(',',$resultado->dia); ?>
<?php $temp2=explode(',',$resultado->dia); ?>
<?php $temp3=explode(',',$resultado->dia); ?>
<?php 
$i = 0

 ?>
 <?php $asd = 'LUNES' ?>
<?php $matches = []; ?>
 <?php $asd2 = 'MARTES' ?>
<?php $matches2 = []; ?>
 <?php $asd3 = 'MIERCOLES' ?>
<?php $matches3 = []; ?>

<?php foreach ($temp as $key => $value): ?>
<?php 
if(strstr($value, $asd)){
    $matches[] = $value;
}
$i = count($temp);
$i++
 ?>
<?php endforeach ?>

<?php foreach ($temp2 as $key2 => $value2): ?>
<?php 
if(strstr($value2, $asd2)){
    $matches2[] = $value2;
}
$i = count($temp2);
$i++
 ?>
<?php endforeach ?>




<?php foreach ($temp3 as $key3 => $value3): ?>
<?php 
if(strstr($value3, $asd3)){
    $matches3[] = $value3;
}
$i = count($temp3);
$i++
 ?>
<?php endforeach ?>

<?php print_r($matches[0]); ?>
<?php echo $matches2[0]; ?>
<?php echo $matches3[0]; ?>
<?php if($matches3[0] === 'MIERCOLES'){echo 'asdasd"';}?>

 <div class="checkbox">
  <label><input type="checkbox" value="<?php echo $matches[0]; ?>"<?php echo set_checkbox('dia', 'LUNES', $matches[0] === 'LUNES',TRUE);?>>Option 1</label>
</div>
<div class="checkbox">
  <label><input type="checkbox" value="<?php echo $matches2[0]; ?>"<?php echo set_checkbox('dia', 'MARTES', $matches2[0] === 'MARTES',FALSE);?>>Option 2</label>
</div>
<div class="checkbox">
  <label><input type="checkbox" value="<?php echo $matches3[0]; ?>"<?php if($matches3[0] === 'MIERCOLES'){echo 'checked="checked"';}?> >Option 3</label>
</div>


<?php $temp=explode(',',$resultado->dia); ?>
<?php foreach ($temp as $key => $value): ?>
<?php 
$i = count($temp);
$i++
 ?>
<?php endforeach ?>
<?php echo strstr($resultado->dia,'JUEVES, ') ?>

    <div class="form-group">
        <label for="dia" class="col-lg-2 control-label">Dia</label>
        <div class="col-lg-10">
              <label class="checkbox-inline">
                <input type="checkbox" name="dia[]" value="LUNES" <?php echo set_checkbox('dia[]', 'LUNES', $resultado->dia == 'LUNES');?> >LUNES
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" name="dia[]" value="MARTES" <?php echo set_checkbox('dia[]', 'MARTES', $resultado->dia == 'MARTES');?> >MARTES
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" name="dia[]" value="MIERCOLES" <?php echo set_checkbox('dia[]', 'MIERCOLES', $resultado->dia == 'MIERCOLES');?> >MIERCOLES
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" name="dia[]" value="JUEVES" <?php echo set_checkbox('dia[]', 'JUEVES', $resultado->dia == 'JUEVES');?> >JUEVES
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" name="dia[]" value="VIERNES" <?php echo set_checkbox('dia[]', 'VIERNES', $resultado->dia == 'VIERNES');?> >VIERNES
              </label>
        </div>
    </div>