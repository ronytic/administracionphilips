<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/tipo.php");
$tipo=new tipo;
extract($_POST);
//empieza la copia de archivos
$valores=array(	"nombre"=>"'$nombre'",
				"descripcion"=>"'$descripcion'",
				"observacion"=>"'$observacion'",
				
				);
				$tipo->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>