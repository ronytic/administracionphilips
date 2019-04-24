<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/venta.php");
$venta=new venta;
include_once("../../class/ventadetalle.php");
$ventadetalle=new ventadetalle;

include_once("../../class/producto.php");
$producto=new producto;

include_once("../../class/compra.php");
$compra=new compra;
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/
extract($_POST);
$valoresventa=array("fechaventa"=>"'$fechaventa'",
"cliente"=>"'$cliente'",
"ci"=>"'$ci'",
"pagado"=>"'$pagado'",
"devolucion"=>"'$devolucion'",
"total"=>"'$supertotal'",
"observacion"=>"'$observacion'",
					);
$venta->insertar($valoresventa);
$idventa=$venta->last_id();
//empieza la copia de archivos
/*
if(($_FILES['curriculum']['type']=="application/pdf" || $_FILES['curriculum']['type']=="application/msword" || $_FILES['curriculum']['type']=="application/vnd.openxmlformats-officedocument.wordprocessingml.document") && $_FILES['curriculum']['size']<="500000000"){
	@$curriculum=$_FILES['curriculum']['name'];
	@copy($_FILES['curriculum']['tmp_name'],"../curriculum/".$_FILES['curriculum']['name']);
}else{
	//mensaje que no es valido el tipo de archivo
	$mensaje[]="Archivo no válido del curriculum. Verifique e intente nuevamente";
}
*/
foreach($pro as $prod){
	if($prod['codproducto']==""){
		continue;
	}
	$codproductos=$prod['codproducto'];
	$cantidad=$prod['cantidad'];
	$cantidadventatotal=$prod['cantidad'];
	$preciounitario=$prod['preciounitario'];
	$subtotal=$prod['subtotal'];
	$observacion=$prod['observacion'];

	$fecha=date("Y-m-d");
	$totalproducto=0;
	$inv=$compra->sumarTotalProducto("$codproductos");
	$inv=array_shift($inv);
	$totalproducto=$inv['cantidadtotalstock'];
	//echo $totalproducto."<br>";
	//echo $totalproducto;
	$pr=$producto->mostrar($codproductos);
	$pr=array_shift($pr);
	$nombreproducto=$pr['nombre'];

	if($totalproducto<$cantidad){
		$mensaje[]="No Existe en Inventario la Cantidad que Solicita<hr><strong><br>Nombre Producto: $nombreproducto<br>Cantidad de Inventario: $totalproducto<br>Cantidad de Solicitada: $cantidad</strong>";
	}else{
		foreach($compra->mostrarTodo("codproducto=$codproductos and cantidadstock>0","fechacompra") as $inv){
			if((float)$cantidad<=(float)$inv['cantidadstock']){
				//echo "si";
				$mensaje[]="La Venta del producto ".mb_strtoupper($nombreproducto,"utf8")." se registro correctamente";
				$id=$idventa;
				$botones=array("vernota.php"=>"Ver Nota de Entrega","verfactura.php"=>"Ver Factura");
				$cantidad=$inv['cantidadstock']-$cantidad;
				//echo $cantidad;
				$valores=array("cantidadstock"=>"$cantidad");//,"fechaventa"=>"'$fecha'");
				$compra->actualizar($valores,$inv["codcompra"]);

				$valores=array(	"codventa"=>"'$idventa'",
					"codproducto"=>"'$codproductos'",
					"cantidad"=>"'$cantidadventatotal'",
					"preciounitario"=>"'$preciounitario'",
					"subtotal"=>"'$subtotal'",
					"observacion"=>"'$observacion'",
					);
				$ventadetalle->insertar($valores);

				break;
			}else{
				//echo $cantidadsalida;
				$cantidad=$cantidad-$inv['cantidadstock'];
				$valores=array("cantidadstock"=>0,"fechaventa"=>"'$fecha'");
				$compra->actualizar($valores,$inv["codcompra"]);
			}
		}
	}

}
//$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$listar=1;
$modificar=1;
$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>