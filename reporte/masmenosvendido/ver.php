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
		$this->TituloCabecera(40,"Cantidad Vendida");
		$this->TituloCabecera(40,"Precio Total Vendido");
		$this->TituloCabecera(70,"Vendedores");
	}	
}




if($fechainicio!="" && $fechafin!=""){
	$fechainicio=$fechainicio!=""?$fechainicio:"%";
	$fechafin=$fechafin!=""?$fechafin:"%";
	$fechas=" and  (fecha BETWEEN '$fechainicio' and '$fechafin')";
}
$orden=$orden=="mas"?1:0;
include_once("../../class/producto.php");
include_once("../../class/ventadetalle.php");
include_once("../../class/venta.php");
include_once("../../class/usuarios.php");


$ventadetalle=new ventadetalle;
$venta=new venta;
$producto=new producto;
$usuarios=new usuarios;
$vendedores=$id!=""?"id='$id'":" id LIKE '%'";
$where="$fechas  $vendedores";

$pdf=new PDF("L","mm","letter");
$pdf->AddPage();
$totales=array();
$cantidadt=0;
$preciot=0;
$totalt=0;
$cantidadstock=0;
foreach($ventadetalle->masMenosVendido($where,$orden) as $inv){$i++;
	$vende=array_shift($usuarios->mostrars($inv['id']));
	$ven=array_shift($venta->mostrar($inv['codventa']));
	$cantidadt+=$inv['cantidadVendida'];
	$preciot+=$inv['preciounitario'];
	$totalt+=$inv['subtotal'];
	$cantidadstock+=$inv['cantidadstock'];

	$pro=array_shift($producto->mostrar($inv['codproducto']));
	
	
	$pdf->CuadroCuerpo(10,$i,0,"R");
	$pdf->CuadroCuerpo(80,$pro['nombre'],0,"");
	$pdf->CuadroCuerpo(40,($inv['cantidadVendida']),1,"R",1);
	$pdf->CuadroCuerpo(40,($inv['subtotal']),1,"R",1);
	//$pdf->CuadroCuerpo(20,($inv['cantidadstock']),1,"R",1);
	$pdf->CuadroCuerpo(70,($vende['paterno']." ".$vende['materno']." ".$vende['nombre']),0,"",1);
	
	$pdf->ln();
}
$pdf->Linea();
$pdf->CuadroCuerpoResaltar(90,"Totales",1,"R",0);
$pdf->CuadroCuerpoResaltar(40,$cantidadt,1,"R",1);
$pdf->CuadroCuerpoResaltar(40,$totalt,1,"R",1);
//$pdf->CuadroCuerpoResaltar(20,$cantidadstock,1,"R",1);
$pdf->CuadroCuerpoResaltar(55,"",0,"");
//print_r($totales);

$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();

$pdf->Output();
?>