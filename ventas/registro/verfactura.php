<?php

include_once("../../impresion/fpdf/fpdf.php");
$titulo="Reporte de Venta de Producto";
$id=$_GET['id'];

include_once("../../class/venta.php");
$venta=new venta;
$ven=array_shift($venta->mostrar($id));

include_once("../../class/ventadetalle.php");
$ventadetalle=new ventadetalle;


include_once("../../class/producto.php");
$producto=new producto;
$pro=array_shift($producto->mostrar($mp['codproductos']));
class PPDF extends FPDF{
	function Header(){
		global $ven,$id;
		$this->SetTopMargin(115);
		$this->SetFont("arial","",10);
		
		$this->Image("../../imagenes/documentos/factura.jpg",0,0,216,139);
		$this->setxy(15,35);
		$this->Cell(100,3,strftime("%A, %d de %B del %Y",strtotime($ven['fechaventa'])),0);
		$this->setxy(176,15);
		$this->Cell(100,3,$id,0);
		
		$this->setxy(32,39);
		$this->Cell(100,3,$ven['cliente'],0);
		$this->setxy(175,39);
		$this->Cell(100,3,$ven['ci'],0);	
		$this->SetY(50);
		
	}
	function Footer(){
		global $ven,$codigos;
		$this->setxy(20,122);
		$this->Cell(135,3,num2letras($ven['total']),0,0,"I");
		$this->setxy(10,127);
		$this->Cell(135,3,utf8_decode("Código de Control: ".$codigos[rand(1,30)]),0,0,"I");
		$this->setxy(180,122);
		$this->Cell(25,3,$ven['total'],0,0,"R");	
	}
}


$pdf=new PPDF("L","mm",array(215.9,139.7));
$pdf->SetTopMargin(55);
$pdf->SetAutoPageBreak(true,20.5);


$pdf->AddPage();

$pdf->SetX(10);
foreach($ventadetalle->mostrarTodo("codventa=".$ven['codventa']) as $vd){
	$prod=array_shift($producto->mostrar($vd['codproducto']));
	$pdf->SetX(10);
	$pdf->Cell(26,3,$vd['cantidad'],0,0,"C");
	$pdf->Cell(117,3,$prod['nombre'],0,0,"L");
	$pdf->Cell(26,3,round($vd['preciounitario'],2),0,0,"C");
	$pdf->Cell(26,3,$vd['subtotal'],0,0,"R");
	$pdf->Ln(4);
}
/*$foto="../foto/".$emp['foto'];
if(!empty($emp['foto']) && file_exists($foto)){
	$pdf->Image($foto,140,50,40,40);	
}
*/
$pdf->Output();
?>