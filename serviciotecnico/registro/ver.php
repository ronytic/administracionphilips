<?php
include_once("../../impresion/pdf.php");
$titulo="Solicitud de Servicio Técnico";
$id=$_GET['id'];
class PDF extends PPDF{
	
}
include_once("../../class/serviciotecnico.php");
$serviciotecnico=new serviciotecnico;
$sertec=array_shift($serviciotecnico->mostrar($id));

include_once("../../class/producto.php");
$producto=new producto;
$prod=array_shift($producto->mostrar($sertec['codproducto']));



include_once("../../class/tipo.php");
$tipo=new tipo;
$tip=array_shift($tipo->mostrar($prod['codtipo']));

$pdf=new PDF("P","mm",array(215.9,139.7));

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
$pdf->CuadroCuerpoPersonalizado(40,"Fecha",1,"",0,"B");
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(80,$sertec['nombre'],0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(25,$sertec['ci'],0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(35,fecha2Str($sertec['fecha']),0,"",0,"");

$pdf->Ln();
$pdf->Ln();

$pdf->CuadroCuerpoPersonalizado(120,"Centro",1,"",0,"B");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(40,"Telefono",1,"",0,"B");
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(120,$sertec['centro'],0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(40,$sertec['telefono'],0,"",0,"");

$pdf->Ln();
$pdf->Ln();

$pdf->CuadroCuerpoPersonalizado(80,"Producto",1,"",0,"B");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(40,"N Serie",1,"",0,"B");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(25,"Garantia",1,"",0,"B");
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(80,$prod['nombre'],0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(40,$sertec['nserie'],0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(25,$sertec['estadogarantia']?'Si':'No',0,"",0,"");

$pdf->Ln();
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(80,"Indicación Cliente",1,"",0,"B");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(80,"Accesorios",1,"",0,"B");
$pdf->Ln();
$y=$pdf->GetY();
$pdf->CuadroCuerpoMulti(80,$sertec['indicacioncliente'],0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->SetXY(18+95,$y);
$pdf->CuadroCuerpoMulti(80,$sertec['accesorios'],0,"",0,"");
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(40,"A Cuenta",1,"",0,"B");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(40,"Saldo",1,"",0,"B");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(40,"Total",1,"",0,"B");
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(40,$sertec['acuenta'],0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(40,$sertec['saldo'],0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(15,"",0,"",0,"");
$pdf->CuadroCuerpoPersonalizado(40,$sertec['total'],0,"",0,"");
/*$foto="../foto/".$emp['foto'];
if(!empty($emp['foto']) && file_exists($foto)){
	$pdf->Image($foto,140,50,40,40);	
}
*/
$pdf->Output();
?>
