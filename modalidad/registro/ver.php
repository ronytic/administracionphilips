<?php
include_once("../../impresion/pdf.php");
$titulo="Reporte de Modalidad";
$id=$_GET['id'];
class PDF extends PPDF{
	
}

include_once("../../class/modalidad.php");
$modalidad=new modalidad;
$mod=array_shift($modalidad->mostrar($id));


$pdf=new PDF("P","mm","letter");

$pdf->AddPage();
mostrarI(array("Nombre"=>$mod['nombre'],
				"Descripcion"=>$mod['descripcion'],
				"Observación"=>$mod['observacion'],
			));

/*$foto="../foto/".$emp['foto'];
if(!empty($emp['foto']) && file_exists($foto)){
	$pdf->Image($foto,140,50,40,40);	
}
*/
$pdf->Output();
?>