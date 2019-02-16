<table id="card-table" class="table table-hover table-bordered">
    <thead>
      <tr>
        <th class="text-center">AULA</th>
        <th class="text-center">HORA</th>
        <th class="text-center">LUNES</th>
        <th class="text-center">MARTES</th>
        <th class="text-center">MIERCOLES</th>
        <th class="text-center">JUEVES</th>
        <th class="text-center">VIERNES</th>
      </tr>
    </thead>
    <tbody>
        <?php if($resultado){
            for ($i=07; $i <= 22; $i++) {
                $i = str_pad($i, 2, '0', STR_PAD_LEFT);
                foreach($resultado->result() as $row){
                    $temp=explode(', ',$row->dia);
                    $dias=array('LUNES','MARTES','MIERCOLES','JUEVES','VIERNES');
                    echo ($row->idAula==2)?'<tr class="active">':'';
                    echo ($row->idAula==3)?'<tr class="success">':'';
                    echo ($row->idAula==4)?'<tr class="warning">':'';
                    echo ($row->idAula==5)?'<tr class="danger">':'';
                    echo ($row->idAula==6)?'<tr class="info">':'';
                    foreach($dias as $dia)
                    $horaI = strtotime($row->horaInicio);
                    $horaF = strtotime($row->horaFin);

                        if(date("H:i", $horaI)==$i.":00"){
                            echo '<td class="text-center"><small>'.$row->nombre_au.'</small></td>';
                            echo '<td  class="text-center">';
                            echo $FormatoHoraInicio = date("H:i", $horaI).' - '.$FormatoHoraFin = date("H:i", $horaF);
                            echo '</td>';
                            //echo date("H:i", $horaI)==$i.":00"? '<td>'.$FormatoHoraInicio.'</td>':'<td></td>';
                            foreach($dias as $dia)
                            echo in_array($dia,$temp)?'<td class="text-center"><small><a href="'.base_url().'horario/modificar/'.$row->idHorario.'">'.$row->nombre_as.'</a></small></td>':'<td class="text-center text-primary"><b></b></td>';
                        }echo $FormatoHoraInicio = date("H:i", $horaI).' - '.$FormatoHoraFin = date("H:i", $horaF);
                    echo '</tr> ';
                }
            }
         }?>
    </tbody>
</table>
<hr>

<table class="table table-bordered">
    <thead>
      <tr>
        <th class="text-center">HORA</th>
        <th class="text-center">LUNES</th>
        <th class="text-center">MARTES</th>
        <th class="text-center">MIERCOLES</th>
        <th class="text-center">JUEVES</th>
        <th class="text-center">VIERNES</th>
      </tr>
    </thead>
    <tbody>
        <?php 
            for ($i=7; $i <= 22; $i++) { 
                echo '<tr class="text-center">';
                echo '<td>';
                echo $i.":00<br>";
                echo '</td>';
                echo '</tr> ';
            }
         ?>
    </tbody>
</table>
