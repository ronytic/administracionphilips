<?php
include_once("../../impresion/pdf.php");
$titulo="Datos de Tipo de Producto";
$id=$_GET['id'];
class PDF extends PPDF{
	
}

include_once("../../class/tipo.php");
$tipo=new tipo;
$tip=array_shift($tipo->mostrar($id));


$pdf=new PDF("P","mm","letter");

$pdf->AddPage();
mostrarI(array("Nombre"=>$tip['nombre'],
				"Descripción"=>$tip['descripcion'],
				
				
				"Observación"=>$tip['observacion'],
			));

/*$foto="../foto/".$emp['foto'];
if(!empty($emp['foto']) && file_exists($foto)){
	$pdf->Image($foto,140,50,40,40);	
}
*/
$pdf->Output();
?>