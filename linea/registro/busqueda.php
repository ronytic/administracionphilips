<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/linea.php';
	include_once '../../class/sindicato.php';
	include_once '../../class/servicio.php';
	include_once '../../class/modalidad.php';
	extract($_POST);

	$codsindicato=$codsindicato!=''?" and codsindicato='$codsindicato'":'';
	$codmodalidad=$codmodalidad!=''?" and codmodalidad='$codmodalidad'":'';
	$codservicio=$codservicio!=''?" and codservicio='$codservicio'":'';
	
	$linea=new linea;
	$modalidad=new modalidad;
	$servicio=new servicio;
	$sindicato=new sindicato;
	$lin=$linea->mostrarTodo("numerolinea LIKE '%$numerolinea%' $codsindicato $codmodalidad $codservicio and paradainicial LIKE '%$paradainicial%' and paradafinal LIKE '%$paradafinal%' and trayectoida LIKE '%$trayectoida%' and trayectovuelta LIKE '%$trayectovuelta%'");
	
	foreach($lin as $l){$i++;
		$mod=array_shift($modalidad->mostrar($l['codmodalidad']));
		$sin=array_shift($sindicato->mostrar($l['codsindicato']));
		$ser=array_shift($servicio->mostrar($l['codservicio']));
		$datos[$i]['codlinea']=$l['codlinea'];
		$datos[$i]['paradainicial']=$l['paradainicial'];
		$datos[$i]['paradafinal']=$l['paradafinal'];
		$datos[$i]['numerolinea']=$l['numerolinea'];
		$datos[$i]['color']=$l['color'];
		$datos[$i]['codmodalidad']=$mod['nombre'];
		$datos[$i]['codsindicato']=$sin['nombre'];
		$datos[$i]['codservicio']=$ser['nombre'];
	}
	$titulo=array("numerolinea"=>"Número de Linea","color"=>"Color","paradainicial"=>"Parada Inicial","paradafinal"=>"Parada Final","codmodalidad"=>"Modalidad","codsindicato"=>"Sindicato","codservicio"=>"Servicio");
	listadoTabla($titulo,$datos,1,"modificar.php","eliminar.php","ver.php",array("Ver Datos General"=>"reportegeneral.php"),"","_blank");
}
?>