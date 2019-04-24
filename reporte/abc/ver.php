<?php
include_once("../../login/check.php");
include_once("../../impresion/pdf.php");
$titulo="Reporte ABC";
extract($_GET);
class PDF extends PPDF{
	function Cabecera(){
		global $fechainicio,$fechafin;

		$this->Ln();
		$this->CuadroCabecera(30,"Monto Expresado en Bolivianos",20,"");
		$this->Ln();
		$this->TituloCabecera(10,"N");
		$this->TituloCabecera(55,"Nombre Producto");
		$this->TituloCabecera(25,"Cantidad");
		$this->TituloCabecera(25,"Costo Uni");
		$this->TituloCabecera(25,"Valor");
		$this->TituloCabecera(25,"% Producto");
		$this->TituloCabecera(25,"%Acumulado");
		$this->TituloCabecera(25,"Clas. ABC");
	}
}


//$codproducto=$codproducto!=""?$codproducto:"%";
// $where=$codproducto!=""?"codproducto=$codproducto and activo=1":" activo=1";


// $existente=$existente=="1"?'and cantidadstock>0':'and cantidadstock=0';
// if($fechainicio!="" && $fechafin!=""){
// 	$fechainicio=$fechainicio!=""?$fechainicio:"%";
// 	$fechafin=$fechafin!=""?$fechafin:"%";
// 	$fechas=" and  (fechacompra BETWEEN '$fechainicio' and '$fechafin')";
// }

include_once("../../class/producto.php");

include_once("../../class/ventadetalle.php");


$producto=new producto;

$ventadetalle=new ventadetalle;
//$where="codproducto LIKE '$codproducto' $fechas  $existente";

$pdf=new PDF("L","mm","letter");
$pdf->AddPage();
$totales=array();
$cantidadt=0;
$preciot=0;
$totalt=0;
$cantidadstock=0;
$i=0;
$cantidadtv=0;
$totaltv=0;
$to=$ventadetalle->sql("SELECT SUM(cantidad) as CantidadTotal,SUM(subtotal) as Total FROM `ventadetalle` WHERE activo=1");
$to=array_shift($to);
$TotalVenta=$to['Total'];
$CantidadTotal=$to['CantidadTotal'];
///echo $TotalVenta;
$vend=$ventadetalle->sql("SELECT codproducto,SUM(cantidad) as CantidadTotal,SUM(subtotal) as Total FROM `ventadetalle` WHERE activo=1 GROUP BY codproducto ORDER BY Total DESC");
//print_r($vend);

$acumulado=0;
$CantidadA=0;
$CantidadB=0;
$CantidadC=0;

$VentasA=0;
$VentasB=0;
$VentasC=0;

$ParticipacionVentasA=0;
$ParticipacionVentasB=0;
$ParticipacionVentasC=0;
foreach($vend as $vd){$i++;
	// $cantidadt+=$inv['cantidad'];
	// $totalt+=$inv['total'];
	// $cantidadstock+=$inv['cantidadstock'];


	// $cantidadtv+=$ventad['cantidadventatotal'];
	// $totaltv+=$ventad['total'];

	$pro=$producto->mostrar($vd['codproducto']);
	$pro=array_shift($pro);

	//$prov=array_shift($proveedor->mostrar($inv['codproveedor']));
	$porcentajeInd=round(($vd['Total'])/$TotalVenta,2)*100;
	$acumulado+=$porcentajeInd;
	if($acumulado>=0 && $acumulado<=80){$letra="A";$CantidadA++;$VentasA+=$vd['Total'];$ParticipacionVentasA+=$porcentajeInd;}
	if($acumulado>=81 && $acumulado<=95){$letra="B";$CantidadB++;$VentasB+=$vd['Total'];$ParticipacionVentasB+=$porcentajeInd;}
	if($acumulado>=96 && $acumulado<=100){$letra="C";$CantidadC++;$VentasC+=$vd['Total'];$ParticipacionVentasC+=$porcentajeInd;}


	$pdf->CuadroCuerpo(10,$i,0,"R");
	$pdf->CuadroCuerpo(55,$pro['nombre'],0,"");
	$pdf->CuadroCuerpo(25,($vd['CantidadTotal']),1,"R",1);
	$pdf->CuadroCuerpo(25,num(($vd['Total'])/($vd['CantidadTotal'])),1,"R",1);
	$pdf->CuadroCuerpo(25,num($vd['Total']),1,"R",1);

	$pdf->CuadroCuerpo(25,num($porcentajeInd)."%",1,"R",1);
	$pdf->CuadroCuerpo(25,num($acumulado)."%",1,"R",1);


	$pdf->CuadroCuerpo(25,($letra),1,"R",1);
	// $pdf->CuadroCuerpo(25,($ventad['cantidadventatotal']),1,"R",1);
	// $pdf->CuadroCuerpo(45,($ventad['total']),1,"R",1);

	$pdf->ln();
}
$SumaCantidadABC=$CantidadA+$CantidadB+$CantidadC;

$ParticipacionA=$CantidadA/$SumaCantidadABC*100;
$ParticipacionB=$CantidadB/$SumaCantidadABC*100;
$ParticipacionC=$CantidadC/$SumaCantidadABC*100;
$pdf->Linea();
$pdf->CuadroCuerpoResaltar(65,"Totales",1,"R",0);
$pdf->CuadroCuerpoResaltar(25,$CantidadTotal,1,"R",1);
$pdf->CuadroCuerpoResaltar(25,"",1,"R",1);
$pdf->CuadroCuerpoResaltar(25,num($TotalVenta),1,"R",1);

$pdf->ln();$pdf->ln();$pdf->ln();

$pdf->CuadroCuerpoResaltar(228,"La Regla o Principio de Pareto - Análisis ABC",1,"C",1,1);
$pdf->ln();
$pdf->CuadroCuerpoResaltar(38,"Participación Estimada",1,"C",1,1);
$pdf->CuadroCuerpoResaltar(38,"Clasificación ABC",1,"C",1,1);
$pdf->CuadroCuerpoResaltar(38,"N",1,"C",1,1);
$pdf->CuadroCuerpoResaltar(38,"Participación N",1,"C",1,1);
$pdf->CuadroCuerpoResaltar(38,"Ventas",1,"C",1,1);
$pdf->CuadroCuerpoResaltar(38,"Participación Ventas",1,"C",1,1);
$pdf->ln();
$pdf->CuadroCuerpo(38,"0 % - 80 %",0,"C",1);
$pdf->CuadroCuerpo(38,"A",0,"C",1);
$pdf->CuadroCuerpo(38,$CantidadA,0,"C",1);
$pdf->CuadroCuerpo(38,num($ParticipacionA)."%",0,"R",1);
$pdf->CuadroCuerpo(38,num($VentasA),0,"R",1);
$pdf->CuadroCuerpo(38,num($ParticipacionVentasA)."%",0,"R",1);
$pdf->ln();
$pdf->CuadroCuerpo(38,"81 % - 95%",0,"C",1);
$pdf->CuadroCuerpo(38,"B",0,"C",1);
$pdf->CuadroCuerpo(38,$CantidadB,0,"C",1);
$pdf->CuadroCuerpo(38,num($ParticipacionB)."%",0,"R",1);
$pdf->CuadroCuerpo(38,num($VentasB),0,"R",1);
$pdf->CuadroCuerpo(38,num($ParticipacionVentasB)."%",0,"R",1);
$pdf->ln();
$pdf->CuadroCuerpo(38,"96 % - 100 %",0,"C",1);
$pdf->CuadroCuerpo(38,"C",0,"C",1);
$pdf->CuadroCuerpo(38,$CantidadC,0,"C",1);
$pdf->CuadroCuerpo(38,num($ParticipacionC)."%",0,"R",1);
$pdf->CuadroCuerpo(38,num($VentasC),0,"R",1);
$pdf->CuadroCuerpo(38,num($ParticipacionVentasC)."%",0,"R",1);
//print_r($totales);

$pdf->ln();$pdf->ln();$pdf->ln();


$pdf->Output();

?>