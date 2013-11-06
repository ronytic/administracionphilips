<?php
include_once("../login/check.php");
if(!empty($_POST)):
$narchivo="usuarios";
include_once("../class/".$narchivo.".php");
${$narchivo}=new $narchivo;
extract($_POST);
if($passwordd==$password2){
	$mensaje[]="LAS CONTRASEÑAS NO SE GUARDARON, POR QUE NO COINCIDEN";	
}else{
	$valores=array("usuario"=>"'$usuario'",
				"password"=>"MD5('$password')",
				);
	${$narchivo}->actualizar($valores,$cod);
	$codinsercion=$cod;
	$mensaje[]="EL USUARIO SE GUARDO CORRECTAMENTE";
}
$nuevo=1;
	$archivovolver="cambiarp.php";
	$titulo="Confirmación de Guardado";
	$folder="../";
	include_once '../mensajeresultado.php';

endif;?>