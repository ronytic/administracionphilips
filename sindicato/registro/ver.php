<?php
include_once("../../impresion/pdf.php");
$titulo="Reporte de Sindicato";
$id=$_GET['id'];
class PDF extends PPDF{
	
}

include_once("../../class/sindicato.php");
$sindicato=new sindicato;
$sin=array_shift($sindicato->mostrar($id));

$pdf=new PDF("P","mm","letter");

$pdf->AddPage();
mostrarI(array("Nombre"=>$sin['nombre'],
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