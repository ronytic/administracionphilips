<?php
include_once("../../login/check.php");
$titulo="Listado de Líneas";
$folder="../../";
include_once("../../class/sindicato.php");
$sindicato=new sindicato;
$sin=todolista($sindicato->mostrarTodo("","nombre"),"codsindicato","nombre","");

include_once("../../class/modalidad.php");
$modalidad=new modalidad;
$mod=todolista($modalidad->mostrarTodo("","nombre"),"codmodalidad","nombre","");

include_once("../../class/servicio.php");
$servicio=new servicio;
$ser=todolista($servicio->mostrarTodo("","nombre"),"codservicio","nombre","");

$dest=array("Procesado"=>"Procesado","Directo"=>"Directo");
include_once("../../funciones/funciones.php");
include_once "../../cabecerahtml.php";
?>
<?php include_once "../../cabecera.php";?>
<div class="grid_12">
	<div class="contenido">
    	<div class="grid_9 prefix_1 alpha">
        	<fieldset>
        	<div class="titulo"><?php echo $titulo?> - Criterio de Busqueda</div>
            <form id="busqueda" action="busqueda.php" method="post" >
                <table class="tablabus">
                    <tr>
                        <td><?php campos("Número de Linea","numerolinea","text","",1,array("size"=>15));?></td>
						<td><?php campos("Sindicato","codsindicato","select",$sin);?></td>
                        <td><?php campos("Modalidad","codmodalidad","select",$mod);?></td>
                        <td><?php campos("Servicio","codservicio","select",$ser);?></td>
                    </tr>
                    <tr>
                    	<td><?php campos("Parada Inicial","paradainicial","text","",0,array("size"=>20));?></td>
                        <td><?php campos("Parada Final","paradafinal","text","",0,array("size"=>20));?></td>
                        <td><?php campos("Trayecto de Ida","trayectoida","text","",0,array("size"=>20));?></td>
                        <td><?php campos("Trayecto de Vuelta","trayectovuelta","text","",0,array("size"=>20));?></td>
                    </tr>
                    <tr>
                    	<td><?php campos("Buscar","enviar","submit","",0,array("size"=>15));?></td>
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
