<?php
include_once("../../impresion/pdf.php");
$titulo="Reporte de Venta de Producto";
$id=$_GET['id'];
class PDF extends PPDF{
	
}

include_once("../../class/venta.php");
$venta=new venta;
$mp=array_shift($venta->mostrar($id));

include_once("../../class/productos.php");
$productos=new productos;
$pro=array_shift($productos->mostrar($mp['codproductos']));

include_once("../../class/distribuidor.php");
$distribuidor=new distribuidor;
$dis=array_shift($distribuidor->mostrar($mp['coddistribuidor']));

include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=array_shift($cliente->mostrar($mp['codcliente']));

$pdf=new PDF("P","mm","letter");

$pdf->AddPage();
mostrarI(array("Fecha de Venta"=>fecha2Str($pro['fechaventa']),
				"Producto"=>$pro['nombre'],
				"Cantidad Vendida"=>$mp['cantidad'],
				"Precio Unitario"=>$mp['preciounitario'],
				"Total"=>$mp['total'],
				"Distribuidor"=>$dis['nombre']." - ".$dis['departamento'],
				"Cliente"=>$cli['nombre'],
				"Observación"=>($mp['observacion']),
			));

/*$foto="../foto/".$emp['foto'];
if(!empty($emp['foto']) && file_exists($foto)){
	$pdf->Image($foto,140,50,40,40);	
}
*/
$pdf->Output();
?>