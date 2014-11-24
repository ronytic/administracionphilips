<?php
include_once("../../login/check.php");
include_once("../../impresion/pdf.php");
$titulo="Reporte de Compra de Productos";
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
		$this->TituloCabecera(15,"Cant");
		$this->TituloCabecera(15,"PrecUni");
		$this->TituloCabecera(15,"Total");
		$this->TituloCabecera(20,"CantStock");
		$this->TituloCabecera(25,"FechaCompra");
		$this->TituloCabecera(45,"Proveedor");
		$this->TituloCabecera(50,"Observación");
	}	
}


$codproducto=$codproducto!=""?$codproducto:"%";

$existente=$existente=="1"?'and cantidadstock>0':'and cantidadstock=0';
if($fechainicio!="" && $fechafin!=""){
	$fechainicio=$fechainicio!=""?$fechainicio:"%";
	$fechafin=$fechafin!=""?$fechafin:"%";
	$fechas=" and  (fechacompra BETWEEN '$fechainicio' and '$fechafin')";
}
include_once("../../class/producto.php");
include_once("../../class/compra.php");
include_once("../../class/proveedor.php");
$compra=new compra;
$producto=new producto;
$proveedor=new proveedor;
$where="codproducto LIKE '$codproducto' $fechas  $existente";

$pdf=new PDF("L","mm","letter");
$pdf->AddPage();
$totales=array();
$cantidadt=0;
$preciot=0;
$totalt=0;
$cantidadstock=0;
foreach($compra->mostrarTodos($where,"fechacompra") as $inv){$i++;
	$cantidadt+=$inv['cantidad'];
	$preciot+=$inv['preciounitario'];
	$totalt+=$inv['total'];
	$cantidadstock+=$inv['cantidadstock'];

	$pro=array_shift($producto->mostrar($inv['codproducto']));
	$prov=array_shift($proveedor->mostrar($inv['codproveedor']));
	$pdf->CuadroCuerpo(10,$i,0,"R");
	$pdf->CuadroCuerpo(55,$pro['nombre'],0,"");
	$pdf->CuadroCuerpo(15,($inv['cantidad']),1,"R",1);
	$pdf->CuadroCuerpo(15,($inv['preciounitario']),1,"R",1);
	$pdf->CuadroCuerpo(15,($inv['total']),1,"R",1);
	$pdf->CuadroCuerpo(20,($inv['cantidadstock']),1,"R",1);
	$pdf->CuadroCuerpo(25,fecha2Str($inv['fechacompra']),1,"",1);
	$pdf->CuadroCuerpo(45,($prov['nombre']),1,"",1);
	$pdf->CuadroCuerpo(50,($inv['observacion']),1,"L",1);
	
	$pdf->ln();
}
$pdf->Linea();
$pdf->CuadroCuerpoResaltar(65,"Totales",1,"R",0);
$pdf->CuadroCuerpoResaltar(15,$cantidadt,1,"R",1);
$pdf->CuadroCuerpoResaltar(15,$preciot,1,"R",1);
$pdf->CuadroCuerpoResaltar(15,$totalt,1,"R",1);
$pdf->CuadroCuerpoResaltar(20,$cantidadstock,1,"R",1);
$pdf->CuadroCuerpoResaltar(55,"",0,"");
//print_r($totales);

$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();

$pdf->Output();
?>