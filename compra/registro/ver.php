<?php
include_once("../../impresion/pdf.php");
$titulo="Datos de Compra de Producto";
$id=$_GET['id'];
class PDF extends PPDF{

}

include_once("../../class/compra.php");
$compra=new compra;
$mp=$compra->mostrar($id);
$mp=array_shift($mp);

include_once("../../class/producto.php");
$producto=new producto;
$pro=$producto->mostrar($mp['codproducto']);
$pro=array_shift($pro);

include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$prov=$proveedor->mostrar($mp['codproveedor']);
$prov=array_shift($prov);

$pdf=new PDF("P","mm","letter");

$pdf->AddPage();
mostrarI(array("Fecha de Compra"=>fecha2Str($mp['fechacompra']),
				"Producto"=>$pro['nombre']." - ".$pro['descripcion'],
				"Cantidad"=>$mp['cantidad'],
				"Precio Unitario"=>$mp['preciounitario']." Bs",
				"Total"=>$mp['total']." Bs",
				"Cantidad en Stock"=>$mp['cantidadstock'],
				"Proveedor"=>$prov['nombre'],
				"Modelo"=>($mp['modelo']),
				"Observación"=>($mp['observacion']),
			));

/*$foto="../foto/".$emp['foto'];
if(!empty($emp['foto']) && file_exists($foto)){
	$pdf->Image($foto,140,50,40,40);
}
*/
$pdf->Output();
?>