<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/pedido.php");
$pedido=new pedido;
extract($_POST);
//empieza la copia de archivos
$valores=array(	"codproducto"=>"'$codproducto'",
				"cantidad"=>"'$cantidad'",
				"preciocotizacion"=>"'$preciocotizacion'",
				"total"=>"'$total'",
				"fechaentrega"=>"'$fechaentrega'",
				
				"nombre"=>"'$nombre'",
				"ci"=>"'$ci'",
				"telefono"=>"'$telefono'",
				"entregado"=>"'$entregado'"
				);
				$pedido->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>