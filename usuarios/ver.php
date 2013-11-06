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
case 2:{$nivel="Administrador";}break;	
case 3:{$nivel="Inventario";}	break;
case 4:{$nivel="Ventas";}	break;

}
mostrarI(array("Usuario"=>$dato['usuario'],
				"Nombres"=>$dato['nombre'],
				"Apellido Paterno"=>$dato['paterno'],
				"Apellido Materno"=>$dato['materno'],
				"C.I."=>$dato['ci'],
				"Dirección"=>$dato['direccion'],
				"Teléfono"=>$dato['telefono'],
				"Email"=>$dato['email'],
				"Nivel de Usuario:"=>$nivel,
				"Observaciones"=>$dato['obs'],
			));

$pdf->Output();
?>