<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/sindicato.php");
$sindicato=new sindicato;
extract($_POST);
//empieza la copia de archivos
$valores=array(	"nombre"=>"'$nombre'",
				"personeriajuridica"=>"'$personeriajuridica'",
				"nombreresponsable"=>"'$nombreresponsable'",
				"telefono"=>"'$telefono'",
				"direccion"=>"'$direccion'",
				"observacion"=>"'$observacion'",
				);
				$sindicato->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>