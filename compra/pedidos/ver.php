<?php
include_once("../../impresion/pdf.php");
$titulo="Solicitud de Pedido de Producto";
$id=$_GET['id'];
class PDF extends PPDF{

}
include_once("../../class/pedido.php");
$pedido=new pedido;
$sertec=$pedido->mostrar($id);
$sertec=array_shift($sertec);

include_once("../../class/producto.php");
$producto=new producto;
$prod=$producto->mostrar($sertec['codproducto']);
$prod=array_shift($prod);



include_once("../../class/tipo.php");
$tipo=new tipo;
$tip=$tipo->mostrar($prod['codtipo']);
$tip=array_shift($tip);

// $pdf=new PDF("P","mm",array(215.9,139.7));
$pdf=new PDF("P","mm","letter");

$pdf->AddPage();
$pdf->CuadroCuerpoPersonalizado(20,"Dirección:",0,"",0,"B");
$pdf->CuadroCuerpoPersonalizado(120,$direccion,0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(20,"Teléfono:",0,"",0,"B");
$pdf->CuadroCuerpoPersonalizado(50,$telefono,0,"",0,"");
$pdf->Ln();

$pdf->CuadroCuerpoPersonalizado(80,"Apellidos y Nombres",1,"",0,"B");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(25,"C.I.",1,"",0,"B");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(40,"Fecha Recepción",1,"",0,"B");
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(80,$sertec['nombre'],0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(25,$sertec['ci'],0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(35,fecha2Str($sertec['fecha']),0,"",0,"");

$pdf->Ln();
$pdf->Ln();

$pdf->CuadroCuerpoPersonalizado(80,"Producto",1,"",0,"B");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(25,"Entregado",1,"",0,"B");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(40,"Telefono",1,"",0,"B");
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(80,$prod['nombre'],0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(25,$sertec['entregado']?'Si':'No',0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(40,$sertec['telefono'],0,"",0,"");

$pdf->Ln();
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(40,"Cantidad",1,"",0,"B");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(40,"Precio Cotización",1,"",0,"B");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(40,"Total",1,"",0,"B");
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(40,$sertec['cantidad'],0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(40,$sertec['preciocotizacion'],0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(40,$sertec['total'],0,"",0,"");
/*$foto="../foto/".$emp['foto'];
if(!empty($emp['foto']) && file_exists($foto)){
	$pdf->Image($foto,140,50,40,40);
}
*/
$pdf->Output();
?>
