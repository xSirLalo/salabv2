<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<div class="container-fluid">
    <?php echo form_open('controllab/reporte', 'class="form-horizontal" role="form" id="form1" autocomplete="off"'); ?>
    <div class='col-md-4'>
        <div class="form-group">
            <div class='input-group date' id='datetimepicker6'>
                <input type='text' class="form-control" id="fechaInicio" name="fechaInicio" placeholder="YYYY/MM/DD"/>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div><?php echo form_error('fechaInicio'); ?>
        </div>
    </div>
    <div class='col-md-4'>
        <div class="form-group">
            <div class='input-group date' id='datetimepicker7'>
                <input type='text' class="form-control" id="fechaFin" name="fechaFin" placeholder="YYYY/MM/DD" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div><?php echo form_error('fechaFin'); ?>
        </div>
    </div>
    <div class="col-md-4">
         <div class="btn-group btn-group-justified">
            <div class="btn-group">
                <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i> Consultar</button>
            </div>
                <a href="<?php echo base_url(); ?>controllab/bitacora" class='btn btn-info' title="Bitacora"><i class="glyphicon glyphicon-list"></i> Bitacora</a>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<br>
<?php if (!empty($_REQUEST) && form_error('fechaFin')==FALSE): ?>
<div class="table-responsive">
    <table id="datatable" class="table">
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
</div>
<hr>
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
