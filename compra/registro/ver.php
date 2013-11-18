<?php
include_once("../../impresion/pdf.php");
$titulo="Reporte de Compra de Producto";
$id=$_GET['id'];
class PDF extends PPDF{
	
}

include_once("../../class/compra.php");
$compra=new compra;
$mp=array_shift($compra->mostrar($id));

include_once("../../class/productos.php");
$productos=new productos;
$pro=array_shift($productos->mostrar($mp['codproductos']));

include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$prov=array_shift($proveedor->mostrar($mp['codproveedor']));

$pdf=new PDF("P","mm","letter");

$pdf->AddPage();
mostrarI(array("Fecha de Compra"=>fecha2Str($pro['fechacompra']),
				"Producto"=>$pro['nombre'],
				"Cantidad"=>$mp['cantidad'],
				"Precio Unitario"=>$mp['preciounitario'],
				"Total"=>$mp['total'],
				"Cantidad en Stock"=>$mp['cantidadstock'],
				"Proveedor"=>$prov['nombre']." - ".$prov['origen'],
				"Fecha de Vencimiento"=>fecha2Str($mp['fechavencimiento']),
				"Observación"=>($mp['observacion']),
			));

/*$foto="../foto/".$emp['foto'];
if(!empty($emp['foto']) && file_exists($foto)){
	$pdf->Image($foto,140,50,40,40);	
}
*/
$pdf->Output();
?>