<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/compra.php");
$compra=new compra;
extract($_POST);
//empieza la copia de archivos
$valores=array(	"fechacompra"=>"'$fechacompra'",
				//"codproductos"=>"'$codproductos'",
				//"cantidad"=>"'$cantidad'",
				//"preciounitario"=>"'$preciounitario'",
				//"total"=>"'$total'",
				"codproveedor"=>"'$codproveedor'",
				"modelo"=>"'$modelo'",
				"observacion"=>"'$observacion'",
				//"cantidadstock"=>"'$cantidad'",
				);
				$compra->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


				$listar=0;
				$nuevo=0;
$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>