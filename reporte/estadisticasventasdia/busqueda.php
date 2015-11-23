<?php
include_once("../../login/check.php");

extract($_POST);



include_once '../../class/ventadetalle.php';
$ventadetalle=new ventadetalle;
$anio=$_POST['anios'];

$fechainicio=$_POST['fechainicio'];
$fechafin=$_POST['fechafin'];
for($i=strtotime($fechainicio);$i<=strtotime($fechafin);$i=$i+86400){
    $dia=date("Y-m-d",$i);
    $v=$ventadetalle->totalventadia($dia);
    $v=array_shift($v);
    $datos[date("d/m/Y",strtotime($dia))]=$v['Cantidad'];

}

//echo strtotime($fechafin)-strtotime($fechainicio);
/*
for($i=strtotime($fechainicio);$i<=strtotime($fechafin);$i=$i+86400){
    
    echo date("Y-m-d",$i)."<br>";    
}*/
//print_r($datos);
?>
<script type="text/javascript" language="javascript">
$(function () {
    $('#grafica').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Estadísticas de Ventas Por Día de <?php echo date("d/m/Y",strtotime($fechainicio))?> a <?php echo date("d/m/Y",strtotime($fechafin))?>'
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