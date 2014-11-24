<?php
include_once("../../login/check.php");
include_once("../../impresion/pdf.php");
$titulo="Reporte de Inventario de Productos";
extract($_GET);
class PDF extends PPDF{
	function Cabecera(){
		global $fechainicio,$fechafin;
		if($fechainicio!=""){
		$this->CuadroCabecera(30,"Fecha de Inicio:",20,fecha2Str($fechainicio));
		}
		if($fechafin!=""){
		$this->CuadroCabecera(30,"Fecha Fin:",20,fecha2Str($fechafin));
		}
		$this->Ln();
		$this->CuadroCabecera(30,"Monto Expresado en Bolivianos",20,"");
		$this->Ln();
		$this->TituloCabecera(10,"N");
		$this->TituloCabecera(55,"Nombre Producto");
		$this->TituloCabecera(25,"Cant. Compra");
		$this->TituloCabecera(35,"Precio Total Compra");
		$this->TituloCabecera(25,"CantidadStock");
		$this->TituloCabecera(25,"Cant. Venta");
		$this->TituloCabecera(45,"Precio Total Venta");
	}	
}


//$codproducto=$codproducto!=""?$codproducto:"%";
$where=$codproducto!=""?"codproducto=$codproducto and activo=1":" activo=1";


$existente=$existente=="1"?'and cantidadstock>0':'and cantidadstock=0';
if($fechainicio!="" && $fechafin!=""){
	$fechainicio=$fechainicio!=""?$fechainicio:"%";
	$fechafin=$fechafin!=""?$fechafin:"%";
	$fechas=" and  (fechacompra BETWEEN '$fechainicio' and '$fechafin')";
}

include_once("../../class/producto.php");
include_once("../../class/compra.php");
include_once("../../class/ventadetalle.php");
include_once("../../class/proveedor.php");
$compra=new compra;
$producto=new producto;
$proveedor=new proveedor;
$ventadetalle=new ventadetalle;
//$where="codproducto LIKE '$codproducto' $fechas  $existente";

$pdf=new PDF("L","mm","letter");
$pdf->AddPage();
$totales=array();
$cantidadt=0;
$preciot=0;
$totalt=0;
$cantidadstock=0;
foreach($compra->mostrarCompraGrupo($where) as $inv){$i++;
	$cantidadt+=$inv['cantidad'];
	$totalt+=$inv['total'];
	$cantidadstock+=$inv['cantidadstock'];
	
	$ventad=array_shift($ventadetalle->sumarProducto($inv['codproducto']));
	$cantidadtv+=$ventad['cantidadventatotal'];
	$totaltv+=$ventad['total'];
	
	$pro=array_shift($producto->mostrar($inv['codproducto']));
	
	//$prov=array_shift($proveedor->mostrar($inv['codproveedor']));
	$pdf->CuadroCuerpo(10,$i,0,"R");
	$pdf->CuadroCuerpo(55,$pro['nombre'],0,"");
	$pdf->CuadroCuerpo(25,($inv['cantidad']),1,"R",1);
	$pdf->CuadroCuerpo(35,($inv['total']),1,"R",1);
	$pdf->CuadroCuerpo(25,($inv['cantidadstock']),1,"R",1);
	$pdf->CuadroCuerpo(25,($ventad['cantidadventatotal']),1,"R",1);
	$pdf->CuadroCuerpo(45,($ventad['total']),1,"R",1);
	
	$pdf->ln();
}
$pdf->Linea();
$pdf->CuadroCuerpoResaltar(65,"Totales",1,"R",0);
$pdf->CuadroCuerpoResaltar(25,$cantidadt,1,"R",1);
$pdf->CuadroCuerpoResaltar(35,$totalt,1,"R",1);
$pdf->CuadroCuerpoResaltar(25,$cantidadstock,1,"R",1);
$pdf->CuadroCuerpoResaltar(25,$cantidadtv,1,"R",1);
$pdf->CuadroCuerpoResaltar(45,$totaltv,1,"R",1);
//print_r($totales);

$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();

$pdf->Output();
?>