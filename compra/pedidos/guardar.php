<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/pedido.php");
$pedido=new pedido;
//echo "<pre>";print_r($_POST);echo "</pre>";
extract($_POST);
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
				$pedido->insertar($valores);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";



$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>