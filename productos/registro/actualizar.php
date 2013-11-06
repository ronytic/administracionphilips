<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/producto.php");
$producto=new producto;
extract($_POST);
//empieza la copia de archivos
$valores=array(	"nombre"=>"'$nombre'",
				"descripcion"=>"'$descripcion'",
				"codtipo"=>"'$codtipo'",
				"codbarra"=>"'$codbarra'",
				
				"observacion"=>"'$observacion'",
				
				);
				$producto->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>