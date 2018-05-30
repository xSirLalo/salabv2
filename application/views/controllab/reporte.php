<style type="text/css">
    ${demo.css}
</style>
<!--<form action="<?php base_url(); ?>" method="get" name="fechas" id="fechas" autocomplete="off">-->
<div class="container-fluid">
  <div class="row">
    <?php echo form_open('controllab/reporte', 'class="form-horizontal" role="form" id="form1" autocomplete="off"'); ?>
        <div class="col-sm-3">
                <div class='input-group date' id='datetimepicker6'><!-- Date input -->
                        <input class="form-control" id="fechaInicio" name="fechaInicio" placeholder="YYYY/MM/DD" type="text"/> 
                        <span class="input-group-addon" id="start-date"><span class="glyphicon glyphicon-calendar"></span></span>
                </div><?php echo form_error('fechaInicio'); ?>
        </div>
        <div class="col-sm-3">
                <div class='input-group date' id='datetimepicker7'><!-- Date input -->
                        <input class="form-control" id="fechaFin" name="fechaFin" placeholder="YYYY/MM/DD" type="text" />
                        <span class="input-group-addon" id="start-date"><span class="glyphicon glyphicon-calendar"></span></span>
                </div><?php echo form_error('fechaFin'); ?>
        </div>
        <div class="col-sm-4">
                <div class="input-group"><!-- Date button input -->
                    <div class="input-group-button">
                        <button class="btn btn-info" type="submit">Consultar</button>
                    </div>
                </div>
        </div>
    <?php echo form_close(); ?>
        <div class="col-sm-2 text-right">
            <div class="btn-group btn-group-md">
                <a href="<?php echo base_url(); ?>controllab" ><button type='button' class='btn btn-default' title="Regresar a la lista"><span class="glyphicon glyphicon-share-alt"></span></button></a>
            </div>
        </div>
  </div>
</div>
<br>

<?php if (!empty($_REQUEST) && form_error('fechaFin')==FALSE): ?>
<table id="datatable" class="table table-sm">
  <thead>
    <tr>
      <th scope="col"></th>
        <?php if($resultado){
              foreach($resultado->result() as $row){ ?>
              <th><?= $row->nombre_ca; ?></th>
        <?php } }?>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Alumnos</th>
        <?php if($resultado){
              foreach($resultado->result() as $row){ ?>
              <td><?= $row->total; ?></td>
        <?php } }?>
    </tr>
  </tbody>
</table>
<div id="barras" style="min-width: 310px; height: 512px; margin: 0 auto"></div>
<hr>
<div id="pastel" style="min-width: 310px; height: 512px; margin: 0 auto"></div>
<?php endif ?>



<script type="text/javascript">
$(function () {
    $('#barras').highcharts({
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: '[<?php echo set_value('fechaInicio'); ?>][A][<?php echo set_value('fechaFin'); ?>]'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Units'
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });
});
</script>

<script type="text/javascript">
$(function () {
    $('#pastel').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: '[<?php echo set_value('fechaInicio'); ?>][A][<?php echo set_value('fechaFin'); ?>]'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%, ({point.y})</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f}%',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [
        <?php if($resultado){
              foreach($resultado->result() as $row){ ?>
              {             
              name:'<?= $row->nombre_ca;?>',
              y:<?= $row->total; ?>
              },
        <?php } }?>            
            ]
        }]
    });
});
</script>

<script type="text/javascript">
    $(function () {
        $('#datetimepicker6').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#datetimepicker7').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);

        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
        $('#asd1').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: false //Important! See issue #1075
        });
        $('#asd2').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: false //Important! See issue #1075
        });
    });
</script>
