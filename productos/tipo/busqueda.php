<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/tipo.php';
	extract($_POST);

	$tipo=new tipo;
	$tip=$tipo->mostrarTodo("nombre LIKE '%$nombre%'");
	$titulo=array("nombre"=>"Nombre","descripcion"=>"descripción","observacion"=>"Observación");
	listadoTabla($titulo,$tip,1,"modificar.php","eliminar.php","ver.php");
}
?>