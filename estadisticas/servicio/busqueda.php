<?php
include_once("../../login/check.php");
$titulo="Estadísticas de Líneas por Servicio";
extract($_POST);

$codsindicato=$codsindicato!=''?" codsindicato='$codsindicato'":'';
$codmodalidad=$codmodalidad!=''?" and codmodalidad='$codmodalidad'":'';
//$codservicio=$codservicio!=''?" and codservicio='$codservicio'":'';
$where="$codsindicato$codmodalidad$codservicio";

include_once '../../class/linea.php';
include_once '../../class/sindicato.php';
include_once '../../class/servicio.php';
include_once '../../class/modalidad.php';
$linea=new linea;
$modalidad=new modalidad;
$servicio=new servicio;
$sindicato=new sindicato;
$lin=$linea->mostrarTodo($where);
$totallineas=count($lin);
$porcentajes=array();
foreach($servicio->mostrarTodo() as $ser){
	$condicion=$where!=''?$where.' and codservicio='.$ser['codservicio']:'codservicio='.$ser['codservicio'];
	$cantlineas=$linea->mostrarTodo($condicion);
	$porcentajes[$ser['nombre']]=porcentaje($totallineas,count($cantlineas));
}

//print_r($porcentajes);

/*	$mod=array_shift($modalidad->mostrar($l['codmodalidad']));
	$sin=array_shift($sindicato->mostrar($l['codsindicato']));
	$ser=array_shift($servicio->mostrar($l['codservicio']));
*/


?>


<script type="text/javascript" language="javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'grafica',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: '<?php echo $titulo?>'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Porcentaje de Modalidades',
                data: [
				<?php foreach($porcentajes as $k=>$v){?>
                    ['<?php echo $k?>',   <?php echo $v?>],
                 <?php }?>
                ]
            }]
        });
    });
    
});
</script>
<div id="grafica"></div>