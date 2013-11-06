<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/producto.php';
	extract($_POST);
	$codtipo=$codtipo?"codtipo='$codtipo'":"codtipo LIKE '%'";
	$producto=new producto;
	$prod=$producto->mostrarTodo("nombre LIKE '%$nombre%' and $codtipo");
	$titulo=array("nombre"=>"Nombre","descripcion"=>"Descripción","codbarra"=>"Código de Barra","observacion"=>"Observación");
	listadoTabla($titulo,$prod,1,"modificar.php","eliminar.php","ver.php");
}
?>