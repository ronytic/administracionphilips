<?php
include_once("../../login/check.php");
include_once("../../impresion/pdf.php");
$titulo="Reporte de Venta de Productos";
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
		$this->TituloCabecera(80,"Nombre Producto");
		$this->TituloCabecera(20,"Cant");
		$this->TituloCabecera(20,"PrecUni");
		$this->TituloCabecera(20,"Total");
		//$this->TituloCabecera(20,"CantStock");
		$this->TituloCabecera(20,"FechaVen");
		$this->TituloCabecera(50,"Cliente");
		$this->TituloCabecera(20,"C.I.");
		$this->TituloCabecera(60,"Observación");
	}	
}


$codproducto=$codproducto!=""?$codproducto:"%";

$id=$id!=""?$id:"%";

$existente=$existente=="1"?'and cantidadstock>0':'';
if($fechainicio!="" && $fechafin!=""){
	$fechainicio=$fechainicio!=""?$fechainicio:"%";
	$fechafin=$fechafin!=""?$fechafin:"%";
	$fechas=" and  (fecha BETWEEN '$fechainicio' and '$fechafin')";
}
include_once("../../class/producto.php");
include_once("../../class/ventadetalle.php");
include_once("../../class/venta.php");


$ventadetalle=new ventadetalle;
$venta=new venta;
$producto=new producto;
$where="codproducto LIKE '$codproducto' $fechas  $existente and id LIKE '$id'";


$CodigoControl=GenerarCodigoControl("wsddsw2rty1",date("Y-m-d"),$factura,$numeroautorizacion,$importe);

$pdf=new PDF("L","mm","legal");
$pdf->AddPage();
$totales=array();
$cantidadt=0;
$preciot=0;
$totalt=0;
$cantidadstock=0;
foreach($ventadetalle->mostrarTodos($where,"fecha") as $inv){$i++;
	$ven=array_shift($venta->mostrar($inv['codventa']));
	$cantidadt+=$inv['cantidad'];
	$preciot+=$inv['preciounitario'];
	$totalt+=$inv['subtotal'];
	$cantidadstock+=$inv['cantidadstock'];

	$pro=array_shift($producto->mostrar($inv['codproducto']));
	
	
	$pdf->CuadroCuerpo(10,$i,0,"R");
	$pdf->CuadroCuerpo(80,$pro['nombre'],0,"");
	$pdf->CuadroCuerpo(20,($inv['cantidad']),1,"R",1);
	$pdf->CuadroCuerpo(20,($inv['preciounitario']),1,"R",1);
	$pdf->CuadroCuerpo(20,($inv['subtotal']),1,"R",1);
	//$pdf->CuadroCuerpo(20,($inv['cantidadstock']),1,"R",1);
	$pdf->CuadroCuerpo(20,fecha2Str($inv['fecha']),0,"",1);
	$pdf->CuadroCuerpo(50,($ven['cliente']),0,"",1);
	$pdf->CuadroCuerpo(20,($ven['ci']),0,"",1);
	$pdf->CuadroCuerpo(60,($inv['observacion']),0,"L",1);
	
	$pdf->ln();
}
$pdf->Linea();
$pdf->CuadroCuerpoResaltar(90,"Totales",1,"R",0);
$pdf->CuadroCuerpoResaltar(20,$cantidadt,1,"R",1);
$pdf->CuadroCuerpoResaltar(20,$preciot,1,"R",1);
$pdf->CuadroCuerpoResaltar(20,$totalt,1,"R",1);
//$pdf->CuadroCuerpoResaltar(20,$cantidadstock,1,"R",1);
$pdf->CuadroCuerpoResaltar(55,"",0,"");
//print_r($totales);

$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();

$pdf->Output();
?>