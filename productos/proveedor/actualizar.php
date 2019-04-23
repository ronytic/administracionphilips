<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/proveedor.php");
$proveedor=new proveedor;
extract($_POST);
$listar=0;
//empieza la copia de archivos
$valores=array(	"nombre"=>"'$nombre'",
				"direccion"=>"'$direccion'",
				"telefono"=>"'$telefono'",
				"ncuenta"=>"'$ncuenta'",
				"observacion"=>"'$observacion'",

				);
				$proveedor->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>