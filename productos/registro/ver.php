<?php
include_once("../../impresion/pdf.php");
$titulo="Datos de Producto";
$id=$_GET['id'];
class PDF extends PPDF{
	
}

include_once("../../class/producto.php");
$producto=new producto;
$prod=array_shift($producto->mostrar($id));

include_once("../../class/tipo.php");
$tipo=new tipo;
$tip=array_shift($tipo->mostrar($prod['codtipo']));

$pdf=new PDF("P","mm","letter");

$pdf->AddPage();
mostrarI(array("Nombre"=>$prod['nombre'],
				"Descripción"=>$prod['descripcion'],
				"Código de Barra"=>$prod['codbarra'],
				"Tipo de Producto"=>$tip['nombre'],
				
				
				"Observación"=>$prod['observacion'],
			));

/*$foto="../foto/".$emp['foto'];
if(!empty($emp['foto']) && file_exists($foto)){
	$pdf->Image($foto,140,50,40,40);	
}
*/
$pdf->Output();
?>