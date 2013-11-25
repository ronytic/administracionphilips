<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/venta.php");
$venta=new venta;
extract($_POST);
//empieza la copia de archivos
$valores=array(	"fechaventa"=>"'$fechaventa'",
"cliente"=>"'$cliente'",
"ci"=>"'$ci'",
"observacion"=>"'$observacion'",
				);
				$venta->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>