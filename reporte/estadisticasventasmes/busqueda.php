<?php
include_once("../../login/check.php");

extract($_POST);


include_once '../../class/ventadetalle.php';
$ventadetalle=new ventadetalle;
$anio=$_POST['anios'];
for($i=1;$i<=12;$i++){
    $v=$ventadetalle->totalventames($i,$anio);
    $v=array_shift($v);
    $datos[mes($i)]=$v['Cantidad'];

}
//print_r($datos);
?>
<script type="text/javascript" language="javascript">
$(function () {
    $('#grafica').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Estadísticas de Ventas Por mes de <?php echo $anio?>'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total de Ventas'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Total de ventas: <b>{point.y} </b>'
        },
        series: [{
            name: 'Population',
            data: [
                <?php foreach($datos as $k=>$v){
                ?>
                ['<?php echo $k?>', <?php echo $v?>],
                <?php    
                }?>
                
                
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
</script>
<div id="grafica"></div>