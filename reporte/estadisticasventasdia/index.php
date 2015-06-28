<?php
include_once("../../login/check.php");
$titulo="Estadísticas de Ventas Por Día";
$folder="../../";
include_once("../../funciones/funciones.php");



for($i=2014;$i<=date("Y");$i++){
$anios[$i]=$i;
}
include_once "../../cabecerahtml.php";
?>

<script language="javascript" src="../../js/highcharts.js" type="text/javascript"></script>
<script language="javascript" src="../../js/exporting.js" type="text/javascript"></script>
<?php include_once "../../cabecera.php";?>
<div class="grid_12">
	<div class="contenido">
    	<div class="grid_8 prefix_2 alpha noimprimir">
        	<fieldset>
        	<div class="titulo"><?php echo $titulo;?></div>
            <form id="busqueda" action="busqueda.php" method="post">
                <table class="tablabus">
                    <tr>
                         <td><?php campos("Desde","fechainicio","date",date("Y-m-d"));?></td>
                        
                       <td><?php campos("Hasta","fechafin","date",date("Y-m-d"));?></td> 
                    </tr>
                    <tr>
                        <td><?php campos("Ver Gráfica","enviar","submit","",0,array("size"=>15));?></td>
                    </tr>
                </table>
            </form>
            </fieldset>
        </div>
        <div class="clear"></div>
        <div id="respuesta"></div>
    </div>
</div>
<?php include_once "../../piepagina.php";?>