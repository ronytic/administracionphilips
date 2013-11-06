<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/linea.php");
$linea=new linea;
extract($_POST);
//empieza la copia de archivos
$valores=array(	"numerolinea"=>"'$numerolinea'",
				"color"=>"'$color'",
				"codsindicato"=>"'$codsindicato'",
				"paradainicial"=>"'$paradainicial'",
				"paradafinal"=>"'$paradafinal'",
				"trayectoida"=>"'$trayectoida'",
				"trayectovuelta"=>"'$trayectovuelta'",
				"codmodalidad"=>"'$codmodalidad'",
				"codservicio"=>"'$codservicio'",
				"observacion"=>"'$observacion'",
				);
				$linea->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>