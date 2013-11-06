<?php
include_once("../impresion/pdf.php");
$narchivo="usuarios";
include_once("../class/".$narchivo.".php");
${$narchivo}=new $narchivo;
extract($_GET);
$dato=array_shift(${$narchivo}->mostrar($id));
$titulo="Datos de Usuario";
class PDF extends PPDF{
	
}
$pdf=new PDF("P","mm","letter");
$pdf->AddPage();
switch($dato['nivel']){
case 1:{$nivel="";}break;
case 2:{$nivel="Dirección";}break;	
case 3:{$nivel="Unidad de Tráfico";}	break;
case 4:{$nivel="Técnico";}	break;
case 5:{$nivel="Secretaria";}	break;

}
mostrarI(array("Usuario"=>$dato['usuario'],
				"Nombres"=>$dato['nombre'],
				"Paterno"=>$dato['paterno'],
				"Materno"=>$dato['materno'],
				"Nivel"=>$nivel,
				"Observaciones"=>$dato['obs'],
			));

$pdf->Output();
?>