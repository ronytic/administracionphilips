<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Registro de Línea";
include_once("../../class/sindicato.php");
$sindicato=new sindicato;
$sin=todolista($sindicato->mostrarTodo("","nombre"),"codsindicato","nombre","");

include_once("../../class/modalidad.php");
$modalidad=new modalidad;
$mod=todolista($modalidad->mostrarTodo("","nombre"),"codmodalidad","nombre","");

include_once("../../class/servicio.php");
$servicio=new servicio;
$ser=todolista($servicio->mostrarTodo("","nombre"),"codservicio","nombre","");


include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido">
    	<div class="prefix_1 grid_8 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="guardar.php" method="post" enctype="multipart/form-data">
				<table class="tablareg">
					<tr>
						<td><?php campos("Número de Linea","numerolinea","text","",1,array("required"=>"required","size"=>50));?></td>
                        <td><?php campos("Color","color","text","",0,array("size"=>50));?></td>
					</tr>
                    <tr>
						<td colspan="2"><?php campos("Sindicato","codsindicato","select",$sin);?></td>
					</tr>
                    <tr>
						<td><?php campos("Parada Inicial","paradainicial","text","",0,array("size"=>50));?></td>
                        <td><?php campos("Parada Final","paradafinal","text","",0,array("size"=>50));?></td>
					</tr>
                    <tr>
						<td><?php campos("Trayecto de Ida","trayectoida","textarea","",0,array("rows"=>20,"cols"=>40));?></td>
                        <td><?php campos("Trayecto de Vuelta","trayectovuelta","textarea","",0,array("rows"=>20,"cols"=>40));?></td>
					</tr>
                    <tr>
						<td><?php campos("Modalidad","codmodalidad","select",$mod);?></td>
                        <td><?php campos("Servicio","codservicio","select",$ser);?></td>
					</tr>
                    <tr>
						<td colspan="2"><?php campos("Observación","observacion","textarea","",0,array("cols"=>80,"rows"=>5));?></td>
					</tr>
					<tr><td><?php campos("Guardar","guardar","submit");?></td></tr>
				</table>
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>