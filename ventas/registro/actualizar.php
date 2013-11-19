<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/venta.php");
$venta=new venta;
extract($_POST);
//empieza la copia de archivos
$valores=array(	"fechaventa"=>"'$fechaventa'",
				//"codproductos"=>"'$codproductos'",
				//"cantidad"=>"'$cantidadventatotal'",
				//"preciounitario"=>"'$preciounitario'",
				//"total"=>"'$total'",
				"codcliente"=>"'$codcliente'",
				"coddistribuidor"=>"'$coddistribuidor'",
				"observacion"=>"'$observacion'",
				);
				$venta->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>