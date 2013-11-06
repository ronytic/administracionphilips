<?php
include_once("../../impresion/pdf.php");
$titulo="Registro de Linea con datos de Sindicato";
$id=$_GET['id'];
class PDF extends PPDF{
	
}

include_once("../../class/linea.php");
$linea=new linea;
$lin=array_shift($linea->mostrar($id));

include_once '../../class/sindicato.php';
include_once '../../class/servicio.php';
include_once '../../class/modalidad.php';
$modalidad=new modalidad;
$servicio=new servicio;
$sindicato=new sindicato;
	
$mod=array_shift($modalidad->mostrar($lin['codmodalidad']));
$sin=array_shift($sindicato->mostrar($lin['codsindicato']));
$ser=array_shift($servicio->mostrar($lin['codservicio']));

$pdf=new PDF("P","mm","letter");

$pdf->AddPage();
mostrarI(array("Número de Linea"=>$lin['numerolinea'],
				"Color"=>$lin['color'],
				"Parada Inicial"=>$lin['paradainicial'],
				"Trayecto de Ida"=>""
			));
$pdf->CuadroCuerpoMulti(160,$lin['trayectoida']);

mostrarI(array("Parada Final"=>$lin['paradafinal'],
				"Trayecto de Vuelta"=>""));
$pdf->CuadroCuerpoMulti(160,$lin['trayectovuelta']);
mostrarI(array(
				"Modalidad"=>$mod['nombre'],
				"Servicio"=>$ser['nombre'],
				"Observación"=>$sin['observacion']));
$pdf->Linea();
$pdf->CuadroCuerpo(182,"Datos del Sindicato",1);
$pdf->ln();$pdf->ln();
mostrarI(array(
			"Sindicato"=>$sin['nombre'],
			"Personería Jurídica"=>$sin['personeriajuridica'],
			"Nombre del Responsable"=>$sin['nombreresponsable'],
			"Teléfono"=>$sin['telefono'],
			"Dirección"=>$sin['direccion'],
			"Observación"=>$sin['observacion'],
));
/*$foto="../foto/".$emp['foto'];
if(!empty($emp['foto']) && file_exists($foto)){
	$pdf->Image($foto,140,50,40,40);	
}
*/
$pdf->Output();
?>