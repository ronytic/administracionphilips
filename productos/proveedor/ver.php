<?php
include_once("../../impresion/pdf.php");
$titulo="Datos de Proveedor";
$id=$_GET['id'];
class PDF extends PPDF{
	
}

include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$prov=array_shift($proveedor->mostrar($id));


$pdf=new PDF("P","mm","letter");

$pdf->AddPage();
mostrarI(array("Nombre"=>$prov['nombre'],
				"Dirección"=>$prov['direccion'],
				"Teléfono"=>$prov['telefono'],
				"Nro Cuenta"=>$prov['ncuenta'],
				
				
				"Observación"=>$prov['observacion'],
			));

/*$foto="../foto/".$emp['foto'];
if(!empty($emp['foto']) && file_exists($foto)){
	$pdf->Image($foto,140,50,40,40);	
}
*/
$pdf->Output();
?>