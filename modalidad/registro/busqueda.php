<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/modalidad.php';
	extract($_POST);

	$modalidad=new modalidad;
	$mod=$modalidad->mostrarTodo("nombre LIKE '%$nombre%'");
	$titulo=array("nombre"=>"Nombre","descripcion"=>"Descripción","observacion"=>"Observación");
	listadoTabla($titulo,$mod,1,"modificar.php","eliminar.php","ver.php");
}
?>